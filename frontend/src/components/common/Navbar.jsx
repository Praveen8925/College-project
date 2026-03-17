import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import {
  AppBar, Toolbar, Typography, IconButton, Avatar, Box,
  Tooltip, Badge, Chip, useMediaQuery, useTheme,
} from '@mui/material';
import { Notifications, Search } from '@mui/icons-material';

const ROLE_STYLES = {
  admin:   { bg: 'rgba(79, 70, 229, 0.1)', color: '#4F46E5' },
  staff:   { bg: 'rgba(59, 130, 246, 0.1)', color: '#3B82F6' },
  student: { bg: 'rgba(16, 185, 129, 0.1)', color: '#10B981' },
};

export default function Navbar() {
  const { user, role } = useAuth();
  const pageTitle = getPageTitle(window.location.pathname);
  const theme = useTheme();
  const isMobile = useMediaQuery(theme.breakpoints.down('md'));
  const roleStyle = ROLE_STYLES[role] || ROLE_STYLES.admin;

  return (
    <AppBar
      position="fixed"
      elevation={0}
      sx={{
        background: '#FFFFFF',
        borderBottom: '1px solid #E5E7EB',
        zIndex: (theme) => theme.zIndex.drawer + 1,
        ml: { xs: 0, md: '260px' },
        width: { xs: '100%', md: 'calc(100% - 260px)' },
      }}
    >
      <Toolbar sx={{ gap: 2, minHeight: { xs: 56, sm: 64 }, px: { xs: 2, sm: 3 } }}>
        {/* Page title - hidden on mobile to save space */}
        {!isMobile && (
          <Typography 
            variant="h6" 
            fontWeight={600} 
            color="text.primary" 
            sx={{ flex: 1 }}
          >
            {pageTitle}
          </Typography>
        )}
        {isMobile && <Box sx={{ flex: 1, ml: 5 }} />}

        {/* Role badge */}
        <Chip
          label={role?.toUpperCase()}
          size="small"
          sx={{
            bgcolor: roleStyle.bg,
            color: roleStyle.color,
            fontWeight: 600,
            fontSize: '0.7rem',
            height: 24,
            borderRadius: '6px',
          }}
        />

        {/* Notifications */}
        <Tooltip title="Notifications">
          <IconButton 
            id="navbar-notifications"
            sx={{ 
              color: '#6B7280',
              '&:hover': { bgcolor: '#F3F4F6' },
            }}
          >
            <Badge badgeContent={0} color="error">
              <Notifications sx={{ fontSize: 22 }} />
            </Badge>
          </IconButton>
        </Tooltip>

        {/* User avatar */}
        <Tooltip title={user?.name || user?.id}>
          <Avatar
            id="navbar-user-avatar"
            sx={{
              width: 36,
              height: 36,
              bgcolor: roleStyle.color,
              fontSize: '0.875rem',
              fontWeight: 600,
              cursor: 'pointer',
            }}
          >
            {user?.name?.[0] || user?.id?.[0] || '?'}
          </Avatar>
        </Tooltip>
      </Toolbar>
    </AppBar>
  );
}

function getPageTitle(path) {
  const map = {
    '/admin/dashboard':   'Dashboard',
    '/admin/students':    'Students',
    '/admin/staff':       'Staff',
    '/admin/subjects':    'Subjects',
    '/admin/events':      'Events',
    '/admin/complaints':  'Complaints',
    '/admin/reports':     'Reports',
    '/admin/reports/attendance': 'Attendance Report',
    '/admin/reports/marks': 'Marks Report',
    '/admin/reports/student': 'Student Report',
    '/staff/dashboard':   'Dashboard',
    '/staff/attendance':  'Attendance',
    '/staff/assignments': 'Assignments',
    '/staff/notes':       'Notes',
    '/staff/marks':       'Internal Marks',
    '/staff/timetable':   'Timetable',
    '/staff/workdiary':   'Work Diary',
    '/student/dashboard': 'Dashboard',
    '/student/attendance':'Attendance',
    '/student/assignments':'Assignments',
    '/student/marks':     'Marks',
    '/student/notes':     'Notes',
    '/student/timetable': 'Timetable',
    '/student/events':    'Events',
    '/student/complaints':'Complaints',
    '/student/password':  'Change Password',
  };
  return map[path] || 'College Portal';
}
