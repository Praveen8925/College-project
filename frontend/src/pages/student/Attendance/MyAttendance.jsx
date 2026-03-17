import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, CircularProgress, Alert,
  Grid, LinearProgress, Chip, Avatar,
} from '@mui/material';
import {
  CheckCircle, Warning, Cancel,
} from '@mui/icons-material';
import { RadialBarChart, RadialBar, PolarAngleAxis, ResponsiveContainer } from 'recharts';
import { getStudentAttendance } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

const STATUS = {
  safe:    { color:'success', icon:<CheckCircle color="success"/>, label:'Attendance Safe (≥75%)',      bg:'#ECFDF5', border:'#059669' },
  warning: { color:'warning', icon:<Warning color="warning"/>,     label:'Attendance Warning (60–74%)',  bg:'#FFFBEB', border:'#D97706' },
  danger:  { color:'error',   icon:<Cancel color="error"/>,       label:'Attendance Critical (<60%)',   bg:'#FEF2F2', border:'#DC2626' },
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
  const attColor = s==='safe'?'#10B981':s==='warning'?'#F59E0B':'#EF4444';
  const chartColor = s==='safe'?'#10B981':s==='warning'?'#F59E0B':'#EF4444';
  const info   = STATUS[s] || STATUS.danger;

  // Calculate days needed for 75%
  let daysNeeded = 0;
  if (pct < 75 && total > 0) {
    daysNeeded = Math.ceil((0.75*total - present)/0.25);
    if (daysNeeded < 0) daysNeeded = 0;
  }

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>My Attendance</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        {user?.name} · Batch {user?.batch} · Semester {user?.sem}
      </Typography>

      {error && <Alert severity="warning" sx={{ mb:2, borderRadius: 2 }}>{error}</Alert>}

      <Grid container spacing={3}>
        {/* Big Radial */}
        <Grid size={{ xs: 12, md: 4 }}>
          <Card sx={{ textAlign:'center', py:3 }}>
            <CardContent>
              <Typography variant="subtitle1" fontWeight={600} mb={2} color="text.secondary">Attendance Overview</Typography>
              <Box sx={{ height:220 }}>
                <ResponsiveContainer width="100%" height="100%">
                  <RadialBarChart cx="50%" cy="50%" innerRadius="65%" outerRadius="95%"
                    data={[{name:'att',value:pct,fill:chartColor}]} startAngle={90} endAngle={-270}>
                    <PolarAngleAxis type="number" domain={[0,100]} tick={false} />
                    <RadialBar dataKey="value" cornerRadius={10} background={{ fill:'#F3F4F6' }} />
                    <text x="50%" y="46%" textAnchor="middle" dominantBaseline="middle"
                      fontSize={36} fontWeight={700} fill={attColor}>
                      {pct}%
                    </text>
                    <text x="50%" y="58%" textAnchor="middle" dominantBaseline="middle"
                      fontSize={13} fill="#6B7280">Attendance</text>
                  </RadialBarChart>
                </ResponsiveContainer>
              </Box>
              <Chip icon={info.icon} label={info.label} color={info.color} size="small" sx={{ mt:1, borderRadius: 999 }} />
            </CardContent>
          </Card>
        </Grid>

        {/* Stats */}
        <Grid size={{ xs: 12, md: 8 }}>
          <Grid container spacing={2}>
            {[
              { label:'Working Days',   value:total,   color:'#4F46E5', sub:'Total classes held' },
              { label:'Days Present',   value:present, color:'#10B981', sub:'Classes attended'   },
              { label:'Days Absent',    value:absent,  color:'#EF4444', sub:'Classes missed'      },
            ].map(stat => (
              <Grid size={{ xs: 4 }} key={stat.label}>
                <Card sx={{ textAlign:'center', py:2, borderTop: `3px solid ${stat.color}` }}>
                  <CardContent sx={{ py:'12px !important' }}>
                    <Typography variant="h3" fontWeight={700} color={stat.color}>{stat.value}</Typography>
                    <Typography variant="body2" fontWeight={600}>{stat.label}</Typography>
                    <Typography variant="caption" color="text.secondary">{stat.sub}</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>

          {/* Progress Bar */}
          <Card sx={{ mt:2, p:2 }}>
            <Typography variant="body2" fontWeight={600} mb={1}>Attendance Breakdown</Typography>
            <Box mb={0.5} display="flex" justifyContent="space-between">
              <Typography variant="caption" color="#10B981">Present</Typography>
              <Typography variant="caption" color="#EF4444">Absent</Typography>
            </Box>
            <Box position="relative" sx={{ bgcolor:'#FEE2E2', borderRadius:4, height:14, overflow:'hidden' }}>
              <Box sx={{
                position:'absolute', left:0, top:0, bottom:0,
                width:`${total > 0 ? (present/total)*100 : 0}%`,
                bgcolor:'#10B981', borderRadius:4, transition:'width 1s ease',
              }} />
            </Box>
            <Box display="flex" justifyContent="space-between" mt={0.5}>
              <Typography variant="caption">{present} days</Typography>
              <Typography variant="caption">{absent} days</Typography>
            </Box>

            {/* Required target */}
            <Box mt={2} p={1.5} sx={{ bgcolor: s==='safe'?'#ECFDF5':'#FFF7ED', borderRadius:2 }}>
              {s === 'safe' ? (
                <Typography variant="body2" color="#059669">
                  🎉 Great! You have maintained ≥75% attendance. Keep it up!
                </Typography>
              ) : (
                <Typography variant="body2" color="#D97706">
                  ⚠️ You need to attend <b>{daysNeeded}</b> more consecutive class{daysNeeded!==1?'es':''} to reach 75%.
                </Typography>
              )}
            </Box>

            {/* 75% threshold line indicator */}
            <Box mt={2}>
              <Box display="flex" justifyContent="space-between" mb={0.5}>
                <Typography variant="caption" fontWeight={600}>Progress towards 75% target</Typography>
                <Typography variant="caption" fontWeight={700} color={s==='safe'?'#10B981':'#EF4444'}>{pct}% / 75%</Typography>
              </Box>
              <LinearProgress variant="determinate" value={Math.min(100, (pct/75)*100)}
                sx={{ 
                  height:10, borderRadius:5, bgcolor: '#E5E7EB',
                  '& .MuiLinearProgress-bar': { 
                    bgcolor: s==='safe' ? '#10B981' : s==='warning' ? '#F59E0B' : '#EF4444',
                    borderRadius: 5
                  }
                }} />
            </Box>
          </Card>
        </Grid>

        {/* Info Note */}
        <Grid size={{ xs: 12 }}>
          <Alert severity={s==='safe'?'success':s==='warning'?'warning':'error'} icon={info.icon} sx={{ borderRadius: 2 }}>
            <strong>{info.label}</strong> — Your current attendance is <strong>{pct}%</strong>.
            {att?.table && <span style={{fontSize:'0.75rem', marginLeft:8, opacity:0.6}}>Source: {att.table}</span>}
          </Alert>
        </Grid>
      </Grid>
    </PageWrapper>
  );
}
