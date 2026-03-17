import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box, Grid, Card, CardContent, Typography, Avatar,
  CircularProgress, Alert, Button, IconButton, Tooltip,
} from '@mui/material';
import {
  CheckBox, Assignment, MenuBook, Work, CalendarMonth,
  School, ArrowForward, Refresh,
} from '@mui/icons-material';
import { motion } from 'framer-motion';
import { useAuth } from '../../context/AuthContext';
import { getStaffDashboard } from '../../api/staff';
import { useRealTimeData, useRealTimeNotifications } from '../../hooks/useRealTimeData';
import PageWrapper from '../../components/common/PageWrapper';
import StatsCard from '../../components/common/StatsCard';
import SectionCard from '../../components/common/SectionCard';
import StatusBadge from '../../components/common/StatusBadge';
import RealTimeIndicator, { LiveNotification } from '../../components/common/RealTimeIndicator';

export default function StaffDashboard() {
  const { user }  = useAuth();
  const navigate  = useNavigate();

  // Real-time data hook
  const {
    data,
    loading,
    error,
    lastUpdate,
    isAutoRefreshing,
    refresh,
    toggleAutoRefresh,
  } = useRealTimeData(
    () => getStaffDashboard(user?.id),
    {
      refreshInterval: 30000, // 30 seconds for staff
      autoRefresh: true,
      dependencies: [user?.id],
      onDataUpdate: (newData, oldData) => {
        // Check for new assignments to review
        if (newData.assignmentsToReview > (oldData?.assignmentsToReview || 0)) {
          addNotification({
            type: 'warning',
            title: 'Assignments Pending',
            message: `${newData.assignmentsToReview} assignments need your review`,
          });
        }
        // Check for attendance updates
        if (newData.todayAttendance && oldData && newData.todayAttendance.marked !== oldData?.todayAttendance?.marked) {
          addNotification({
            type: 'info',
            title: 'Attendance Updated',
            message: `Marked attendance for ${newData.todayAttendance.marked} students today`,
          });
        }
      },
    }
  );

  // Real-time notifications
  const { notifications, addNotification, removeNotification } = useRealTimeNotifications();

  const QUICK_LINKS = [
    { label:'Mark Attendance',  icon:<CheckBox />,   color:'primary', route:'/staff/attendance' },
    { label:'Assignments',      icon:<Assignment />, color:'info', route:'/staff/assignments' },
    { label:'Upload Notes',     icon:<MenuBook />,   color:'success', route:'/staff/notes'       },
    { label:'Internal Marks',   icon:<School />,     color:'warning', route:'/staff/marks'       },
    { label:'Work Diary',       icon:<Work />,       color:'error', route:'/staff/workdiary'   },
  ];

  const LINK_COLORS = {
    primary: { bg: 'rgba(79, 70, 229, 0.1)', text: '#4F46E5' },
    info: { bg: 'rgba(59, 130, 246, 0.1)', text: '#3B82F6' },
    success: { bg: 'rgba(16, 185, 129, 0.1)', text: '#10B981' },
    warning: { bg: 'rgba(245, 158, 11, 0.1)', text: '#F59E0B' },
    error: { bg: 'rgba(239, 68, 68, 0.1)', text: '#EF4444' },
  };

  if (loading) return (
    <PageWrapper>
      <Box display="flex" justifyContent="center" mt={8}>
        <CircularProgress size={60} thickness={4} />
      </Box>
    </PageWrapper>
  );

  if (error) return (
    <PageWrapper>
      <Alert 
        severity="error" 
        sx={{ mb: 2 }}
        action={
          <Button 
            color="inherit" 
            size="small" 
            onClick={refresh}
            disabled={loading}
            startIcon={<Refresh />}
          >
            Retry
          </Button>
        }
      >
        {error}
      </Alert>
    </PageWrapper>
  );

  return (
    <PageWrapper>
      {/* Live Notifications */}
      {notifications.map((notification, index) => (
        <LiveNotification
          key={`${notification.id}-${index}`}
          notification={notification}
          onClose={removeNotification}
        />
      ))}

      {/* Real-time Status Bar */}
      <Box mb={3}>
        <RealTimeIndicator
          lastUpdate={lastUpdate}
          isAutoRefreshing={isAutoRefreshing}
          onToggleAutoRefresh={toggleAutoRefresh}
          onRefresh={refresh}
          loading={loading}
        />
      </Box>

      {/* Header */}
      <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', mb: 3, flexWrap: 'wrap', gap: 2 }}>
        <Box>
          <Typography variant="h4" fontWeight={700} color="text.primary">Dashboard</Typography>
          <Typography variant="body2" color="text.secondary" sx={{ mt: 0.5 }}>
            Welcome back, {user?.name}
          </Typography>
        </Box>
        <Tooltip title="Manual Refresh">
          <IconButton 
            id="staff-dash-refresh" 
            onClick={refresh}
            disabled={loading}
            sx={{ 
              bgcolor: 'primary.main', 
              color: 'white',
              '&:hover': { bgcolor: 'primary.dark' },
              '&:disabled': { bgcolor: 'grey.300' },
            }}
          >
            <motion.div
              animate={loading ? { rotate: 360 } : { rotate: 0 }}
              transition={{ duration: 1, repeat: loading ? Infinity : 0, ease: 'linear' }}
            >
              <Refresh />
            </motion.div>
          </IconButton>
        </Tooltip>
      </Box>

      {/* Error Display */}
      {error && <Alert severity="warning" sx={{ mb: 3 }}>{error}</Alert>}

      <Grid container spacing={3} sx={{ mb: 3 }}>
        {/* Staff Profile Card */}
        <Grid item xs={12} md={4}>
          <Card 
            component={motion.div}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            sx={{ height: '100%' }}
          >
            <CardContent sx={{ textAlign: 'center', py: 4 }}>
              <Avatar 
                sx={{ 
                  width: 72, 
                  height: 72, 
                  mx: 'auto', 
                  mb: 2, 
                  bgcolor: 'rgba(79, 70, 229, 0.1)', 
                  color: '#4F46E5',
                  fontSize: '1.75rem', 
                  fontWeight: 700 
                }}
              >
                {user?.name?.[0] || 'S'}
              </Avatar>
              <Typography variant="h5" fontWeight={700} color="text.primary">{user?.name}</Typography>
              <Typography variant="body2" color="text.secondary" sx={{ mt: 0.5 }}>
                {data?.staff?.Designation || 'Staff'}
              </Typography>
              <Box sx={{ mt: 1.5 }}>
                <StatusBadge status={user?.dept} color="primary" />
              </Box>
              {data?.staff?.Domain && (
                <Typography variant="caption" color="text.secondary" display="block" sx={{ mt: 1.5 }}>
                  Domain: {data.staff.Domain}
                </Typography>
              )}
            </CardContent>
          </Card>
        </Grid>

        {/* Stats */}
        <Grid item xs={12} md={8}>
          <Grid container spacing={2}>
            {[
              { label: 'Notes Uploaded', value: loading ? '—' : (data?.notesCount ?? 0), color: 'success', icon: <MenuBook /> },
              { label: 'Work Diary (Month)', value: loading ? '—' : (data?.workDiaryThisMonth ?? 0), color: 'warning', icon: <Work /> },
              { label: 'Staff ID', value: user?.id, color: 'primary', icon: <School /> },
              { label: 'Department', value: user?.dept, color: 'info', icon: <CalendarMonth /> },
            ].map((s, idx) => (
              <Grid item xs={6} key={s.label}>
                <motion.div
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: idx * 0.1 }}
                >
                  <StatsCard
                    label={s.label}
                    value={s.value}
                    icon={s.icon}
                    color={s.color}
                    loading={loading}
                  />
                </motion.div>
              </Grid>
            ))}
          </Grid>
        </Grid>
      </Grid>

      {/* Quick Links */}
      <Typography variant="h6" fontWeight={600} color="text.primary" sx={{ mb: 2 }}>
        Quick Actions
      </Typography>
      <Grid container spacing={2} sx={{ mb: 3 }}>
        {QUICK_LINKS.map((link, idx) => (
          <Grid item xs={6} sm={4} md={2.4} key={link.label}>
            <Card
              component={motion.div}
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: idx * 0.05 }}
              whileHover={{ y: -4 }}
              id={`quick-${link.label.toLowerCase().replace(/\s+/g,'-')}`}
              onClick={() => navigate(link.route)}
              sx={{ 
                cursor: 'pointer', 
                textAlign: 'center', 
                py: 3,
                '&:hover': { 
                  boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.1)',
                },
              }}
            >
              <Box
                sx={{ 
                  width: 52, 
                  height: 52, 
                  borderRadius: 2,
                  bgcolor: LINK_COLORS[link.color].bg, 
                  color: LINK_COLORS[link.color].text, 
                  mx: 'auto', 
                  mb: 1.5,
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                }}
              >
                {link.icon}
              </Box>
              <Typography variant="body2" fontWeight={500} color="text.primary">{link.label}</Typography>
            </Card>
          </Grid>
        ))}
      </Grid>

      {/* Allocations */}
      {data?.allocations?.length > 0 && (
        <SectionCard 
          title="My Class Allocations"
          actions={
            <Button 
              size="small" 
              endIcon={<ArrowForward sx={{ fontSize: 16 }} />} 
              onClick={() => navigate('/staff/attendance')}
              sx={{ color: '#4F46E5', fontWeight: 500 }}
            >
              Mark Attendance
            </Button>
          }
        >
          <Grid container spacing={2}>
            {data.allocations.map((a, i) => (
              <Grid item xs={12} sm={6} md={4} key={i}>
                <Box 
                  sx={{ 
                    p: 2, 
                    bgcolor: '#F9FAFB', 
                    borderRadius: 2,
                    border: '1px solid #E5E7EB',
                  }}
                >
                  <Typography variant="body2" fontWeight={600} color="text.primary">
                    Batch {a.Batch} · Sem {a.sem ?? a.Sem}
                  </Typography>
                  <Typography variant="caption" color="text.secondary">
                    {a.Department} · {a.SubjectCode ?? a.SubjectName ?? '—'}
                  </Typography>
                </Box>
              </Grid>
            ))}
          </Grid>
        </SectionCard>
      )}
    </PageWrapper>
  );
}
