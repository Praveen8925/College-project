import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box, Grid, Card, CardContent, Typography, Avatar, Chip,
  CircularProgress, Alert, Button, List, ListItem, ListItemText,
  Divider, IconButton, Tooltip,
} from '@mui/material';
import {
  CheckBox, Assignment, MenuBook, Work, CalendarMonth,
  School, ArrowForward, Refresh,
} from '@mui/icons-material';
import api from '../../utils/axiosInstance';
import { useAuth } from '../../context/AuthContext';

export default function StaffDashboard() {
  const { user }  = useAuth();
  const navigate  = useNavigate();
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  const load = async () => {
    setLoading(true); setError('');
    try {
      const res = await api.get('/staff/dashboard.php', { params: { sid: user?.id } });
      if (res.data.success) setData(res.data);
      else setError(res.data.message || 'Failed to load dashboard.');
    } catch {
      setError('Could not reach server. Is WAMP running?');
    } finally { setLoading(false); }
  };

  useEffect(() => { if (user?.id) load(); }, [user]);

  const QUICK_LINKS = [
    { label:'Mark Attendance',  icon:<CheckBox />,   color:'#1565C0', route:'/staff/attendance' },
    { label:'Assignments',      icon:<Assignment />, color:'#6A1B9A', route:'/staff/assignments' },
    { label:'Upload Notes',     icon:<MenuBook />,   color:'#00695C', route:'/staff/notes'       },
    { label:'Internal Marks',   icon:<School />,     color:'#1A237E', route:'/staff/marks'       },
    { label:'Work Diary',       icon:<Work />,       color:'#E65100', route:'/staff/workdiary'   },
  ];

  return (
    <Box sx={{ p: 3 }}>
      {/* Header */}
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Staff Dashboard</Typography>
          <Typography variant="body2" color="text.secondary">
            Welcome, <b>{user?.name}</b> · {user?.dept}
            {' · '}{new Date().toLocaleDateString('en-IN',{weekday:'long',day:'numeric',month:'long',year:'numeric'})}
          </Typography>
        </Box>
        <Tooltip title="Refresh"><IconButton id="staff-dash-refresh" onClick={load}><Refresh /></IconButton></Tooltip>
      </Box>

      {error && <Alert severity="warning" sx={{ mb:2 }}>{error}</Alert>}

      {/* Info Cards */}
      <Grid container spacing={3} mb={3}>
        {/* Staff Profile Card */}
        <Grid item xs={12} md={4}>
          <Card sx={{ height:'100%', background:'linear-gradient(135deg,#1A237E,#3949AB)', color:'white' }}>
            <CardContent sx={{ textAlign:'center', py:4 }}>
              <Avatar sx={{ width:72, height:72, mx:'auto', mb:2, bgcolor:'rgba(255,255,255,0.2)', fontSize:'2rem', fontWeight:700 }}>
                {user?.name?.[0] || 'S'}
              </Avatar>
              <Typography variant="h5" fontWeight={700} color="white">{user?.name}</Typography>
              <Typography variant="body2" sx={{ color:'rgba(255,255,255,0.75)', mt:0.5 }}>{data?.staff?.Designation || 'Staff'}</Typography>
              <Chip label={user?.dept} size="small" sx={{ mt:1.5, bgcolor:'rgba(255,255,255,0.2)', color:'white', fontWeight:600 }} />
              {data?.staff?.Domain && (
                <Typography variant="caption" display="block" sx={{ color:'rgba(255,255,255,0.6)', mt:1 }}>
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
              { label:'Notes Uploaded',      value: loading ? '…' : (data?.notesCount ?? 0),         color:'#00695C', icon:<MenuBook /> },
              { label:'Work Diary (Month)',   value: loading ? '…' : (data?.workDiaryThisMonth ?? 0), color:'#E65100', icon:<Work />     },
              { label:'My Staff ID',          value: user?.id,                                          color:'#1A237E', icon:<School />   },
              { label:'Department',           value: user?.dept,                                         color:'#6A1B9A', icon:<CalendarMonth /> },
            ].map((s) => (
              <Grid item xs={6} key={s.label}>
                <Card>
                  <CardContent sx={{ display:'flex', alignItems:'center', gap:2 }}>
                    <Avatar sx={{ bgcolor:`${s.color}18`, color:s.color, width:48, height:48 }}>{s.icon}</Avatar>
                    <Box>
                      <Typography variant="h5" fontWeight={700}>{loading ? <CircularProgress size={20}/> : s.value}</Typography>
                      <Typography variant="body2" color="text.secondary">{s.label}</Typography>
                    </Box>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>
        </Grid>
      </Grid>

      {/* Quick Links */}
      <Typography variant="h6" fontWeight={600} mb={2}>Quick Actions</Typography>
      <Grid container spacing={2} mb={3}>
        {QUICK_LINKS.map(link => (
          <Grid item xs={6} sm={4} md={2.4} key={link.label}>
            <Card
              id={`quick-${link.label.toLowerCase().replace(/\s+/g,'-')}`}
              onClick={() => navigate(link.route)}
              sx={{ cursor:'pointer', textAlign:'center', py:3,
                '&:hover':{ transform:'translateY(-3px)', boxShadow:'0 8px 24px rgba(0,0,0,0.12)' },
                transition:'all 0.2s' }}
            >
              <Avatar sx={{ bgcolor:`${link.color}18`, color:link.color, mx:'auto', mb:1, width:52, height:52 }}>
                {link.icon}
              </Avatar>
              <Typography variant="body2" fontWeight={600} color="text.primary">{link.label}</Typography>
            </Card>
          </Grid>
        ))}
      </Grid>

      {/* Allocations */}
      {data?.allocations?.length > 0 && (
        <Card>
          <CardContent>
            <Box display="flex" justifyContent="space-between" alignItems="center" mb={1.5}>
              <Typography variant="h6" fontWeight={600}>My Class Allocations</Typography>
              <Button size="small" endIcon={<ArrowForward />} onClick={() => navigate('/staff/attendance')}>Mark Attendance</Button>
            </Box>
            <Divider sx={{ mb:1.5 }} />
            <Grid container spacing={1}>
              {data.allocations.map((a, i) => (
                <Grid item xs={12} sm={6} md={4} key={i}>
                  <Box sx={{ p:1.5, bgcolor:'#F4F6F8', borderRadius:2 }}>
                    <Typography variant="body2" fontWeight={700}>Batch {a.Batch} · Sem {a.sem ?? a.Sem}</Typography>
                    <Typography variant="caption" color="text.secondary">{a.Department} · {a.SubjectCode ?? a.SubjectName ?? '—'}</Typography>
                  </Box>
                </Grid>
              ))}
            </Grid>
          </CardContent>
        </Card>
      )}
    </Box>
  );
}
