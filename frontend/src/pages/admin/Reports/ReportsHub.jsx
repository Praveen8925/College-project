import { useEffect, useState } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, CircularProgress, Alert,
  Divider, Avatar, Chip, LinearProgress, IconButton, Tooltip,
} from '@mui/material';
import {
  People, School, EventNote, ReportProblem, MenuBook,
  TrendingUp, CheckCircle, Warning, Cancel, Refresh,
} from '@mui/icons-material';
import {
  BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip as RTooltip,
  Legend, ResponsiveContainer, PieChart, Pie, Cell, LineChart,
  Line, RadarChart, Radar, PolarGrid, PolarAngleAxis,
} from 'recharts';
import { getReportsSummary } from '../../../api/reports';

const COLORS = ['#1A237E','#C62828','#2E7D32','#E65100','#4A148C','#00838F'];
const GRADE_COLOR = {S:'#1A237E',A:'#2E7D32',B:'#00838F',C:'#F57F17',D:'#E65100',F:'#C62828'};

const Stat = ({ icon, label, value, color = '#1A237E', sub }) => (
  <Card sx={{ height:'100%' }}>
    <CardContent sx={{ display:'flex', alignItems:'center', gap:2 }}>
      <Avatar sx={{ bgcolor:`${color}18`, color, width:52, height:52 }}>{icon}</Avatar>
      <Box>
        <Typography variant="h4" fontWeight={800} color={color}>{value}</Typography>
        <Typography variant="body2" fontWeight={600}>{label}</Typography>
        {sub && <Typography variant="caption" color="text.secondary">{sub}</Typography>}
      </Box>
    </CardContent>
  </Card>
);

export default function ReportsHub() {
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  const load = async () => {
    setLoading(true); setError('');
    try {
      const { data: d } = await getReportsSummary();
      if (d.success) setData(d);
      else setError(d.message || 'Failed to load.');
    } catch { setError('Could not reach server.'); }
    finally { setLoading(false); }
  };
  useEffect(() => { load(); }, []);

  if (loading) return <Box display="flex" justifyContent="center" py={10}><CircularProgress size={56}/></Box>;
  if (error)   return <Box p={3}><Alert severity="error">{error}</Alert></Box>;

  const t = data?.totals || {};

  // Chart data
  const batchChartData = (data?.byBatch || []).reduce((acc, r) => {
    const ex = acc.find(x => x.batch === Number(r.Batch));
    if (ex) { ex.total += Number(r.total); }
    else acc.push({ batch: Number(r.Batch), total: Number(r.total) });
    return acc;
  }, []).sort((a,b)=>a.batch-b.batch);

  const attChartData = (data?.attendance || []).map(r => ({
    label: `Batch ${r.Batch} S${r.sem}`,
    avg: parseFloat(r.avg_pct),
    defaulters: Number(r.defaulters),
    students: Number(r.students),
  }));

  const complaintData = (data?.complaints || []).map(r => ({
    name: r.Type, value: Number(r.total), resolved: Number(r.resolved), pending: Number(r.pending),
  }));

  const staffDeptData = (data?.staff || []).reduce((acc, r) => {
    const ex = acc.find(x => x.dept === r.Department);
    if (ex) ex.total += Number(r.total);
    else acc.push({ dept: r.Department, total: Number(r.total) });
    return acc;
  }, []);

  const marksRadar = [
    { subject:'CT1',   avg: data?.marks?.ct1?.[0]?.avg_mark   ?? 0, max: 25 },
    { subject:'CT2',   avg: data?.marks?.ct2?.[0]?.avg_mark   ?? 0, max: 25 },
    { subject:'Model', avg: data?.marks?.model?.[0]?.avg_mark ?? 0, max: 50 },
  ];

  return (
    <Box sx={{ p:3 }}>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={800}>Reports & Analytics</Typography>
          <Typography variant="body2" color="text.secondary">Comprehensive overview of the institution</Typography>
        </Box>
        <Tooltip title="Refresh"><IconButton id="reports-refresh" onClick={load}><Refresh /></IconButton></Tooltip>
      </Box>

      {/* ── KPI Row ────────────────────────────── */}
      <Grid container spacing={2} mb={3}>
        <Grid item xs={6} sm={4} md={2}>
          <Stat icon={<People/>}       label="Total Students"    value={t.students}         color="#1A237E" sub={`${t.activeStudents} active`} />
        </Grid>
        <Grid item xs={6} sm={4} md={2}>
          <Stat icon={<School/>}       label="Total Staff"       value={t.staff}            color="#2E7D32" sub={`${t.depts} departments`} />
        </Grid>
        <Grid item xs={6} sm={4} md={2}>
          <Stat icon={<People/>}       label="Alumni"            value={t.alumniStudents}   color="#00838F" />
        </Grid>
        <Grid item xs={6} sm={4} md={2}>
          <Stat icon={<MenuBook/>}     label="Notes Uploaded"    value={t.notes}            color="#6A1B9A" />
        </Grid>
        <Grid item xs={6} sm={4} md={2}>
          <Stat icon={<EventNote/>}    label="Events"            value={t.events}           color="#E65100" />
        </Grid>
        <Grid item xs={6} sm={4} md={2}>
          <Stat icon={<ReportProblem/>} label="Complaints" value={t.complaints}
            color="#C62828" sub={`${t.complaintsPending} pending`} />
        </Grid>
      </Grid>

      {/* ── Charts Row 1 ───────────────────────── */}
      <Grid container spacing={3} mb={3}>
        {/* Student by Batch */}
        <Grid item xs={12} md={5}>
          <Card>
            <CardContent>
              <Typography variant="h6" fontWeight={700} mb={2}>📊 Students by Batch Year</Typography>
              <ResponsiveContainer width="100%" height={220}>
                <BarChart data={batchChartData} margin={{top:0,right:10,left:-10,bottom:0}}>
                  <CartesianGrid strokeDasharray="3 3" stroke="#F0F0F0" />
                  <XAxis dataKey="batch" tick={{fontSize:12}} />
                  <YAxis tick={{fontSize:12}} />
                  <RTooltip />
                  <Bar dataKey="total" name="Students" radius={[4,4,0,0]}>
                    {batchChartData.map((_, i) => <Cell key={i} fill={COLORS[i % COLORS.length]} />)}
                  </Bar>
                </BarChart>
              </ResponsiveContainer>
            </CardContent>
          </Card>
        </Grid>

        {/* Avg Attendance */}
        <Grid item xs={12} md={7}>
          <Card>
            <CardContent>
              <Typography variant="h6" fontWeight={700} mb={2}>📋 Attendance Overview (by Batch/Sem)</Typography>
              {attChartData.length === 0
                ? <Typography color="text.secondary" textAlign="center" py={4}>No attendance data found</Typography>
                : <ResponsiveContainer width="100%" height={220}>
                    <BarChart data={attChartData} margin={{top:0,right:10,left:-10,bottom:0}}>
                      <CartesianGrid strokeDasharray="3 3" stroke="#F0F0F0" />
                      <XAxis dataKey="label" tick={{fontSize:10}} />
                      <YAxis tick={{fontSize:12}} domain={[0,100]} />
                      <RTooltip />
                      <Legend wrapperStyle={{fontSize:12}} />
                      <Bar dataKey="avg" name="Avg % Present" fill="#1A237E" radius={[4,4,0,0]} />
                      <Bar dataKey="defaulters" name="Defaulters" fill="#C62828" radius={[4,4,0,0]} />
                    </BarChart>
                  </ResponsiveContainer>
              }
            </CardContent>
          </Card>
        </Grid>
      </Grid>

      {/* ── Charts Row 2 ─────────────────────── */}
      <Grid container spacing={3} mb={3}>
        {/* Complaint pie */}
        <Grid item xs={12} md={4}>
          <Card>
            <CardContent>
              <Typography variant="h6" fontWeight={700} mb={2}>⚠️ Complaints by Type</Typography>
              {complaintData.length === 0
                ? <Typography color="text.secondary" textAlign="center" py={4}>No complaints</Typography>
                : <>
                    <ResponsiveContainer width="100%" height={180}>
                      <PieChart>
                        <Pie data={complaintData} dataKey="value" nameKey="name" cx="50%" cy="50%"
                          outerRadius={75} label={({name,value})=>`${name}:${value}`} labelLine={false}
                          fontSize={10}>
                          {complaintData.map((_,i)=><Cell key={i} fill={COLORS[i%COLORS.length]}/>)}
                        </Pie>
                        <RTooltip />
                      </PieChart>
                    </ResponsiveContainer>
                    <Box mt={1}>
                      {complaintData.slice(0,5).map((c,i) => (
                        <Box key={i} display="flex" justifyContent="space-between" py={0.3}>
                          <Typography variant="caption">{c.name}</Typography>
                          <Box display="flex" gap={0.5}>
                            <Chip label={`${c.resolved} resolved`} size="small" color="success"
                              sx={{height:16,fontSize:'0.6rem'}} />
                            <Chip label={`${c.pending} pending`} size="small" color="warning"
                              sx={{height:16,fontSize:'0.6rem'}} />
                          </Box>
                        </Box>
                      ))}
                    </Box>
                  </>
              }
            </CardContent>
          </Card>
        </Grid>

        {/* Staff by dept */}
        <Grid item xs={12} md={4}>
          <Card>
            <CardContent>
              <Typography variant="h6" fontWeight={700} mb={2}>👥 Staff by Department</Typography>
              <ResponsiveContainer width="100%" height={260}>
                <BarChart data={staffDeptData} layout="vertical" margin={{top:0,right:10,left:0,bottom:0}}>
                  <CartesianGrid strokeDasharray="3 3" />
                  <XAxis type="number" tick={{fontSize:11}} />
                  <YAxis dataKey="dept" type="category" tick={{fontSize:9}} width={80} />
                  <RTooltip />
                  <Bar dataKey="total" name="Staff" fill="#2E7D32" radius={[0,4,4,0]} />
                </BarChart>
              </ResponsiveContainer>
            </CardContent>
          </Card>
        </Grid>

        {/* Marks radar */}
        <Grid item xs={12} md={4}>
          <Card>
            <CardContent>
              <Typography variant="h6" fontWeight={700} mb={2}>📝 Avg Marks Overview</Typography>
              <ResponsiveContainer width="100%" height={200}>
                <RadarChart data={marksRadar}>
                  <PolarGrid />
                  <PolarAngleAxis dataKey="subject" tick={{fontSize:12}} />
                  <Radar name="Avg Mark" dataKey="avg" fill="#1A237E" fillOpacity={0.3} stroke="#1A237E" strokeWidth={2} />
                  <RTooltip />
                </RadarChart>
              </ResponsiveContainer>
              <Divider sx={{my:1.5}}/>
              <Box display="flex" justifyContent="space-around">
                {marksRadar.map(m => (
                  <Box key={m.subject} textAlign="center">
                    <Typography variant="h5" fontWeight={800} color="#1A237E">{m.avg || '—'}</Typography>
                    <Typography variant="caption" color="text.secondary">{m.subject} avg</Typography>
                    <Typography variant="caption" display="block" color="text.secondary">/{m.max}</Typography>
                  </Box>
                ))}
              </Box>
            </CardContent>
          </Card>
        </Grid>
      </Grid>

      {/* ── Work Diary Leaderboard ─────────────── */}
      {data?.diary?.length > 0 && (
        <Card>
          <CardContent>
            <Typography variant="h6" fontWeight={700} mb={2}>📔 Most Active Work Diary — Top 10 Staff</Typography>
            <Grid container spacing={2}>
              {data.diary.map((d, i) => (
                <Grid item xs={6} sm={4} md={2.4} key={d.SID}>
                  <Box display="flex" alignItems="center" gap={1} p={1.5}
                    sx={{bgcolor:'#F8F9FF',borderRadius:2}}>
                    <Avatar sx={{
                      width:32, height:32, fontSize:13, fontWeight:800,
                      bgcolor: i===0?'#FFD700':i===1?'#C0C0C0':i===2?'#CD7F32':'#E8EAF6',
                      color: i<3?'#333':'#1A237E',
                    }}>
                      {i+1}
                    </Avatar>
                    <Box>
                      <Typography variant="caption" fontWeight={700} display="block">{d.SID}</Typography>
                      <Typography variant="caption" color="text.secondary">{d.entries} entries</Typography>
                    </Box>
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
