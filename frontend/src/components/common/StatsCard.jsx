import { Box, Typography, Card, CardContent } from '@mui/material';
import { motion } from 'framer-motion';

const COLORS = {
  primary: { border: '#4F46E5', bg: 'rgba(79, 70, 229, 0.08)', icon: '#4F46E5' },
  success: { border: '#10B981', bg: 'rgba(16, 185, 129, 0.08)', icon: '#10B981' },
  warning: { border: '#F59E0B', bg: 'rgba(245, 158, 11, 0.08)', icon: '#F59E0B' },
  error:   { border: '#EF4444', bg: 'rgba(239, 68, 68, 0.08)', icon: '#EF4444' },
  info:    { border: '#3B82F6', bg: 'rgba(59, 130, 246, 0.08)', icon: '#3B82F6' },
};

/**
 * Modern stat card with left border accent
 */
export default function StatsCard({ 
  label, 
  value, 
  icon, 
  color = 'primary',
  onClick,
  loading = false,
}) {
  const colorScheme = COLORS[color] || COLORS.primary;

  return (
    <Card
      component={motion.div}
      whileHover={{ scale: 1.02, y: -4 }}
      whileTap={{ scale: 0.98 }}
      transition={{ type: 'spring', stiffness: 400, damping: 17 }}
      onClick={onClick}
      sx={{
        cursor: onClick ? 'pointer' : 'default',
        borderLeft: `4px solid ${colorScheme.border}`,
        height: '100%',
        '&:hover': {
          boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.1)',
        },
      }}
    >
      <CardContent sx={{ p: 2.5, '&:last-child': { pb: 2.5 } }}>
        <Box sx={{ display: 'flex', alignItems: 'flex-start', justifyContent: 'space-between' }}>
          <Box>
            <Typography 
              variant="body2" 
              sx={{ 
                color: 'text.secondary', 
                fontWeight: 500, 
                fontSize: '0.8125rem',
                mb: 0.5,
              }}
            >
              {label}
            </Typography>
            <Typography 
              variant="h4" 
              sx={{ 
                fontWeight: 700, 
                color: 'text.primary',
                fontSize: '1.75rem',
              }}
            >
              {loading ? '—' : value}
            </Typography>
          </Box>
          {icon && (
            <Box
              sx={{
                p: 1.25,
                borderRadius: 2,
                bgcolor: colorScheme.bg,
                color: colorScheme.icon,
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
              }}
            >
              {icon}
            </Box>
          )}
        </Box>
      </CardContent>
    </Card>
  );
}
