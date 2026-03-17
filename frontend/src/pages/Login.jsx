import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import {
  Box, Card, CardContent, TextField, Button, Typography,
  ToggleButton, ToggleButtonGroup, InputAdornment, IconButton,
  Alert, CircularProgress, Divider, Avatar,
} from '@mui/material';
import {
  School, Person, AdminPanelSettings, Groups,
  Visibility, VisibilityOff, Lock, AccountCircle,
} from '@mui/icons-material';

const ROLES = [
  { value: 'admin',   label: 'Admin',   icon: <AdminPanelSettings />, color: '#1A237E' },
  { value: 'staff',   label: 'Staff',   icon: <Groups />,             color: '#1565C0' },
  { value: 'student', label: 'Student', icon: <Person />,             color: '#00695C' },
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
        background: 'linear-gradient(135deg, #1A237E 0%, #283593 40%, #0D47A1 70%, #1565C0 100%)',
        position: 'relative',
        overflow: 'hidden',
        '&::before': {
          content: '""',
          position: 'absolute',
          width: 500,
          height: 500,
          borderRadius: '50%',
          background: 'rgba(255,255,255,0.04)',
          top: -150,
          right: -100,
        },
        '&::after': {
          content: '""',
          position: 'absolute',
          width: 350,
          height: 350,
          borderRadius: '50%',
          background: 'rgba(255,255,255,0.04)',
          bottom: -100,
          left: -80,
        },
      }}
    >
      <Card
        sx={{
          width: '100%',
          maxWidth: 460,
          mx: 2,
          borderRadius: 4,
          boxShadow: '0 24px 80px rgba(0,0,0,0.35)',
          overflow: 'visible',
          position: 'relative',
          zIndex: 1,
        }}
      >
        {/* Top gradient header */}
        <Box
          sx={{
            background: `linear-gradient(135deg, ${activeRole.color} 0%, #0D47A1 100%)`,
            borderRadius: '16px 16px 0 0',
            py: 4,
            px: 3,
            textAlign: 'center',
            transition: 'background 0.4s ease',
          }}
        >
          <Avatar
            sx={{
              width: 72,
              height: 72,
              mx: 'auto',
              mb: 1.5,
              bgcolor: 'rgba(255,255,255,0.15)',
              border: '3px solid rgba(255,255,255,0.4)',
              backdropFilter: 'blur(8px)',
            }}
          >
            <School sx={{ fontSize: 38, color: '#fff' }} />
          </Avatar>
          <Typography variant="h5" fontWeight={700} color="white" letterSpacing={0.5}>
            STC College Portal
          </Typography>
          <Typography variant="body2" sx={{ color: 'rgba(255,255,255,0.75)', mt: 0.5 }}>
            Sree Saraswathi Thyagaraja College
          </Typography>
        </Box>

        <CardContent sx={{ px: 4, py: 4 }}>
          {/* Role Selector */}
          <Typography variant="caption" color="text.secondary" fontWeight={600} sx={{ mb: 1, display: 'block', textAlign: 'center' }}>
            SELECT YOUR ROLE
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
                  py: 1.2,
                  gap: 0.8,
                  fontSize: '0.82rem',
                  fontWeight: 600,
                  border: '1.5px solid',
                  borderColor: 'divider',
                  '&.Mui-selected': {
                    background: `${r.color}18`,
                    borderColor: r.color,
                    color: r.color,
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
            <Alert severity="error" sx={{ mb: 2, borderRadius: 2 }}>
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
                    <AccountCircle color="action" />
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
                    <Lock color="action" />
                  </InputAdornment>
                ),
                endAdornment: (
                  <InputAdornment position="end">
                    <IconButton
                      id="toggle-password-visibility"
                      onClick={() => setShowPass(!showPass)}
                      edge="end"
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
                fontSize: '1rem',
                background: `linear-gradient(90deg, ${activeRole.color} 0%, #1565C0 100%)`,
                transition: 'background 0.4s ease',
              }}
            >
              {loading ? <CircularProgress size={24} color="inherit" /> : `Sign In as ${activeRole.label}`}
            </Button>
          </form>

          <Divider sx={{ my: 3 }} />
          <Typography variant="caption" color="text.secondary" textAlign="center" display="block">
            © 2026 Sree Saraswathi Thyagaraja College ·           </Typography>
        </CardContent>
      </Card>
    </Box>
  );
}
