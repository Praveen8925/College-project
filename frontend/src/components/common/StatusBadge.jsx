import { Chip } from '@mui/material';

const STATUS_STYLES = {
  success: { bgcolor: '#D1FAE5', color: '#065F46' },
  warning: { bgcolor: '#FEF3C7', color: '#92400E' },
  error:   { bgcolor: '#FEE2E2', color: '#991B1B' },
  info:    { bgcolor: '#DBEAFE', color: '#1E40AF' },
  neutral: { bgcolor: '#F3F4F6', color: '#4B5563' },
  primary: { bgcolor: 'rgba(79, 70, 229, 0.1)', color: '#4F46E5' },
};

// Auto-detect status color based on common status values
const getStatusColor = (status) => {
  const s = String(status).toLowerCase();
  if (['active', 'approved', 'resolved', 'completed', 'present', 'pass', 'yes'].includes(s)) return 'success';
  if (['pending', 'processing', 'in progress', 'waiting'].includes(s)) return 'warning';
  if (['inactive', 'rejected', 'failed', 'absent', 'no', 'blocked'].includes(s)) return 'error';
  if (['new', 'open', 'draft'].includes(s)) return 'info';
  return 'neutral';
};

/**
 * Modern pill-shaped status badge
 */
export default function StatusBadge({ 
  status, 
  color,
  size = 'small',
  ...props 
}) {
  const statusColor = color || getStatusColor(status);
  const styles = STATUS_STYLES[statusColor] || STATUS_STYLES.neutral;

  return (
    <Chip
      label={status}
      size={size}
      sx={{
        ...styles,
        fontWeight: 500,
        fontSize: '0.75rem',
        borderRadius: '999px',
        px: 0.5,
        '& .MuiChip-label': { px: 1.5 },
      }}
      {...props}
    />
  );
}
