import { createContext, useContext, useReducer, useEffect } from 'react';
import api from '../utils/axiosInstance';

const AuthContext = createContext(null);

const initialState = {
  user: null,
  role: null,       // 'admin' | 'staff' | 'student'
  token: null,
  loading: true,
  error: null,
};

function authReducer(state, action) {
  switch (action.type) {
    case 'LOGIN_SUCCESS':
      return {
        ...state,
        user: action.payload.user,
        role: action.payload.role,
        token: action.payload.token,
        loading: false,
        error: null,
      };
    case 'LOGOUT':
      return { ...initialState, loading: false };
    case 'SET_LOADING':
      return { ...state, loading: action.payload };
    case 'SET_ERROR':
      return { ...state, error: action.payload, loading: false };
    default:
      return state;
  }
}

export function AuthProvider({ children }) {
  const [state, dispatch] = useReducer(authReducer, initialState);

  // Restore session on page refresh
  useEffect(() => {
    const storedToken = localStorage.getItem('cms_token');
    const storedUser  = localStorage.getItem('cms_user');
    if (storedToken && storedUser) {
      try {
        const user = JSON.parse(storedUser);
        dispatch({
          type: 'LOGIN_SUCCESS',
          payload: { user, role: user.role, token: storedToken },
        });
      } catch {
        dispatch({ type: 'SET_LOADING', payload: false });
      }
    } else {
      dispatch({ type: 'SET_LOADING', payload: false });
    }
  }, []);

  const login = async (credentials) => {
    dispatch({ type: 'SET_LOADING', payload: true });
    dispatch({ type: 'SET_ERROR', payload: null });
    try {
      const { data } = await api.post('/auth/login.php', credentials);
      if (data.success) {
        localStorage.setItem('cms_token', data.token);
        localStorage.setItem('cms_user', JSON.stringify(data.user));
        dispatch({
          type: 'LOGIN_SUCCESS',
          payload: { user: data.user, role: data.user.role, token: data.token },
        });
        return { success: true, role: data.user.role };
      } else {
        dispatch({ type: 'SET_ERROR', payload: data.message || 'Invalid credentials' });
        return { success: false };
      }
    } catch (err) {
      const msg = err.response?.data?.message || 'Server error. Please try again.';
      dispatch({ type: 'SET_ERROR', payload: msg });
      return { success: false };
    }
  };

  const logout = async () => {
    try { await api.post('/auth/logout.php'); } catch {}
    localStorage.removeItem('cms_token');
    localStorage.removeItem('cms_user');
    dispatch({ type: 'LOGOUT' });
  };

  return (
    <AuthContext.Provider value={{ ...state, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error('useAuth must be used inside AuthProvider');
  return ctx;
}
