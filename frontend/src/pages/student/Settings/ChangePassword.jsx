import { useState } from 'react';
import {
  Box, Card, CardContent, Typography, TextField, Button,
  Alert, CircularProgress, InputAdornment, IconButton,
} from '@mui/material';
import { Lock, Visibility, VisibilityOff, CheckCircle } from '@mui/icons-material';
import { changePassword } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

export default function ChangePassword() {
  const { user } = useAuth();
  const [form, setForm] = useState({ oldPassword: '', newPassword: '', confirmPassword: '' });
  const [showOld, setShowOld] = useState(false);
  const [showNew, setShowNew] = useState(false);
  const [loading, setLoading] = useState(false);
  const [error, setError]     = useState('');
  const [success, setSuccess] = useState(false);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
    setError('');
    setSuccess(false);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(''); setSuccess(false);

    if (!form.oldPassword || !form.newPassword || !form.confirmPassword) {
      setError('All fields are required.');
      return;
    }

    if (form.newPassword.length < 4) {
      setError('New password must be at least 4 characters.');
      return;
    }

    if (form.newPassword !== form.confirmPassword) {
      setError('New passwords do not match.');
      return;
    }

    setLoading(true);
    try {
      const { data } = await changePassword({
        regno: user.id,
        oldPassword: form.oldPassword,
        newPassword: form.newPassword,
      });
      if (data.success) {
        setSuccess(true);
        setForm({ oldPassword: '', newPassword: '', confirmPassword: '' });
      } else {
        setError(data.message || 'Failed to change password.');
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Server error. Please try again.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <PageWrapper>
      <Box sx={{ maxWidth: 500, mx: 'auto' }}>
        <Typography variant="h4" fontWeight={700} mb={0.5}>Change Password</Typography>
        <Typography variant="body2" color="text.secondary" mb={3}>
          Update your account password
        </Typography>

        <Card>
          <CardContent sx={{ p: 3 }}>
            {success && (
              <Alert severity="success" icon={<CheckCircle />} sx={{ mb: 3, borderRadius: 2 }}>
                Password changed successfully!
              </Alert>
            )}
            {error && <Alert severity="error" sx={{ mb: 3, borderRadius: 2 }}>{error}</Alert>}

            <form onSubmit={handleSubmit}>
              <TextField
              fullWidth
              label="Current Password"
              name="oldPassword"
              type={showOld ? 'text' : 'password'}
              value={form.oldPassword}
              onChange={handleChange}
              sx={{ mb: 2 }}
              InputProps={{
                startAdornment: <InputAdornment position="start"><Lock sx={{ color: '#888' }} /></InputAdornment>,
                endAdornment: (
                  <InputAdornment position="end">
                    <IconButton onClick={() => setShowOld(!showOld)} edge="end" size="small">
                      {showOld ? <VisibilityOff /> : <Visibility />}
                    </IconButton>
                  </InputAdornment>
                ),
              }}
            />

            <TextField
              fullWidth
              label="New Password"
              name="newPassword"
              type={showNew ? 'text' : 'password'}
              value={form.newPassword}
              onChange={handleChange}
              sx={{ mb: 2 }}
              helperText="Minimum 4 characters"
              InputProps={{
                startAdornment: <InputAdornment position="start"><Lock sx={{ color: '#888' }} /></InputAdornment>,
                endAdornment: (
                  <InputAdornment position="end">
                    <IconButton onClick={() => setShowNew(!showNew)} edge="end" size="small">
                      {showNew ? <VisibilityOff /> : <Visibility />}
                    </IconButton>
                  </InputAdornment>
                ),
              }}
            />

            <TextField
              fullWidth
              label="Confirm New Password"
              name="confirmPassword"
              type={showNew ? 'text' : 'password'}
              value={form.confirmPassword}
              onChange={handleChange}
              sx={{ mb: 3 }}
              InputProps={{
                startAdornment: <InputAdornment position="start"><Lock sx={{ color: '#888' }} /></InputAdornment>,
              }}
            />

            <Button
              fullWidth
              type="submit"
              variant="contained"
              size="large"
              disabled={loading}
              sx={{ py: 1.5 }}
            >
              {loading ? <CircularProgress size={24} color="inherit" /> : 'Change Password'}
            </Button>
          </form>
        </CardContent>
      </Card>
      </Box>
    </PageWrapper>
  );
}
