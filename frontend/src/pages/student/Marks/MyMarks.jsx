import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, Grid, CircularProgress, Alert,
  LinearProgress, Chip, Avatar, Divider,
} from '@mui/material';
import { EmojiEvents, School, Star } from '@mui/icons-material';
import { RadarChart, Radar, PolarGrid, PolarAngleAxis, ResponsiveContainer, Tooltip } from 'recharts';
import { getStudentMarks } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

const TEST_CONFIG = [
  { key:'CT1',    color:'#4F46E5', label:'Cycle Test 1', icon:'🔵' },
  { key:'CT2',    color:'#7C3AED', label:'Cycle Test 2', icon:'🟣' },
  { key:'Model',  color:'#059669', label:'Model Exam',   icon:'🟢' },
  { key:'Assignment', color:'#EA580C', label:'Assignment', icon:'🟠' },
];

function grade(mark, max) {
  if (mark == null || max == null) return '—';
  const pct = (parseFloat(mark)/max)*100;
  if (pct >= 90) return 'S';
  if (pct >= 80) return 'A';
  if (pct >= 70) return 'B';
  if (pct >= 60) return 'C';
  if (pct >= 50) return 'D';
  return 'F';
}
const GRADE_COLOR = { S:'#4F46E5', A:'#059669', B:'#0891B2', C:'#D97706', D:'#EA580C', F:'#DC2626', '—':'#9CA3AF' };

export default function MyMarks() {
  const { user } = useAuth();
  const [marks,   setMarks]   = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  useEffect(() => {
    if (!user?.id) return;
    (async () => {
      setLoading(true);
      try {
        const { data } = await getStudentMarks({ regno:user.id, batch:user.batch, sem:user.sem });
        if (data.success) setMarks(data);
        else setError(data.message || 'No marks data found.');
      } catch { setError('Could not load marks.'); }
      finally { setLoading(false); }
    })();
  }, [user]);

  if (loading) return <Box display="flex" justifyContent="center" py={10}><CircularProgress size={48}/></Box>;

  const radarData = TEST_CONFIG.map(t => {
    const info = marks?.[t.key];
    const pct  = info?.mark != null ? Math.round((parseFloat(info.mark)/info.max)*100) : 0;
    return { subject: t.label.split(' ')[0], pct, mark: info?.mark, max: info?.max };
  });

  const totalMark = TEST_CONFIG.reduce((sum, t) => {
    const m = parseFloat(marks?.[t.key]?.mark);
    return isNaN(m) ? sum : sum + m;
  }, 0);
  const totalMax = TEST_CONFIG.reduce((sum, t) => {
    const m = marks?.[t.key]?.max;
    return m ? sum + m : sum;
  }, 0);
  const overall = totalMax > 0 ? Math.round((totalMark/totalMax)*100) : 0;

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>My Internal Marks</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        {user?.name} · Batch {user?.batch} · Semester {user?.sem}
      </Typography>

      {error && <Alert severity="info" sx={{ mb:2, borderRadius: 2 }}>{error}</Alert>}

      <Grid container spacing={3}>
        {/* Mark Cards */}
        {TEST_CONFIG.map(t => {
          const info = marks?.[t.key];
          const mark = info?.mark;
          const max  = info?.max;
          const pct  = mark != null && max ? Math.round((parseFloat(mark)/max)*100) : 0;
          const g    = grade(mark, max);
          const found= info?.found;
          return (
            <Grid size={{ xs: 12, sm: 6, md: 3 }} key={t.key}>
              <Card sx={{ textAlign:'center', position:'relative', overflow:'visible' }}>
                {found && (
                  <Chip label={`Grade ${g}`} size="small"
                    sx={{ position:'absolute', top:-12, right:12, bgcolor:GRADE_COLOR[g], color:'white', fontWeight:700, borderRadius: 999 }} />
                )}
                <CardContent sx={{ pt:3 }}>
                  <Typography variant="caption" color="text.secondary" fontWeight={600}>{t.icon} {t.label}</Typography>
                  <Typography variant="h2" fontWeight={900} color={t.color} mt={0.5}>
                    {mark ?? '—'}
                  </Typography>
                  <Typography variant="body2" color="text.secondary">out of {max}</Typography>
                  {mark != null && (
                    <Box mt={1.5}>
                      <LinearProgress variant="determinate" value={pct}
                        sx={{ height:8, borderRadius:4,
                          '& .MuiLinearProgress-bar':{ bgcolor: t.color } }} />
                      <Typography variant="caption" color="text.secondary" mt={0.5} display="block">{pct}%</Typography>
                    </Box>
                  )}
                  {!found && <Typography variant="caption" color="text.secondary">Not entered yet</Typography>}
                </CardContent>
              </Card>
            </Grid>
          );
        })}

        {/* Radar Chart */}
        <Grid size={{ xs: 12, md: 5 }}>
          <Card>
            <CardContent>
              <Typography variant="h6" fontWeight={600} mb={2}>Performance Radar</Typography>
              <ResponsiveContainer width="100%" height={260}>
                <RadarChart data={radarData}>
                  <PolarGrid />
                  <PolarAngleAxis dataKey="subject" tick={{ fontSize:12 }} />
                  <Radar name="Your %" dataKey="pct" fill="#4F46E5" fillOpacity={0.25} stroke="#4F46E5" strokeWidth={2} />
                  <Tooltip formatter={(v,n,p) => [`${p.payload.mark ?? '—'} / ${p.payload.max}`, p.payload.subject]} />
                </RadarChart>
              </ResponsiveContainer>
            </CardContent>
          </Card>
        </Grid>

        {/* Summary */}
        <Grid size={{ xs: 12, md: 7 }}>
          <Card sx={{ height:'100%' }}>
            <CardContent>
              <Typography variant="h6" fontWeight={600} mb={2}>Summary</Typography>
              <Divider sx={{ mb:2 }} />

              {/* Overall Score */}
              <Box display="flex" alignItems="center" gap={2} mb={3}
                sx={{ p:2, bgcolor:'#EEF2FF', borderRadius:2 }}>
                <Avatar sx={{ bgcolor:'#4F46E5', width:52, height:52 }}>
                  <EmojiEvents />
                </Avatar>
                <Box>
                  <Typography variant="h4" fontWeight={800} color="#4F46E5">{overall}%</Typography>
                  <Typography variant="body2" color="text.secondary">
                    Overall — {Math.round(totalMark)}/{totalMax} marks
                  </Typography>
                </Box>
                <Box ml="auto" textAlign="right">
                  <Typography variant="h4" fontWeight={800} color={GRADE_COLOR[grade(totalMark,totalMax)]}>
                    {grade(totalMark,totalMax)}
                  </Typography>
                  <Typography variant="caption" color="text.secondary">Overall Grade</Typography>
                </Box>
              </Box>

              {/* Per-test summary rows */}
              {TEST_CONFIG.map(t => {
                const info = marks?.[t.key];
                const mark = info?.mark;
                const max  = info?.max;
                const pct  = mark != null && max ? Math.round((parseFloat(mark)/max)*100) : 0;
                const g    = grade(mark, max);
                return (
                  <Box key={t.key} mb={1.5}>
                    <Box display="flex" justifyContent="space-between" mb={0.5}>
                      <Typography variant="body2" fontWeight={600}>{t.label}</Typography>
                      <Box display="flex" gap={1} alignItems="center">
                        <Typography variant="body2" color={t.color} fontWeight={700}>
                          {mark ?? '—'}/{max}
                        </Typography>
                        <Chip label={g} size="small"
                          sx={{ bgcolor:GRADE_COLOR[g]+'22', color:GRADE_COLOR[g], fontWeight:700, height:20, fontSize:'0.7rem' }} />
                      </Box>
                    </Box>
                    <LinearProgress variant="determinate" value={pct}
                      sx={{ height:6, borderRadius:3, '& .MuiLinearProgress-bar':{ bgcolor: t.color } }} />
                  </Box>
                );
              })}
            </CardContent>
          </Card>
        </Grid>
      </Grid>
    </PageWrapper>
  );
}
