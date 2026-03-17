import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import {
  AppBar, Toolbar, Typography, IconButton, Avatar, Box,
  Tooltip, Badge, Chip,
} from '@mui/material';
import { Notifications, Settings } from '@mui/icons-material';

const ROLE_COLOR = {
  admin:   '#1A237E',
  staff:   '#1565C0',
  student: '#00695C',
};

export default function Navbar() {
  const { user, role } = useAuth();
  const pageTitle = getPageTitle(window.location.pathname);

  return (
    <AppBar
      position="fixed"
      elevation={0}
      sx={{
        background: '#fff',
        borderBottom: '1px solid',
        borderColor: 'divider',
        zIndex: (theme) => theme.zIndex.drawer + 1,
        ml: '260px',
        width: 'calc(100% - 260px)',
      }}
    >
      <Toolbar sx={{ gap: 1 }}>
        <Typography variant="h6" fontWeight={700} color="text.primary" sx={{ flex: 1 }}>
          {pageTitle}
        </Typography>

        <Chip
          label={role?.toUpperCase()}
          size="small"
          sx={{
            bgcolor: `${ROLE_COLOR[role]}18`,
            color: ROLE_COLOR[role],
            fontWeight: 700,
            fontSize: '0.7rem',
          }}
        />

        <Tooltip title="Notifications">
          <IconButton id="navbar-notifications">
            <Badge badgeContent={0} color="error">
              <Notifications sx={{ color: 'text.secondary' }} />
            </Badge>
          </IconButton>
        </Tooltip>

        <Tooltip title={user?.name || user?.id}>
          <Avatar
            id="navbar-user-avatar"
            sx={{
              width: 36,
              height: 36,
              bgcolor: ROLE_COLOR[role],
              fontSize: '0.9rem',
              fontWeight: 700,
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
    '/admin/dashboard':   'Admin Dashboard',
    '/admin/students':    'Student Management',
    '/admin/staff':       'Staff Management',
    '/admin/subjects':    'Subject Management',
    '/admin/events':      'Events',
    '/admin/complaints':  'Complaints',
    '/admin/reports':     'Reports',
    '/staff/dashboard':   'Staff Dashboard',
    '/staff/attendance':  'Attendance',
    '/staff/assignments': 'Assignments',
    '/staff/notes':       'Notes',
    '/staff/marks':       'Internal Marks',
    '/staff/timetable':   'Timetable',
    '/staff/workdiary':   'Work Diary',
    '/student/dashboard': 'Student Dashboard',
    '/student/attendance':'My Attendance',
    '/student/assignments':'My Assignments',
    '/student/marks':     'My Marks',
    '/student/notes':     'Notes',
    '/student/timetable': 'Timetable',
    '/student/events':    'Events',
    '/student/complaints':'Complaints',
  };
  return map[path] || 'College Portal';
}
