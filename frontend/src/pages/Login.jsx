import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import {
  Box, Card, CardContent, TextField, Button, Typography,
  ToggleButton, ToggleButtonGroup, InputAdornment, IconButton,
  Alert, CircularProgress, Avatar,
} from '@mui/material';
import {
  School, Person, AdminPanelSettings, Groups,
  Visibility, VisibilityOff, Lock, AccountCircle,
} from '@mui/icons-material';
import { motion } from 'framer-motion';

const ROLES = [
  { value: 'admin',   label: 'Admin',   icon: <AdminPanelSettings />, color: '#4F46E5' },
  { value: 'staff',   label: 'Staff',   icon: <Groups />,             color: '#3B82F6' },
  { value: 'student', label: 'Student', icon: <Person />,             color: '#10B981' },
];

const ROLE_REDIRECT = {
  admin:   '/admin/dashboard',
  staff:   '/staff/dashboard',
  student: '/student/dashboard',
};

export default function Login() {
  const { login, error, loading } = useAuth();
  const navigate = useNavigate();

  const [role,        setRole]        = useState('admin');
  const [username,    setUsername]    = useState('');
  const [password,    setPassword]    = useState('');
  const [showPass,    setShowPass]    = useState(false);
  const [localError,  setLocalError]  = useState('');

  const activeRole = ROLES.find((r) => r.value === role);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLocalError('');
    if (!username.trim() || !password.trim()) {
      setLocalError('Please enter both username and password.');
      return;
    }
    const result = await login({ username: username.trim(), password, role });
    if (result.success) {
      navigate(ROLE_REDIRECT[result.role] || '/');
    }
  };

  return (
    <Box
      sx={{
        minHeight: '100vh',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        background: '#F9FAFB',
        position: 'relative',
        overflow: 'hidden',
      }}
    >
      {/* Background decorations */}
      <Box
        sx={{
          position: 'absolute',
          width: 600,
          height: 600,
          borderRadius: '50%',
          background: 'radial-gradient(circle, rgba(79,70,229,0.08) 0%, transparent 70%)',
          top: -200,
          right: -200,
        }}
      />
      <Box
        sx={{
          position: 'absolute',
          width: 400,
          height: 400,
          borderRadius: '50%',
          background: 'radial-gradient(circle, rgba(16,185,129,0.08) 0%, transparent 70%)',
          bottom: -150,
          left: -150,
        }}
      />

      <Card
        component={motion.div}
        initial={{ opacity: 0, y: 30 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.5 }}
        sx={{
          width: '100%',
          maxWidth: 420,
          mx: 2,
          borderRadius: 3,
          boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)',
          border: '1px solid #E5E7EB',
          overflow: 'hidden',
          position: 'relative',
          zIndex: 1,
        }}
      >
        <CardContent sx={{ p: 4 }}>
          {/* Logo and title */}
          <Box sx={{ textAlign: 'center', mb: 4 }}>
            <Box
              sx={{
                width: 56,
                height: 56,
                borderRadius: 2,
                bgcolor: `${activeRole.color}15`,
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                mx: 'auto',
                mb: 2,
                transition: 'all 0.3s ease',
              }}
            >
              <School sx={{ fontSize: 28, color: activeRole.color, transition: 'color 0.3s ease' }} />
            </Box>
            <Typography variant="h5" fontWeight={700} color="text.primary">
              Welcome back
            </Typography>
            <Typography variant="body2" color="text.secondary" sx={{ mt: 0.5 }}>
              Sign in to STC College Portal
            </Typography>
          </Box>

          {/* Role Selector */}
          <Typography 
            variant="caption" 
            color="text.secondary" 
            fontWeight={500} 
            sx={{ mb: 1, display: 'block', letterSpacing: '0.05em' }}
          >
            SELECT ROLE
          </Typography>
          <ToggleButtonGroup
            value={role}
            exclusive
            onChange={(_, val) => { if (val) { setRole(val); setLocalError(''); } }}
            fullWidth
            sx={{ mb: 3 }}
          >
            {ROLES.map((r) => (
              <ToggleButton
                key={r.value}
                value={r.value}
                id={`role-btn-${r.value}`}
                sx={{
                  py: 1,
                  gap: 0.8,
                  fontSize: '0.8125rem',
                  fontWeight: 500,
                  border: '1px solid #E5E7EB',
                  color: '#6B7280',
                  '&.Mui-selected': {
                    background: `${r.color}10`,
                    borderColor: r.color,
                    color: r.color,
                    '&:hover': {
                      background: `${r.color}15`,
                    },
                  },
                  '&:hover': {
                    bgcolor: '#F9FAFB',
                  },
                }}
              >
                {r.icon}
                {r.label}
              </ToggleButton>
            ))}
          </ToggleButtonGroup>

          {/* Errors */}
          {(error || localError) && (
            <Alert severity="error" sx={{ mb: 2 }}>
              {localError || error}
            </Alert>
          )}

          <form onSubmit={handleSubmit} noValidate>
            <TextField
              id="login-username"
              fullWidth
              label={role === 'student' ? 'Register Number' : 'Username / Staff ID'}
              variant="outlined"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              sx={{ mb: 2 }}
              InputProps={{
                startAdornment: (
                  <InputAdornment position="start">
                    <AccountCircle sx={{ color: '#9CA3AF' }} />
                  </InputAdornment>
                ),
              }}
              autoFocus
            />
            <TextField
              id="login-password"
              fullWidth
              label="Password"
              type={showPass ? 'text' : 'password'}
              variant="outlined"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              sx={{ mb: 3 }}
              InputProps={{
                startAdornment: (
                  <InputAdornment position="start">
                    <Lock sx={{ color: '#9CA3AF' }} />
                  </InputAdornment>
                ),
                endAdornment: (
                  <InputAdornment position="end">
                    <IconButton
                      id="toggle-password-visibility"
                      onClick={() => setShowPass(!showPass)}
                      edge="end"
                      sx={{ color: '#9CA3AF' }}
                    >
                      {showPass ? <VisibilityOff /> : <Visibility />}
                    </IconButton>
                  </InputAdornment>
                ),
              }}
            />

            <Button
              id="login-submit-btn"
              type="submit"
              fullWidth
              variant="contained"
              size="large"
              disabled={loading}
              sx={{
                py: 1.5,
                fontSize: '0.9375rem',
                fontWeight: 600,
                bgcolor: activeRole.color,
                transition: 'all 0.3s ease',
                '&:hover': {
                  bgcolor: activeRole.color,
                  filter: 'brightness(0.9)',
                },
              }}
            >
              {loading ? <CircularProgress size={24} color="inherit" /> : `Sign in as ${activeRole.label}`}
            </Button>
          </form>

          <Typography 
            variant="caption" 
            color="text.secondary" 
            textAlign="center" 
            display="block"
            sx={{ mt: 3 }}
          >
            © 2026 Sree Saraswathi Thyagaraja College
          </Typography>
        </CardContent>
      </Card>
    </Box>
  );
}
