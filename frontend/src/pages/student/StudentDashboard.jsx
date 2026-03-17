import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box, Grid, Card, CardContent, Typography, Avatar, Chip,
  CircularProgress, Alert, Button, List, ListItem, ListItemText,
  Divider, IconButton, Tooltip, LinearProgress,
} from '@mui/material';
import {
  CheckBox, School, MenuBook, ReportProblem, EventNote,
  ArrowForward, Refresh, TrendingUp, Warning,
} from '@mui/icons-material';
import {
  RadialBarChart, RadialBar, PolarAngleAxis,
  ResponsiveContainer,
} from 'recharts';
import { useAuth } from '../../context/AuthContext';
import { getStudentDashboard } from '../../api/student';

const STATUS_CHIP = {
  safe:    { color: 'success', label: '✅ Safe'    },
  warning: { color: 'warning', label: '⚠️ Warning'  },
  danger:  { color: 'error',   label: '❌ At Risk'  },
};

const MARK_CARDS = [
  { key:'ct1',   label:'Cycle Test 1', max:25,  color:'#1565C0' },
  { key:'ct2',   label:'Cycle Test 2', max:25,  color:'#6A1B9A' },
  { key:'model', label:'Model Exam',   max:50,  color:'#00695C' },
];

const QUICK   = [
  { label:'Attendance', icon:<CheckBox />,      color:'#1565C0', route:'/student/attendance' },
  { label:'My Marks',   icon:<School />,         color:'#1A237E', route:'/student/marks'      },
  { label:'Notes',      icon:<MenuBook />,        color:'#00695C', route:'/student/notes'      },
  { label:'Events',     icon:<EventNote />,       color:'#E65100', route:'/student/events'     },
  { label:'Complaints', icon:<ReportProblem />,   color:'#B71C1C', route:'/student/complaints' },
];

export default function StudentDashboard() {
  const { user }  = useAuth();
  const navigate  = useNavigate();
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  const load = async () => {
    setLoading(true); setError('');
    try {
      const res = await getStudentDashboard(user?.id);
      if (res.data.success) setData(res.data);
      else setError(res.data.message || 'Failed to load.');
    } catch { setError('Could not reach server.'); }
    finally { setLoading(false); }
  };
  useEffect(() => { if (user?.id) load(); }, [user]);

  const att     = data?.attendance;
  const marks   = data?.marks;
  const attStatus = att?.status || (att?.pct >= 75 ? 'safe' : att?.pct >= 60 ? 'warning' : 'danger');
  const attColor  = attStatus==='safe' ? '#2E7D32' : attStatus==='warning' ? '#F57F17' : '#C62828';
  const chartData = [{ name:'Att', value: att?.pct || 0, fill: attColor }];

  return (
    <Box sx={{ p:3 }}>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Student Dashboard</Typography>
          <Typography variant="body2" color="text.secondary">
            Welcome, <b>{user?.name}</b> · {user?.dept} · Batch {user?.batch} · Sem {user?.sem}
          </Typography>
        </Box>
        <Tooltip title="Refresh"><IconButton id="student-dash-refresh" onClick={load}><Refresh /></IconButton></Tooltip>
      </Box>

      {error && <Alert severity="warning" sx={{ mb:2 }}>{error}</Alert>}

      <Grid container spacing={3} mb={3}>
        {/* Profile Card */}
        <Grid item xs={12} md={3}>
          <Card sx={{ height:'100%', background:'linear-gradient(160deg,#1A237E,#283593,#3949AB)', color:'white', textAlign:'center' }}>
            <CardContent sx={{ py:4 }}>
              <Avatar sx={{ width:72, height:72, mx:'auto', mb:2, bgcolor:'rgba(255,255,255,0.18)', fontSize:'2rem', fontWeight:700 }}>
                {user?.name?.[0] || 'S'}
              </Avatar>
              <Typography variant="h6" fontWeight={700} color="white">{user?.name}</Typography>
              <Typography variant="body2" sx={{ color:'rgba(255,255,255,0.7)', mt:0.5 }}>{user?.id}</Typography>
              <Chip label={`${user?.dept}`} size="small" sx={{ mt:1.5, bgcolor:'rgba(255,255,255,0.15)', color:'white' }} />
              <Box display="flex" justifyContent="center" gap={1} mt={1.5} flexWrap="wrap">
                <Chip size="small" label={`Batch ${user?.batch}`} sx={{ bgcolor:'rgba(255,255,255,0.12)', color:'white' }} />
                <Chip size="small" label={`Sem ${user?.sem}`} sx={{ bgcolor:'rgba(255,255,255,0.12)', color:'white' }} />
                {data?.student?.Gender && <Chip size="small" label={data.student.Gender} sx={{ bgcolor:'rgba(255,255,255,0.12)', color:'white' }} />}
              </Box>
            </CardContent>
          </Card>
        </Grid>

        {/* Attendance Radial */}
        <Grid item xs={12} md={3}>
          <Card sx={{ height:'100%', display:'flex', flexDirection:'column', justifyContent:'center' }}>
            <CardContent sx={{ textAlign:'center' }}>
              <Typography variant="h6" fontWeight={600} mb={1}>My Attendance</Typography>
              {loading ? <CircularProgress /> : (
                <>
                  <Box sx={{ height:160 }}>
                    <ResponsiveContainer width="100%" height="100%">
                      <RadialBarChart cx="50%" cy="50%" innerRadius="60%" outerRadius="90%"
                        data={chartData} startAngle={90} endAngle={-270}>
                        <PolarAngleAxis type="number" domain={[0,100]} tick={false} />
                        <RadialBar dataKey="value" cornerRadius={8} />
                        <text x="50%" y="50%" textAnchor="middle" dominantBaseline="middle"
                          fontSize={28} fontWeight={800} fill={attColor}>
                          {att?.pct ?? 0}%
                        </text>
                      </RadialBarChart>
                    </ResponsiveContainer>
                  </Box>
                  <Chip label={STATUS_CHIP[attStatus]?.label || attStatus} size="small"
                    color={STATUS_CHIP[attStatus]?.color || 'default'} sx={{ mt:1 }} />
                  <Typography variant="caption" display="block" color="text.secondary" mt={0.5}>
                    {att?.present ?? 0} / {att?.total ?? 0} days present
                  </Typography>
                </>
              )}
              <Button id="view-attendance-btn" size="small" endIcon={<ArrowForward />}
                onClick={() => navigate('/student/attendance')} sx={{ mt:1 }}>View Details</Button>
            </CardContent>
          </Card>
        </Grid>

        {/* Marks Cards */}
        <Grid item xs={12} md={6}>
          <Grid container spacing={2}>
            {MARK_CARDS.map(m => {
              const val = marks?.[m.key];
              const pct = val != null ? Math.round((parseFloat(val)/m.max)*100) : 0;
              return (
                <Grid item xs={12} sm={4} key={m.key}>
                  <Card sx={{ height:'100%' }}>
                    <CardContent sx={{ textAlign:'center' }}>
                      <Typography variant="caption" color="text.secondary" fontWeight={600}>{m.label}</Typography>
                      <Typography variant="h3" fontWeight={800} color={m.color} mt={0.5}>
                        {loading ? <CircularProgress size={28}/> : (val ?? '—')}
                      </Typography>
                      <Typography variant="caption" color="text.secondary">/{m.max}</Typography>
                      {val != null && (
                        <Box mt={1}>
                          <LinearProgress variant="determinate" value={pct}
                            color={pct>=40?'success':'error'}
                            sx={{ height:6, borderRadius:3 }} />
                        </Box>
                      )}
                    </CardContent>
                  </Card>
                </Grid>
              );
            })}
            {/* Notes Count */}
            <Grid item xs={12} sm={12}>
              <Card sx={{ bgcolor:'#F3F4F6' }}>
                <CardContent sx={{ display:'flex', alignItems:'center', gap:2, py:'12px !important' }}>
                  <Avatar sx={{ bgcolor:'#00695C18', color:'#00695C', width:44, height:44 }}><MenuBook /></Avatar>
                  <Box>
                    <Typography variant="h5" fontWeight={700}>{loading ? '…' : (data?.notesCount ?? 0)}</Typography>
                    <Typography variant="caption" color="text.secondary">Study Materials Available</Typography>
                  </Box>
                  <Box ml="auto">
                    <Button id="view-notes-btn" size="small" variant="outlined" endIcon={<ArrowForward />}
                      onClick={() => navigate('/student/notes')}>View Notes</Button>
                  </Box>
                </CardContent>
              </Card>
            </Grid>
          </Grid>
        </Grid>
      </Grid>

      {/* Quick Links */}
      <Typography variant="h6" fontWeight={600} mb={2}>Quick Access</Typography>
      <Grid container spacing={2} mb={3}>
        {QUICK.map(q => (
          <Grid item xs={6} sm={4} md={2.4} key={q.label}>
            <Card id={`quick-${q.label.toLowerCase().replace(/\s/g,'-')}`} onClick={() => navigate(q.route)}
              sx={{ cursor:'pointer', textAlign:'center', py:2.5,
                '&:hover':{ transform:'translateY(-3px)', boxShadow:'0 8px 24px rgba(0,0,0,0.12)' }, transition:'all 0.2s' }}>
              <Avatar sx={{ bgcolor:`${q.color}14`, color:q.color, mx:'auto', mb:1, width:48, height:48 }}>{q.icon}</Avatar>
              <Typography variant="body2" fontWeight={600}>{q.label}</Typography>
            </Card>
          </Grid>
        ))}
      </Grid>

      {/* Recent Events + Complaints */}
      <Grid container spacing={3}>
        <Grid item xs={12} md={6}>
          <Card>
            <CardContent>
              <Box display="flex" justifyContent="space-between" alignItems="center" mb={1.5}>
                <Typography variant="h6" fontWeight={600}>Recent Events</Typography>
                <Button size="small" endIcon={<ArrowForward />} onClick={() => navigate('/student/events')}>All Events</Button>
              </Box>
              <Divider sx={{ mb:1.5 }} />
              {loading ? <CircularProgress size={24}/> : data?.events?.length ? (
                <List dense disablePadding>
                  {data.events.map(ev => (
                    <ListItem key={ev.EventID} disablePadding sx={{ py:0.8 }}>
                      <Avatar sx={{ bgcolor:'#E8EAF6', color:'#1A237E', width:30, height:30, fontSize:12, mr:1.5 }}>
                        {ev.EventID}</Avatar>
                      <ListItemText primary={ev.EventsMsg}
                        primaryTypographyProps={{ fontSize:'0.82rem', noWrap:true }} />
                    </ListItem>
                  ))}
                </List>
              ) : <Typography variant="body2" color="text.secondary">No events found.</Typography>}
            </CardContent>
          </Card>
        </Grid>
        <Grid item xs={12} md={6}>
          <Card>
            <CardContent>
              <Box display="flex" justifyContent="space-between" alignItems="center" mb={1.5}>
                <Typography variant="h6" fontWeight={600}>My Complaints</Typography>
                <Button size="small" endIcon={<ArrowForward />} onClick={() => navigate('/student/complaints')}>Manage</Button>
              </Box>
              <Divider sx={{ mb:1.5 }} />
              {loading ? <CircularProgress size={24}/> : data?.complaints?.length ? (
                <List dense disablePadding>
                  {data.complaints.map(c => (
                    <ListItem key={c.Complaint_ID} disablePadding sx={{ py:0.8 }}>
                      <Box width="100%">
                        <Box display="flex" justifyContent="space-between">
                          <Typography variant="caption" fontWeight={600} color="text.secondary">{c.Type}</Typography>
                          <Chip label={c.Status} size="small"
                            color={c.Status==='Resolved'?'success':c.Status==='Pending'?'warning':'default'}
                            sx={{ height:18, fontSize:'0.65rem' }} />
                        </Box>
                        <Typography variant="body2" noWrap>{c.Description}</Typography>
                        <Divider sx={{ mt:0.8 }} />
                      </Box>
                    </ListItem>
                  ))}
                </List>
              ) : <Typography variant="body2" color="text.secondary">No complaints submitted.</Typography>}
            </CardContent>
          </Card>
        </Grid>
      </Grid>
    </Box>
  );
}
