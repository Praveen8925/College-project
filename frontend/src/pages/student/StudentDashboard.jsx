import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box, Grid, Card, CardContent, Typography, Avatar, Chip,
  CircularProgress, Alert, Button, List, ListItem, ListItemText,
  Divider, IconButton, Tooltip, LinearProgress,
} from '@mui/material';
import {
  CheckBox, School, MenuBook, ReportProblem, EventNote,
  ArrowForward, Refresh, Assignment, CalendarMonth, Settings,
} from '@mui/icons-material';
import {
  RadialBarChart, RadialBar, PolarAngleAxis,
  ResponsiveContainer,
} from 'recharts';
import { motion } from 'framer-motion';
import { useAuth } from '../../context/AuthContext';
import { getStudentDashboard } from '../../api/student';
import { useRealTimeData, useRealTimeNotifications } from '../../hooks/useRealTimeData';
import PageWrapper from '../../components/common/PageWrapper';
import SectionCard from '../../components/common/SectionCard';
import StatusBadge from '../../components/common/StatusBadge';
import RealTimeIndicator, { LiveNotification } from '../../components/common/RealTimeIndicator';

const STATUS_CHIP = {
  safe:    { color: 'success', label: 'Safe'    },
  warning: { color: 'warning', label: 'Warning'  },
  danger:  { color: 'error',   label: 'At Risk'  },
};

const MARK_CARDS = [
  { key:'ct1',   label:'Cycle Test 1', max:25,  color:'#4F46E5' },
  { key:'ct2',   label:'Cycle Test 2', max:25,  color:'#7C3AED' },
  { key:'model', label:'Model Exam',   max:50,  color:'#059669' },
];

const QUICK = [
  { label:'Attendance',  icon:<CheckBox />,      color:'#4F46E5', route:'/student/attendance'  },
  { label:'Assignments', icon:<Assignment />,    color:'#7C3AED', route:'/student/assignments' },
  { label:'My Marks',    icon:<School />,        color:'#2563EB', route:'/student/marks'       },
  { label:'Notes',       icon:<MenuBook />,      color:'#059669', route:'/student/notes'       },
  { label:'Timetable',   icon:<CalendarMonth />, color:'#0891B2', route:'/student/timetable'   },
  { label:'Events',      icon:<EventNote />,     color:'#EA580C', route:'/student/events'      },
  { label:'Complaints',  icon:<ReportProblem />, color:'#DC2626', route:'/student/complaints'  },
  { label:'Settings',    icon:<Settings />,      color:'#6B7280', route:'/student/settings'    },
];

export default function StudentDashboard() {
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
    () => getStudentDashboard(user?.id),
    {
      refreshInterval: 45000, // 45 seconds for students
      autoRefresh: true,
      dependencies: [user?.id],
      onDataUpdate: (newData, oldData) => {
        // Check for attendance changes
        if (newData.attendance?.pct !== oldData?.attendance?.pct) {
          addNotification({
            type: 'info',
            title: 'Attendance Updated',
            message: `Your attendance is now ${newData.attendance.pct}%`,
          });
        }
        // Check for new notes
        if (newData.notesCount > (oldData?.notesCount || 0)) {
          addNotification({
            type: 'success',
            title: 'New Study Material',
            message: 'New notes have been uploaded by your instructor',
          });
        }
      },
    }
  );

  // Real-time notifications
  const { notifications, addNotification, removeNotification } = useRealTimeNotifications();

  const att     = data?.attendance;
  const marks   = data?.marks;
  const attStatus = att?.status || (att?.pct >= 75 ? 'safe' : att?.pct >= 60 ? 'warning' : 'danger');
  const attColor  = attStatus==='safe' ? '#10B981' : attStatus==='warning' ? '#F59E0B' : '#EF4444';
  const chartData = [{ name:'Att', value: att?.pct || 0, fill: attColor }];

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
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700} color="text.primary">Student Dashboard</Typography>
          <Typography variant="body2" color="text.secondary">
            Welcome back, <b>{user?.name}</b> · {user?.dept} · Batch {user?.batch} · Sem {user?.sem}
          </Typography>
        </Box>
        <Tooltip title="Manual Refresh">
          <IconButton 
            id="student-dash-refresh" 
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
      {error && <Alert severity="warning" sx={{ mb: 2, borderRadius: 2 }}>{error}</Alert>}

      <Grid container spacing={3} mb={3}>
        {/* Profile Card */}
        <Grid size={{ xs: 12, md: 3 }}>
          <motion.div whileHover={{ y: -4 }} transition={{ duration: 0.2 }}>
            <Card sx={{ 
              height:'100%', 
              textAlign:'center',
              borderLeft: '4px solid #4F46E5'
            }}>
              <CardContent sx={{ py:4 }}>
                <Avatar sx={{ 
                  width:72, height:72, mx:'auto', mb:2, 
                  bgcolor:'#4F46E5', 
                  fontSize:'1.75rem', 
                  fontWeight:700 
                }}>
                  {user?.name?.[0] || 'S'}
                </Avatar>
                <Typography variant="h6" fontWeight={700}>{user?.name}</Typography>
                <Typography variant="body2" color="text.secondary" mt={0.5}>{user?.id}</Typography>
                <Box display="flex" justifyContent="center" gap={1} mt={2} flexWrap="wrap">
                  <Chip label={user?.dept} size="small" sx={{ bgcolor:'#EEF2FF', color:'#4F46E5', fontWeight:600 }} />
                  <Chip label={`Batch ${user?.batch}`} size="small" variant="outlined" />
                  <Chip label={`Sem ${user?.sem}`} size="small" variant="outlined" />
                </Box>
                {data?.student?.Gender && (
                  <Chip size="small" label={data.student.Gender} sx={{ mt:1 }} variant="outlined" />
                )}
              </CardContent>
            </Card>
          </motion.div>
        </Grid>

        {/* Attendance Radial */}
        <Grid size={{ xs: 12, md: 3 }}>
          <motion.div whileHover={{ y: -4 }} transition={{ duration: 0.2 }}>
            <Card sx={{ height:'100%', display:'flex', flexDirection:'column', justifyContent:'center' }}>
              <CardContent sx={{ textAlign:'center' }}>
                <Typography variant="subtitle1" fontWeight={600} mb={1} color="text.secondary">
                  My Attendance
                </Typography>
                {loading ? <CircularProgress /> : (
                  <>
                    <Box sx={{ height:150 }}>
                      <ResponsiveContainer width="100%" height="100%">
                        <RadialBarChart cx="50%" cy="50%" innerRadius="65%" outerRadius="90%"
                          data={chartData} startAngle={90} endAngle={-270}>
                          <PolarAngleAxis type="number" domain={[0,100]} tick={false} />
                          <RadialBar dataKey="value" cornerRadius={10} />
                          <text x="50%" y="50%" textAnchor="middle" dominantBaseline="middle"
                            fontSize={26} fontWeight={700} fill={attColor}>
                            {att?.pct ?? 0}%
                          </text>
                        </RadialBarChart>
                      </ResponsiveContainer>
                    </Box>
                    <StatusBadge status={attStatus === 'safe' ? 'Safe' : attStatus === 'warning' ? 'Warning' : 'At Risk'} />
                    <Typography variant="caption" display="block" color="text.secondary" mt={1}>
                      {att?.present ?? 0} / {att?.total ?? 0} days present
                    </Typography>
                  </>
                )}
                <Button id="view-attendance-btn" size="small" endIcon={<ArrowForward />}
                  onClick={() => navigate('/student/attendance')} sx={{ mt:1.5 }}>
                  View Details
                </Button>
              </CardContent>
            </Card>
          </motion.div>
        </Grid>

        {/* Marks Cards */}
        <Grid size={{ xs: 12, md: 6 }}>
          <Grid container spacing={2}>
            {MARK_CARDS.map((m, idx) => {
              const val = marks?.[m.key];
              const pct = val != null ? Math.round((parseFloat(val)/m.max)*100) : 0;
              return (
                <Grid size={{ xs: 12, sm: 4 }} key={m.key}>
                  <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: idx * 0.1 }}
                    whileHover={{ y: -4 }}
                  >
                    <Card sx={{ height:'100%', borderTop: `3px solid ${m.color}` }}>
                      <CardContent sx={{ textAlign:'center' }}>
                        <Typography variant="caption" color="text.secondary" fontWeight={600}>
                          {m.label}
                        </Typography>
                        <Typography variant="h3" fontWeight={700} color={m.color} mt={0.5}>
                          {loading ? <CircularProgress size={28}/> : (val ?? '—')}
                        </Typography>
                        <Typography variant="caption" color="text.secondary">/{m.max}</Typography>
                        {val != null && (
                          <Box mt={1.5}>
                            <LinearProgress 
                              variant="determinate" 
                              value={pct}
                              sx={{ 
                                height:6, 
                                borderRadius:3,
                                bgcolor: '#E5E7EB',
                                '& .MuiLinearProgress-bar': {
                                  bgcolor: pct >= 40 ? '#10B981' : '#EF4444',
                                  borderRadius: 3
                                }
                              }} 
                            />
                          </Box>
                        )}
                      </CardContent>
                    </Card>
                  </motion.div>
                </Grid>
              );
            })}
            {/* Notes Count */}
            <Grid size={{ xs: 12 }}>
              <Card sx={{ bgcolor:'#F9FAFB', border: '1px solid #E5E7EB' }}>
                <CardContent sx={{ display:'flex', alignItems:'center', gap:2, py:'12px !important' }}>
                  <Avatar sx={{ bgcolor:'#ECFDF5', color:'#059669', width:44, height:44 }}>
                    <MenuBook />
                  </Avatar>
                  <Box>
                    <Typography variant="h5" fontWeight={700} color="text.primary">
                      {loading ? '…' : (data?.notesCount ?? 0)}
                    </Typography>
                    <Typography variant="caption" color="text.secondary">Study Materials Available</Typography>
                  </Box>
                  <Box ml="auto">
                    <Button id="view-notes-btn" size="small" variant="outlined" endIcon={<ArrowForward />}
                      onClick={() => navigate('/student/notes')}>
                      View Notes
                    </Button>
                  </Box>
                </CardContent>
              </Card>
            </Grid>
          </Grid>
        </Grid>
      </Grid>

      {/* Quick Links */}
      <SectionCard title="Quick Access">
        <Grid container spacing={2}>
          {QUICK.map((q, idx) => (
            <Grid size={{ xs: 6, sm: 4, md: 3, lg: 1.5 }} key={q.label}>
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: idx * 0.05 }}
                whileHover={{ y: -4 }}
              >
                <Card 
                  id={`quick-${q.label.toLowerCase().replace(/\s/g,'-')}`} 
                  onClick={() => navigate(q.route)}
                  sx={{ 
                    cursor:'pointer', 
                    textAlign:'center', 
                    py:2.5,
                    border: '1px solid #E5E7EB',
                    '&:hover': { 
                      borderColor: q.color,
                      boxShadow: `0 4px 12px ${q.color}20`
                    }, 
                    transition:'all 0.2s' 
                  }}
                >
                  <Avatar sx={{ 
                    bgcolor:`${q.color}12`, 
                    color:q.color, 
                    mx:'auto', 
                    mb:1, 
                    width:48, 
                    height:48 
                  }}>
                    {q.icon}
                  </Avatar>
                  <Typography variant="body2" fontWeight={600}>{q.label}</Typography>
                </Card>
              </motion.div>
            </Grid>
          ))}
        </Grid>
      </SectionCard>

      {/* Recent Events + Complaints */}
      <Grid container spacing={3} mt={1}>
        <Grid size={{ xs: 12, md: 6 }}>
          <SectionCard 
            title="Recent Events"
            action={
              <Button size="small" endIcon={<ArrowForward />} onClick={() => navigate('/student/events')}>
                All Events
              </Button>
            }
          >
            {loading ? <CircularProgress size={24}/> : data?.events?.length ? (
              <List dense disablePadding>
                {data.events.map((ev, idx) => (
                  <motion.div
                    key={ev.EventID}
                    initial={{ opacity: 0, x: -10 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: idx * 0.05 }}
                  >
                    <ListItem disablePadding sx={{ py:1 }}>
                      <Avatar sx={{ 
                        bgcolor:'#EEF2FF', 
                        color:'#4F46E5', 
                        width:32, 
                        height:32, 
                        fontSize:12, 
                        mr:1.5,
                        fontWeight: 600
                      }}>
                        {ev.EventID}
                      </Avatar>
                      <ListItemText 
                        primary={ev.EventsMsg}
                        primaryTypographyProps={{ fontSize:'0.875rem', noWrap:true }} 
                      />
                    </ListItem>
                    {idx < data.events.length - 1 && <Divider />}
                  </motion.div>
                ))}
              </List>
            ) : (
              <Typography variant="body2" color="text.secondary" textAlign="center" py={2}>
                No events found.
              </Typography>
            )}
          </SectionCard>
        </Grid>

        <Grid size={{ xs: 12, md: 6 }}>
          <SectionCard 
            title="My Complaints"
            action={
              <Button size="small" endIcon={<ArrowForward />} onClick={() => navigate('/student/complaints')}>
                Manage
              </Button>
            }
          >
            {loading ? <CircularProgress size={24}/> : data?.complaints?.length ? (
              <List dense disablePadding>
                {data.complaints.map((c, idx) => (
                  <motion.div
                    key={c.Complaint_ID}
                    initial={{ opacity: 0, x: -10 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: idx * 0.05 }}
                  >
                    <ListItem disablePadding sx={{ py:1 }}>
                      <Box width="100%">
                        <Box display="flex" justifyContent="space-between" alignItems="center" mb={0.5}>
                          <Typography variant="caption" fontWeight={600} color="text.secondary">
                            {c.Type}
                          </Typography>
                          <StatusBadge status={c.Status} />
                        </Box>
                        <Typography variant="body2" noWrap color="text.primary">{c.Description}</Typography>
                      </Box>
                    </ListItem>
                    {idx < data.complaints.length - 1 && <Divider sx={{ my: 1 }} />}
                  </motion.div>
                ))}
              </List>
            ) : (
              <Typography variant="body2" color="text.secondary" textAlign="center" py={2}>
                No complaints submitted.
              </Typography>
            )}
          </SectionCard>
        </Grid>
      </Grid>
    </PageWrapper>
  );
}
