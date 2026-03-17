import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, CircularProgress, Alert,
  Grid, LinearProgress, Chip, Avatar,
} from '@mui/material';
import {
  CheckCircle, Warning, Cancel, EventBusy,
} from '@mui/icons-material';
import { RadialBarChart, RadialBar, PolarAngleAxis, ResponsiveContainer } from 'recharts';
import { getStudentAttendance } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';

const STATUS = {
  safe:    { color:'success', icon:<CheckCircle color="success"/>, label:'Attendance Safe (≥75%)',      bg:'#E8F5E9', border:'#2E7D32' },
  warning: { color:'warning', icon:<Warning color="warning"/>,     label:'Attendance Warning (60–74%)',  bg:'#FFF8E1', border:'#F57F17' },
  danger:  { color:'error',   icon:<Cancel color="error"/>,       label:'Attendance Critical (<60%)',   bg:'#FFEBEE', border:'#C62828' },
};

export default function MyAttendance() {
  const { user } = useAuth();
  const [att,     setAtt]     = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  useEffect(() => {
    if (!user?.id) return;
    (async () => {
      setLoading(true);
      try {
        const { data } = await getStudentAttendance({ regno:user.id, batch:user.batch, sem:user.sem });
        if (data.success) setAtt(data);
        else setError(data.message || 'No attendance data found.');
      } catch (err) {
        setError(err.response?.data?.message || 'Could not load attendance.');
      } finally { setLoading(false); }
    })();
  }, [user]);

  if (loading) return <Box display="flex" justifyContent="center" py={10}><CircularProgress size={48}/></Box>;

  const s      = att?.status || 'danger';
  const pct    = att?.pct   || 0;
  const total  = att?.total || 0;
  const present= att?.present || 0;
  const absent = att?.absent  || 0;
  const attColor = s==='safe'?'#2E7D32':s==='warning'?'F57F17':'#C62828';
  const chartColor = s==='safe'?'#4CAF50':s==='warning'?'#FFC107':'#F44336';
  const info   = STATUS[s] || STATUS.danger;

  // Calculate days needed for 75%
  let daysNeeded = 0;
  if (pct < 75 && total > 0) {
    // (present+x)/(total+x) >= 0.75 => x >= (0.75*total - present)/0.25
    daysNeeded = Math.ceil((0.75*total - present)/0.25);
    if (daysNeeded < 0) daysNeeded = 0;
  }

  return (
    <Box sx={{ p:3 }}>
      <Typography variant="h5" fontWeight={700} mb={0.5}>My Attendance</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        {user?.name} · Batch {user?.batch} · Semester {user?.sem}
      </Typography>

      {error && <Alert severity="warning" sx={{ mb:2 }}>{error}</Alert>}

      <Grid container spacing={3}>
        {/* Big Radial */}
        <Grid item xs={12} md={4}>
          <Card sx={{ textAlign:'center', py:3 }}>
            <CardContent>
              <Typography variant="h6" fontWeight={600} mb={2}>Attendance Overview</Typography>
              <Box sx={{ height:220 }}>
                <ResponsiveContainer width="100%" height="100%">
                  <RadialBarChart cx="50%" cy="50%" innerRadius="65%" outerRadius="95%"
                    data={[{name:'att',value:pct,fill:chartColor}]} startAngle={90} endAngle={-270}>
                    <PolarAngleAxis type="number" domain={[0,100]} tick={false} />
                    <RadialBar dataKey="value" cornerRadius={10} background={{ fill:'#F4F4F4' }} />
                    <text x="50%" y="46%" textAnchor="middle" dominantBaseline="middle"
                      fontSize={38} fontWeight={900} fill={attColor}>
                      {pct}%
                    </text>
                    <text x="50%" y="58%" textAnchor="middle" dominantBaseline="middle"
                      fontSize={13} fill="#888">Attendance</text>
                  </RadialBarChart>
                </ResponsiveContainer>
              </Box>
              <Chip icon={info.icon} label={info.label} color={info.color} size="small" sx={{ mt:1 }} />
            </CardContent>
          </Card>
        </Grid>

        {/* Stats */}
        <Grid item xs={12} md={8}>
          <Grid container spacing={2}>
            {[
              { label:'Working Days',   value:total,   color:'#1A237E', sub:'Total classes held' },
              { label:'Days Present',   value:present, color:'#2E7D32', sub:'Classes attended'   },
              { label:'Days Absent',    value:absent,  color:'#C62828', sub:'Classes missed'      },
            ].map(s => (
              <Grid item xs={4} key={s.label}>
                <Card sx={{ textAlign:'center', py:2 }}>
                  <CardContent sx={{ py:'12px !important' }}>
                    <Typography variant="h3" fontWeight={800} color={s.color}>{s.value}</Typography>
                    <Typography variant="body2" fontWeight={600}>{s.label}</Typography>
                    <Typography variant="caption" color="text.secondary">{s.sub}</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>

          {/* Progress Bar */}
          <Card sx={{ mt:2, p:2 }}>
            <Typography variant="body2" fontWeight={600} mb={1}>Attendance Breakdown</Typography>
            <Box mb={0.5} display="flex" justifyContent="space-between">
              <Typography variant="caption" color="success.main">Present</Typography>
              <Typography variant="caption" color="error.main">Absent</Typography>
            </Box>
            <Box position="relative" sx={{ bgcolor:'#FFCDD2', borderRadius:4, height:14, overflow:'hidden' }}>
              <Box sx={{
                position:'absolute', left:0, top:0, bottom:0,
                width:`${total > 0 ? (present/total)*100 : 0}%`,
                bgcolor:'#4CAF50', borderRadius:4, transition:'width 1s ease',
              }} />
            </Box>
            <Box display="flex" justifyContent="space-between" mt={0.5}>
              <Typography variant="caption">{present} days</Typography>
              <Typography variant="caption">{absent} days</Typography>
            </Box>

            {/* Required target */}
            <Box mt={2} p={1.5} sx={{ bgcolor: s==='safe'?'#E8F5E9':'#FFF3E0', borderRadius:2 }}>
              {s === 'safe' ? (
                <Typography variant="body2" color="success.main">
                  🎉 Great! You have maintained ≥75% attendance. Keep it up!
                </Typography>
              ) : (
                <Typography variant="body2" color="warning.main">
                  ⚠️ You need to attend <b>{daysNeeded}</b> more consecutive class{daysNeeded!==1?'es':''} to reach 75%.
                </Typography>
              )}
            </Box>

            {/* 75% threshold line indicator */}
            <Box mt={2}>
              <Box display="flex" justifyContent="space-between" mb={0.5}>
                <Typography variant="caption" fontWeight={600}>Progress towards 75% target</Typography>
                <Typography variant="caption" fontWeight={700} color={s==='safe'?'success.main':'error.main'}>{pct}% / 75%</Typography>
              </Box>
              <LinearProgress variant="determinate" value={Math.min(100, (pct/75)*100)}
                color={s==='safe'?'success':s==='warning'?'warning':'error'}
                sx={{ height:10, borderRadius:5 }} />
            </Box>
          </Card>
        </Grid>

        {/* Info Note */}
        <Grid item xs={12}>
          <Alert severity={s==='safe'?'success':s==='warning'?'warning':'error'} icon={info.icon}>
            <strong>{info.label}</strong> — Your current attendance is <strong>{pct}%</strong>.
            {att?.table && <span style={{fontSize:'0.75rem', marginLeft:8, opacity:0.6}}>Source: {att.table}</span>}
          </Alert>
        </Grid>
      </Grid>
    </Box>
  );
}
