import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box, Grid, Card, CardContent, Typography, Avatar, Divider,
  List, ListItem, ListItemText, Chip, CircularProgress, Alert,
  Paper, Button, IconButton, Tooltip,
} from '@mui/material';
import {
  People, Group, EventNote, ReportProblem, School,
  ArrowForward, Refresh,
} from '@mui/icons-material';
import { BarChart, Bar, XAxis, YAxis, Tooltip as RTooltip, ResponsiveContainer, Cell } from 'recharts';
import { getDashboardStats } from '../../api/dashboard';
import { useAuth } from '../../context/AuthContext';

const STAT_CARDS = [
  { key: 'students',   label: 'Total Students',   icon: <People />,       color: '#1A237E', route: '/admin/students',   bgGrad: 'linear-gradient(135deg,#1A237E,#3949AB)' },
  { key: 'staff',      label: 'Total Staff',       icon: <Group />,        color: '#1565C0', route: '/admin/staff',      bgGrad: 'linear-gradient(135deg,#1565C0,#1E88E5)' },
  { key: 'events',     label: 'Active Events',     icon: <EventNote />,    color: '#00695C', route: '/admin/events',     bgGrad: 'linear-gradient(135deg,#00695C,#26A69A)' },
  { key: 'complaints', label: 'Open Complaints',   icon: <ReportProblem />,color: '#BF360C', route: '/admin/complaints', bgGrad: 'linear-gradient(135deg,#BF360C,#EF6C00)' },
];

const STATUS_COLOR = { Pending: 'warning', Resolved: 'success', default: 'default' };

export default function AdminDashboard() {
  const { user } = useAuth();
  const navigate  = useNavigate();
  const [stats,   setStats]   = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  const load = async () => {
    setLoading(true); setError('');
    try {
      const { data } = await getDashboardStats();
      if (data.success) setStats(data);
      else setError(data.message || 'Failed to load stats.');
    } catch {
      setError('Could not reach server. Is WAMP running?');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => { load(); }, []);

  const chartData = stats ? [
    { name: 'Students',   value: stats.stats.students },
    { name: 'Staff',      value: stats.stats.staff    },
    { name: 'Events',     value: stats.stats.events   },
    { name: 'Complaints', value: stats.stats.complaints },
  ] : [];
  const CHART_COLORS = ['#3949AB','#1E88E5','#26A69A','#EF6C00'];

  return (
    <Box sx={{ p: 3 }}>
      {/* Header */}
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Admin Dashboard</Typography>
          <Typography variant="body2" color="text.secondary">
            Welcome back, <b>Administrator</b> · {new Date().toLocaleDateString('en-IN', { weekday:'long', year:'numeric', month:'long', day:'numeric' })}
          </Typography>
        </Box>
        <Tooltip title="Refresh"><IconButton onClick={load} id="dashboard-refresh-btn"><Refresh /></IconButton></Tooltip>
      </Box>

      {error && <Alert severity="error" sx={{ mb: 2 }}>{error}</Alert>}

      {/* Stat Cards */}
      <Grid container spacing={3} mb={3}>
        {STAT_CARDS.map((card) => (
          <Grid item xs={12} sm={6} md={3} key={card.key}>
            <Card
              id={`stat-card-${card.key}`}
              sx={{
                cursor: 'pointer', background: card.bgGrad,
                '&:hover': { transform: 'translateY(-3px)', boxShadow: '0 8px 24px rgba(0,0,0,0.2)' },
                transition: 'all 0.2s ease',
              }}
              onClick={() => navigate(card.route)}
            >
              <CardContent sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', py: 2.5 }}>
                <Box>
                  <Typography variant="h3" fontWeight={800} color="white">
                    {loading ? <CircularProgress size={28} sx={{ color: 'white' }} /> : (stats?.stats[card.key] ?? '—')}
                  </Typography>
                  <Typography variant="body2" sx={{ color: 'rgba(255,255,255,0.8)', mt: 0.5 }}>{card.label}</Typography>
                </Box>
                <Avatar sx={{ bgcolor: 'rgba(255,255,255,0.18)', width: 52, height: 52 }}>
                  {card.icon}
                </Avatar>
              </CardContent>
            </Card>
          </Grid>
        ))}
      </Grid>

      <Grid container spacing={3}>
        {/* Bar Chart */}
        <Grid item xs={12} md={5}>
          <Card sx={{ height: '100%' }}>
            <CardContent>
              <Typography variant="h6" fontWeight={600} mb={2}>Overview</Typography>
              {loading ? (
                <Box display="flex" justifyContent="center" py={5}><CircularProgress /></Box>
              ) : (
                <ResponsiveContainer width="100%" height={220}>
                  <BarChart data={chartData} barCategoryGap="35%">
                    <XAxis dataKey="name" tick={{ fontSize: 12 }} />
                    <YAxis tick={{ fontSize: 12 }} allowDecimals={false} />
                    <RTooltip />
                    <Bar dataKey="value" radius={[6,6,0,0]}>
                      {chartData.map((_, i) => <Cell key={i} fill={CHART_COLORS[i]} />)}
                    </Bar>
                  </BarChart>
                </ResponsiveContainer>
              )}
            </CardContent>
          </Card>
        </Grid>

        {/* Recent Events */}
        <Grid item xs={12} md={3.5}>
          <Card sx={{ height: '100%' }}>
            <CardContent>
              <Box display="flex" justifyContent="space-between" alignItems="center" mb={1.5}>
                <Typography variant="h6" fontWeight={600}>Recent Events</Typography>
                <Button id="view-all-events-btn" size="small" endIcon={<ArrowForward />}
                  onClick={() => navigate('/admin/events')}>View All</Button>
              </Box>
              <Divider sx={{ mb: 1.5 }} />
              {loading ? <CircularProgress size={24} /> : stats?.recentEvents?.length ? (
                <List dense disablePadding>
                  {stats.recentEvents.map((ev) => (
                    <ListItem key={ev.EventID} disablePadding sx={{ py: 0.8 }}>
                      <Avatar sx={{ bgcolor: '#E8EAF6', color: '#1A237E', width: 32, height: 32, mr: 1.5, fontSize: 14 }}>
                        {ev.EventID}
                      </Avatar>
                      <ListItemText
                        primary={ev.EventsMsg}
                        primaryTypographyProps={{ fontSize: '0.82rem', noWrap: true }}
                      />
                    </ListItem>
                  ))}
                </List>
              ) : <Typography variant="body2" color="text.secondary">No events found.</Typography>}
            </CardContent>
          </Card>
        </Grid>

        {/* Recent Complaints */}
        <Grid item xs={12} md={3.5}>
          <Card sx={{ height: '100%' }}>
            <CardContent>
              <Box display="flex" justifyContent="space-between" alignItems="center" mb={1.5}>
                <Typography variant="h6" fontWeight={600}>Recent Complaints</Typography>
                <Button id="view-all-complaints-btn" size="small" endIcon={<ArrowForward />}
                  onClick={() => navigate('/admin/complaints')}>View All</Button>
              </Box>
              <Divider sx={{ mb: 1.5 }} />
              {loading ? <CircularProgress size={24} /> : stats?.recentComplaints?.length ? (
                <List dense disablePadding>
                  {stats.recentComplaints.map((c) => (
                    <ListItem key={c.Complaint_ID} disablePadding sx={{ py: 0.8, flexDirection:'column', alignItems:'flex-start' }}>
                      <Box display="flex" justifyContent="space-between" width="100%">
                        <Typography variant="caption" fontWeight={600} color="text.secondary">{c.Type}</Typography>
                        <Chip label={c.Status} size="small"
                          color={STATUS_COLOR[c.Status] || 'default'}
                          sx={{ height: 18, fontSize: '0.65rem' }} />
                      </Box>
                      <Typography variant="body2" noWrap sx={{ maxWidth:'100%' }}>{c.Description}</Typography>
                      <Divider sx={{ width:'100%', mt: 0.8 }} />
                    </ListItem>
                  ))}
                </List>
              ) : <Typography variant="body2" color="text.secondary">No complaints found.</Typography>}
            </CardContent>
          </Card>
        </Grid>
      </Grid>
    </Box>
  );
}
