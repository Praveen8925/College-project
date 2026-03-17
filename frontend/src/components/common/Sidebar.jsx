import { useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import {
  Box, Drawer, List, ListItem, ListItemButton, ListItemIcon,
  ListItemText, Toolbar, Typography, Avatar, Divider, Tooltip,
  IconButton, Collapse,
} from '@mui/material';
import {
  Dashboard, People, Group, School, Assignment, EventNote,
  ReportProblem, BookmarkBorder, CheckBox, CalendarMonth,
  MenuBook, Work, Logout, ChevronRight, ExpandLess, ExpandMore,
  AdminPanelSettings, BarChart, AccessTime, Grade,
} from '@mui/icons-material';

const DRAWER_WIDTH = 260;

// Navigation config per role
const NAV = {
  admin: [
    { label: 'Dashboard',   icon: <Dashboard />,         path: '/admin/dashboard' },
    { label: 'Students',    icon: <People />,             path: '/admin/students' },
    { label: 'Staff',       icon: <Group />,              path: '/admin/staff' },
    { label: 'Subjects',    icon: <BookmarkBorder />,     path: '/admin/subjects' },
    { label: 'Events',      icon: <EventNote />,          path: '/admin/events' },
    { label: 'Complaints',  icon: <ReportProblem />,      path: '/admin/complaints' },
    {
      label: 'Reports',
      icon: <BarChart />,
      path: '/admin/reports',
      children: [
        { label: 'Analytics Hub',   icon: <AdminPanelSettings />, path: '/admin/reports' },
        { label: 'Attendance Rpt',  icon: <AccessTime />,         path: '/admin/reports/attendance' },
        { label: 'Marks Report',    icon: <Grade />,              path: '/admin/reports/marks' },
      ],
    },
  ],
  staff: [
    { label: 'Dashboard',   icon: <Dashboard />,    path: '/staff/dashboard' },
    { label: 'Attendance',  icon: <CheckBox />,      path: '/staff/attendance' },
    { label: 'Assignments', icon: <Assignment />,    path: '/staff/assignments' },
    { label: 'Notes',       icon: <MenuBook />,      path: '/staff/notes' },
    { label: 'Marks',       icon: <School />,        path: '/staff/marks' },
    { label: 'Timetable',   icon: <CalendarMonth />, path: '/staff/timetable' },
    { label: 'Work Diary',  icon: <Work />,          path: '/staff/workdiary' },
  ],
  student: [
    { label: 'Dashboard',   icon: <Dashboard />,    path: '/student/dashboard' },
    { label: 'Attendance',  icon: <CheckBox />,      path: '/student/attendance' },
    { label: 'Assignments', icon: <Assignment />,    path: '/student/assignments' },
    { label: 'My Marks',    icon: <School />,        path: '/student/marks' },
    { label: 'Notes',       icon: <MenuBook />,      path: '/student/notes' },
    { label: 'Timetable',   icon: <CalendarMonth />, path: '/student/timetable' },
    { label: 'Events',      icon: <EventNote />,     path: '/student/events' },
    { label: 'Complaints',  icon: <ReportProblem />, path: '/student/complaints' },
  ],
};

export default function Sidebar() {
  const { user, role, logout } = useAuth();
  const navigate  = useNavigate();
  const location  = useLocation();
  const navItems  = NAV[role] || [];
  const [openGroup, setOpenGroup] = useState(null);

  const handleLogout = async () => {
    await logout();
    navigate('/login');
  };

  const toggleGroup = (label) =>
    setOpenGroup(prev => (prev === label ? null : label));

  const renderItem = (item, indent = false) => {
    const active = location.pathname === item.path
      || (item.children && item.children.some(c => location.pathname.startsWith(c.path)));
    if (item.children) {
      const isOpen = openGroup === item.label
        || item.children.some(c => location.pathname.startsWith(c.path));
      return (
        <Box key={item.label}>
          <ListItem disablePadding sx={{ mb: 0.5 }}>
            <ListItemButton
              id={`nav-${item.label.toLowerCase()}`}
              onClick={() => toggleGroup(item.label)}
              sx={{
                borderRadius: 2, py: 1,
                bgcolor: active ? 'rgba(255,255,255,0.12)' : 'transparent',
                '&:hover': { bgcolor: 'rgba(255,255,255,0.09)' },
              }}
            >
              <ListItemIcon sx={{ color: active ? '#FFD54F' : 'rgba(255,255,255,0.7)', minWidth: 38 }}>
                {item.icon}
              </ListItemIcon>
              <ListItemText
                primary={item.label}
                primaryTypographyProps={{ fontSize:'0.875rem', fontWeight:active?700:400,
                  color:active?'#fff':'rgba(255,255,255,0.8)' }}
              />
              {isOpen ? <ExpandLess sx={{color:'rgba(255,255,255,0.5)',fontSize:18}}/>
                      : <ExpandMore sx={{color:'rgba(255,255,255,0.5)',fontSize:18}}/>}
            </ListItemButton>
          </ListItem>
          <Collapse in={isOpen}>
            <List disablePadding sx={{ pl: 2 }}>
              {item.children.map(c => renderItem(c, true))}
            </List>
          </Collapse>
        </Box>
      );
    }
    const isActive = location.pathname === item.path;
    return (
      <ListItem key={item.path} disablePadding sx={{ mb: 0.5 }}>
        <ListItemButton
          id={`nav-${item.label.toLowerCase().replace(/\s+/g,'-')}`}
          onClick={() => navigate(item.path)}
          sx={{
            borderRadius: 2, py: indent ? 0.7 : 1,
            bgcolor: isActive ? 'rgba(255,255,255,0.15)' : 'transparent',
            '&:hover': { bgcolor: 'rgba(255,255,255,0.1)' },
          }}
        >
          <ListItemIcon sx={{ color: isActive ? '#FFD54F' : 'rgba(255,255,255,0.6)', minWidth: 34 }}>
            {item.icon}
          </ListItemIcon>
          <ListItemText
            primary={item.label}
            primaryTypographyProps={{ fontSize: indent?'0.8rem':'0.875rem',
              fontWeight: isActive ? 700 : 400,
              color: isActive ? '#fff' : 'rgba(255,255,255,0.8)' }}
          />
          {isActive && <ChevronRight sx={{ color: '#FFD54F', fontSize: 18 }} />}
        </ListItemButton>
      </ListItem>
    );
  };

  return (
    <Drawer
      variant="permanent"
      sx={{
        width: DRAWER_WIDTH,
        flexShrink: 0,
        '& .MuiDrawer-paper': {
          width: DRAWER_WIDTH,
          boxSizing: 'border-box',
          borderRight: 'none',
        },
      }}
    >
      {/* College branding */}
      <Box sx={{ px: 2, pt: 3, pb: 2, textAlign: 'center' }}>
        <Avatar
          sx={{
            width: 56, height: 56, mx: 'auto', mb: 1,
            bgcolor: 'rgba(255,255,255,0.15)',
            border: '2px solid rgba(255,255,255,0.3)',
          }}
        >
          <School sx={{ color: '#fff', fontSize: 30 }} />
        </Avatar>
        <Typography variant="subtitle1" fontWeight={700} color="white" lineHeight={1.2}>
          STC Online Portal
        </Typography>
        <Typography variant="caption" sx={{ color: 'rgba(255,255,255,0.6)' }}>
          {role?.toUpperCase()} PANEL
        </Typography>
      </Box>

      <Divider sx={{ borderColor: 'rgba(255,255,255,0.12)', mx: 2 }} />

      {/* User info */}
      <Box sx={{ px: 2, py: 2, display: 'flex', alignItems: 'center', gap: 1.5 }}>
        <Avatar sx={{ bgcolor: 'rgba(255,255,255,0.2)', fontWeight: 700, fontSize: '0.9rem' }}>
          {user?.name?.[0] || user?.id?.[0] || '?'}
        </Avatar>
        <Box>
          <Typography variant="body2" fontWeight={600} color="white" noWrap>
            {user?.name || user?.id || 'User'}
          </Typography>
          <Typography variant="caption" sx={{ color: 'rgba(255,255,255,0.6)' }} noWrap>
            {user?.dept || ''}
          </Typography>
        </Box>
      </Box>

      <Divider sx={{ borderColor: 'rgba(255,255,255,0.12)', mx: 2, mb: 1 }} />

      {/* Navigation */}
      <List sx={{ px: 1, flex: 1, overflowY: 'auto' }}>
        {navItems.map(item => renderItem(item))}
      </List>

      {/* Logout */}
      <Divider sx={{ borderColor: 'rgba(255,255,255,0.12)', mx: 2 }} />
      <List sx={{ px: 1, py: 1 }}>
        <ListItem disablePadding>
          <ListItemButton
            id="nav-logout"
            onClick={handleLogout}
            sx={{ borderRadius: 2, py: 1, '&:hover': { bgcolor: 'rgba(239,68,68,0.2)' } }}
          >
            <ListItemIcon sx={{ color: '#FF8A80', minWidth: 38 }}>
              <Logout />
            </ListItemIcon>
            <ListItemText
              primary="Logout"
              primaryTypographyProps={{ fontSize: '0.875rem', color: '#FF8A80', fontWeight: 500 }}
            />
          </ListItemButton>
        </ListItem>
      </List>
    </Drawer>
  );
}

export { DRAWER_WIDTH };
