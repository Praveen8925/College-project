import { useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import {
  Box, Drawer, List, ListItem, ListItemButton, ListItemIcon,
  ListItemText, Typography, Avatar, Divider,
  IconButton, Collapse, useMediaQuery, useTheme,
} from '@mui/material';
import {
  Dashboard, People, Group, School, Assignment, EventNote,
  ReportProblem, BookmarkBorder, CheckBox, CalendarMonth,
  MenuBook, Work, Logout, ExpandLess, ExpandMore,
  AdminPanelSettings, BarChart, AccessTime, Grade, Lock, Menu,
  SwapHoriz, ManageAccounts, AccountTree, AutoStories, AssignmentTurnedIn,
} from '@mui/icons-material';

const DRAWER_WIDTH = 260;

// Navigation config per role
const NAV = {
  admin: [
    { label: 'Dashboard',   icon: <Dashboard />,         path: '/admin/dashboard' },
    { label: 'Students',    icon: <People />,             path: '/admin/students' },
    {
      label: 'Staff',
      icon: <Group />,
      path: '/admin/staff',
      children: [
        { label: 'Staff List',    icon: <Group />,          path: '/admin/staff' },
        { label: 'Allocation',    icon: <AccountTree />,    path: '/admin/staff/allocation' },
        { label: 'Transfers',     icon: <SwapHoriz />,      path: '/admin/staff/transfer' },
        { label: 'Class Incharge',icon: <ManageAccounts />, path: '/admin/staff/classincharge' },
      ],
    },
    { label: 'Subjects',    icon: <BookmarkBorder />,     path: '/admin/subjects' },
    {
      label: 'Subject Mgmt',
      icon: <BookmarkBorder />,
      path: '/admin/subjects',
      children: [
        { label: 'Subject List',   icon: <BookmarkBorder />, path: '/admin/subjects' },
        { label: 'Finalize',       icon: <CheckBox />,       path: '/admin/subjects/finalize' },
      ],
    },
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
        { label: 'Student Report',  icon: <People />,             path: '/admin/reports/student' },
        { label: 'Staff Report',    icon: <Group />,              path: '/admin/reports/staff' },
      ],
    },
  ],
  staff: [
    { label: 'Dashboard',    icon: <Dashboard />,         path: '/staff/dashboard' },
    { label: 'Attendance',   icon: <CheckBox />,           path: '/staff/attendance' },
    { label: 'Att. Report',  icon: <AssignmentTurnedIn />, path: '/staff/attendancereport' },
    { label: 'Assignments',  icon: <Assignment />,         path: '/staff/assignments' },
    { label: 'Notes',        icon: <MenuBook />,            path: '/staff/notes' },
    { label: 'Internal Marks', icon: <School />,           path: '/staff/marks' },
    { label: 'COE Marks',    icon: <Grade />,              path: '/staff/coemarks' },
    { label: 'Timetable',    icon: <CalendarMonth />,       path: '/staff/timetable' },
    { label: 'Work Diary',   icon: <Work />,                path: '/staff/workdiary' },
    { label: 'Complaints',   icon: <ReportProblem />,       path: '/staff/complaints' },
  ],
  student: [
    { label: 'Dashboard',   icon: <Dashboard />,    path: '/student/dashboard' },
    { label: 'Attendance',  icon: <CheckBox />,      path: '/student/attendance' },
    { label: 'Assignments', icon: <Assignment />,    path: '/student/assignments' },
    { label: 'My Marks',    icon: <School />,        path: '/student/marks' },
    { label: 'Notes',       icon: <MenuBook />,      path: '/student/notes' },
    { label: 'Syllabus',    icon: <AutoStories />,   path: '/student/syllabus' },
    { label: 'Timetable',   icon: <CalendarMonth />, path: '/student/timetable' },
    { label: 'Events',      icon: <EventNote />,     path: '/student/events' },
    { label: 'Complaints',  icon: <ReportProblem />, path: '/student/complaints' },
    { label: 'Password',    icon: <Lock />,          path: '/student/password' },
  ],
};

export default function Sidebar() {
  const { user, role, logout } = useAuth();
  const navigate  = useNavigate();
  const location  = useLocation();
  const navItems  = NAV[role] || [];
  const [openGroup, setOpenGroup] = useState(null);
  const [mobileOpen, setMobileOpen] = useState(false);
  
  const theme = useTheme();
  const isMobile = useMediaQuery(theme.breakpoints.down('md'));

  const handleLogout = async () => {
    await logout();
    navigate('/login');
  };

  const toggleGroup = (label) =>
    setOpenGroup(prev => (prev === label ? null : label));

  const handleNavClick = (path) => {
    navigate(path);
    if (isMobile) setMobileOpen(false);
  };

  const renderItem = (item, indent = false) => {
    const active = location.pathname === item.path
      || (item.children && item.children.some(c => location.pathname.startsWith(c.path)));
    if (item.children) {
      const isOpen = openGroup === item.label
        || item.children.some(c => location.pathname.startsWith(c.path));
      return (
        <Box key={item.label}>
          <ListItem disablePadding sx={{ mb: 0.5, px: 1.5 }}>
            <ListItemButton
              id={`nav-${item.label.toLowerCase()}`}
              onClick={() => toggleGroup(item.label)}
              sx={{
                borderRadius: 2,
                py: 1.25,
                bgcolor: active ? 'rgba(79, 70, 229, 0.15)' : 'transparent',
                '&:hover': { bgcolor: 'rgba(255,255,255,0.08)' },
              }}
            >
              <ListItemIcon sx={{ color: active ? '#818CF8' : 'rgba(255,255,255,0.6)', minWidth: 40 }}>
                {item.icon}
              </ListItemIcon>
              <ListItemText
                primary={item.label}
                primaryTypographyProps={{ 
                  fontSize: '0.875rem', 
                  fontWeight: active ? 600 : 400,
                  color: active ? '#fff' : 'rgba(255,255,255,0.8)',
                }}
              />
              {isOpen ? <ExpandLess sx={{ color: 'rgba(255,255,255,0.4)', fontSize: 20 }} />
                      : <ExpandMore sx={{ color: 'rgba(255,255,255,0.4)', fontSize: 20 }} />}
            </ListItemButton>
          </ListItem>
          <Collapse in={isOpen}>
            <List disablePadding sx={{ pl: 1 }}>
              {item.children.map(c => renderItem(c, true))}
            </List>
          </Collapse>
        </Box>
      );
    }
    const isActive = location.pathname === item.path;
    return (
      <ListItem key={item.path} disablePadding sx={{ mb: 0.5, px: 1.5 }}>
        <ListItemButton
          id={`nav-${item.label.toLowerCase().replace(/\s+/g,'-')}`}
          onClick={() => handleNavClick(item.path)}
          sx={{
            borderRadius: 2,
            py: indent ? 1 : 1.25,
            position: 'relative',
            bgcolor: isActive ? 'rgba(79, 70, 229, 0.15)' : 'transparent',
            '&:hover': { bgcolor: 'rgba(255,255,255,0.08)' },
            // Active indicator bar
            '&::before': isActive ? {
              content: '""',
              position: 'absolute',
              left: 0,
              top: '50%',
              transform: 'translateY(-50%)',
              width: 4,
              height: '60%',
              bgcolor: '#818CF8',
              borderRadius: '0 4px 4px 0',
            } : {},
          }}
        >
          <ListItemIcon sx={{ 
            color: isActive ? '#818CF8' : 'rgba(255,255,255,0.5)', 
            minWidth: 40,
            fontSize: indent ? 18 : 22,
          }}>
            {item.icon}
          </ListItemIcon>
          <ListItemText
            primary={item.label}
            primaryTypographyProps={{ 
              fontSize: indent ? '0.8125rem' : '0.875rem',
              fontWeight: isActive ? 600 : 400,
              color: isActive ? '#fff' : 'rgba(255,255,255,0.75)',
            }}
          />
        </ListItemButton>
      </ListItem>
    );
  };

  const drawerContent = (
    <Box sx={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
      {/* College branding */}
      <Box sx={{ px: 3, pt: 3, pb: 2 }}>
        <Box sx={{ display: 'flex', alignItems: 'center', gap: 1.5 }}>
          <Box
            sx={{
              width: 40,
              height: 40,
              borderRadius: 2,
              bgcolor: 'rgba(79, 70, 229, 0.2)',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
            }}
          >
            <School sx={{ color: '#818CF8', fontSize: 24 }} />
          </Box>
          <Box>
            <Typography variant="subtitle1" fontWeight={700} color="white" lineHeight={1.2}>
              STC Portal
            </Typography>
            <Typography variant="caption" sx={{ color: 'rgba(255,255,255,0.5)', fontSize: '0.7rem' }}>
              {role?.toUpperCase()} PANEL
            </Typography>
          </Box>
        </Box>
      </Box>

      <Divider sx={{ borderColor: 'rgba(255,255,255,0.08)', mx: 2 }} />

      {/* User info */}
      <Box sx={{ px: 3, py: 2, display: 'flex', alignItems: 'center', gap: 1.5 }}>
        <Avatar 
          sx={{ 
            bgcolor: 'rgba(79, 70, 229, 0.3)', 
            color: '#818CF8',
            fontWeight: 600, 
            fontSize: '0.875rem',
            width: 36,
            height: 36,
          }}
        >
          {user?.name?.[0] || user?.id?.[0] || '?'}
        </Avatar>
        <Box sx={{ minWidth: 0, flex: 1 }}>
          <Typography variant="body2" fontWeight={600} color="white" noWrap>
            {user?.name || user?.id || 'User'}
          </Typography>
          <Typography variant="caption" sx={{ color: 'rgba(255,255,255,0.5)' }} noWrap>
            {user?.dept || role}
          </Typography>
        </Box>
      </Box>

      <Divider sx={{ borderColor: 'rgba(255,255,255,0.08)', mx: 2, mb: 1 }} />

      {/* Navigation */}
      <Box sx={{ flex: 1, overflowY: 'auto', py: 1 }}>
        <List disablePadding>
          {navItems.map(item => renderItem(item))}
        </List>
      </Box>

      {/* Logout */}
      <Divider sx={{ borderColor: 'rgba(255,255,255,0.08)', mx: 2 }} />
      <Box sx={{ p: 2 }}>
        <ListItemButton
          id="nav-logout"
          onClick={handleLogout}
          sx={{ 
            borderRadius: 2, 
            py: 1.25,
            '&:hover': { bgcolor: 'rgba(239,68,68,0.15)' },
          }}
        >
          <ListItemIcon sx={{ color: '#F87171', minWidth: 40 }}>
            <Logout />
          </ListItemIcon>
          <ListItemText
            primary="Logout"
            primaryTypographyProps={{ 
              fontSize: '0.875rem', 
              color: '#F87171', 
              fontWeight: 500,
            }}
          />
        </ListItemButton>
      </Box>
    </Box>
  );

  return (
    <>
      {/* Mobile menu button */}
      {isMobile && (
        <IconButton
          onClick={() => setMobileOpen(true)}
          sx={{
            position: 'fixed',
            top: 12,
            left: 12,
            zIndex: 1300,
            bgcolor: '#111827',
            color: 'white',
            '&:hover': { bgcolor: '#1F2937' },
          }}
        >
          <Menu />
        </IconButton>
      )}

      {/* Mobile drawer */}
      <Drawer
        variant="temporary"
        open={mobileOpen}
        onClose={() => setMobileOpen(false)}
        ModalProps={{ keepMounted: true }}
        sx={{
          display: { xs: 'block', md: 'none' },
          '& .MuiDrawer-paper': {
            width: DRAWER_WIDTH,
            boxSizing: 'border-box',
            bgcolor: '#111827',
            borderRight: 'none',
          },
        }}
      >
        {drawerContent}
      </Drawer>

      {/* Desktop drawer */}
      <Drawer
        variant="permanent"
        sx={{
          display: { xs: 'none', md: 'block' },
          '& .MuiDrawer-paper': {
            width: DRAWER_WIDTH,
            boxSizing: 'border-box',
            bgcolor: '#111827',
            borderRight: 'none',
          },
        }}
      >
        {drawerContent}
      </Drawer>
    </>
  );
}

export { DRAWER_WIDTH };
