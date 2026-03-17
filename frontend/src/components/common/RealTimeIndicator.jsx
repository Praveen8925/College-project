import {
  Box, Typography, Chip, IconButton, Tooltip, Alert,
  Switch, FormControlLabel, Snackbar,
} from '@mui/material';
import {
  Refresh, PlayArrow, Pause, Notifications,
  SignalWifiConnectedNoInternet4, SignalWifi4Bar,
} from '@mui/icons-material';
import { motion } from 'framer-motion';
import { format } from 'date-fns';

export default function RealTimeIndicator({
  lastUpdate,
  isAutoRefreshing,
  onRefresh,
  onToggleAutoRefresh,
  isLoading = false,
  error = null,
  refreshInterval = 30000,
}) {
  
  const formatLastUpdate = (date) => {
    if (!date) return 'Never';
    return format(date, 'HH:mm:ss');
  };

  const getConnectionStatus = () => {
    if (error) return { color: 'error', icon: <SignalWifiConnectedNoInternet4 />, text: 'Offline' };
    if (isAutoRefreshing) return { color: 'success', icon: <SignalWifi4Bar />, text: 'Live' };
    return { color: 'warning', icon: <Pause />, text: 'Paused' };
  };

  const status = getConnectionStatus();

  return (
    <Box 
      sx={{ 
        display: 'flex', 
        alignItems: 'center', 
        gap: 2, 
        p: 1,
        bgcolor: 'rgba(255,255,255,0.8)',
        borderRadius: 2,
        backdropFilter: 'blur(8px)',
        border: '1px solid rgba(0,0,0,0.1)',
      }}
    >
      {/* Connection Status */}
      <Box sx={{ display: 'flex', alignItems: 'center', gap: 1 }}>
        <motion.div
          animate={{ 
            scale: isAutoRefreshing && !error ? [1, 1.2, 1] : 1,
          }}
          transition={{ 
            duration: 2, 
            repeat: isAutoRefreshing && !error ? Infinity : 0,
          }}
        >
          <Chip
            icon={status.icon}
            label={status.text}
            color={status.color}
            size="small"
            sx={{ fontWeight: 600 }}
          />
        </motion.div>
        
        <Typography variant="caption" color="text.secondary">
          Last update: {formatLastUpdate(lastUpdate)}
        </Typography>
      </Box>

      {/* Controls */}
      <Box sx={{ display: 'flex', alignItems: 'center', gap: 1 }}>
        <FormControlLabel
          control={
            <Switch
              checked={isAutoRefreshing}
              onChange={onToggleAutoRefresh}
              size="small"
            />
          }
          label={
            <Typography variant="caption">
              Auto-refresh ({Math.round(refreshInterval / 1000)}s)
            </Typography>
          }
          sx={{ margin: 0 }}
        />

        <Tooltip title="Refresh now">
          <IconButton
            onClick={onRefresh}
            disabled={isLoading}
            size="small"
            sx={{
              bgcolor: 'white',
              '&:hover': { bgcolor: 'grey.100' },
            }}
          >
            <motion.div
              animate={{ rotate: isLoading ? 360 : 0 }}
              transition={{ 
                duration: 1, 
                repeat: isLoading ? Infinity : 0,
                ease: 'linear',
              }}
            >
              <Refresh fontSize="small" />
            </motion.div>
          </IconButton>
        </Tooltip>
      </Box>
    </Box>
  );
}

// Live notification component
export function LiveNotification({ 
  notifications, 
  onClose 
}) {
  if (!notifications || notifications.length === 0) return null;

  const latest = notifications[0];

  return (
    <Snackbar
      open={true}
      anchorOrigin={{ vertical: 'top', horizontal: 'right' }}
      sx={{ mt: 8 }}
    >
      <Alert
        severity={latest.type || 'info'}
        onClose={() => onClose(latest.id)}
        action={
          <IconButton size="small" color="inherit">
            <Notifications fontSize="small" />
          </IconButton>
        }
        sx={{
          minWidth: 300,
          bgcolor: 'white',
          color: 'text.primary',
          boxShadow: '0 8px 32px rgba(0,0,0,0.2)',
          border: '1px solid rgba(0,0,0,0.1)',
        }}
      >
        <Box>
          <Typography variant="subtitle2" fontWeight={600}>
            {latest.title || 'Update Available'}
          </Typography>
          <Typography variant="caption" color="text.secondary">
            {latest.message}
          </Typography>
        </Box>
      </Alert>
    </Snackbar>
  );
}
