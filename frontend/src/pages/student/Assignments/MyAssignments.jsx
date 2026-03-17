import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, CircularProgress, Alert,
  Grid, Chip, Avatar, Divider, LinearProgress,
} from '@mui/material';
import { Assignment, CheckCircle, HourglassEmpty, EmojiEvents } from '@mui/icons-material';
import { getStudentAssignments } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

function ScoreBar({ mark, max, color }) {
  const pct = mark != null && max ? Math.round((parseFloat(mark) / max) * 100) : 0;
  return (
    <Box mt={1}>
      <Box display="flex" justifyContent="space-between" mb={0.5}>
        <Typography variant="caption" color="text.secondary">Score</Typography>
        <Typography variant="caption" fontWeight={700} color={color}>{pct}%</Typography>
      </Box>
      <LinearProgress
        variant="determinate" value={pct}
        sx={{ height: 8, borderRadius: 4, bgcolor: '#F0F0F0',
          '& .MuiLinearProgress-bar': { bgcolor: color, borderRadius: 4 } }}
      />
    </Box>
  );
}

function gradeLabel(mark, max) {
  if (mark == null || mark === '' || !max) return null;
  const pct = (parseFloat(mark) / max) * 100;
  if (pct >= 90) return { label: 'S', color: '#4F46E5' };
  if (pct >= 80) return { label: 'A', color: '#059669' };
  if (pct >= 70) return { label: 'B', color: '#0891B2' };
  if (pct >= 60) return { label: 'C', color: '#D97706' };
  if (pct >= 50) return { label: 'D', color: '#EA580C' };
  return { label: 'F', color: '#DC2626' };
}

export default function MyAssignments() {
  const { user }  = useAuth();
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  useEffect(() => {
    if (!user?.id) return;
    (async () => {
      setLoading(true);
      try {
        const { data: res } = await getStudentAssignments({
          regno: user.id, batch: user.batch, sem: user.sem,
        });
        if (res.success) setData(res);
        else setError(res.message || 'No assignment data found.');
      } catch (err) {
        setError(err.response?.data?.message || 'Could not load assignments.');
      } finally { setLoading(false); }
    })();
  }, [user]);

  if (loading) return (
    <Box display="flex" justifyContent="center" py={10}><CircularProgress size={48} /></Box>
  );

  const row      = data?.data;
  const markData = data?.markData;
  const totalMark= markData?.total ?? null;
  const parts    = markData?.parts  ?? [];
  const max      = parts.length > 0 ? parts.length * 5 : 25;   // 5 marks each assignment
  const decided  = (markData?.decided || data?.decided || 'n').toLowerCase() === 'y';
  const grade    = gradeLabel(totalMark, max);
  const questions= data?.questions || [];

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>My Assignments</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        {user?.name} · Batch {user?.batch} · Semester {user?.sem}
      </Typography>

      {error && <Alert severity="info" sx={{ mb: 2, borderRadius: 2 }}>{error}</Alert>}

      <Grid container spacing={3}>
        {/* Assignment Mark Card */}
        <Grid size={{ xs: 12, md: 4 }}>
          <Card sx={{ height: '100%', background: 'linear-gradient(135deg,#4F46E5,#7C3AED)', color: 'white' }}>
            <CardContent sx={{ textAlign: 'center', py: 4 }}>
              <Avatar sx={{ bgcolor: 'rgba(255,255,255,0.15)', width: 64, height: 64, mx: 'auto', mb: 2 }}>
                <EmojiEvents sx={{ fontSize: 36 }} />
              </Avatar>
              <Typography variant="overline" sx={{ opacity: 0.8 }}>Assignment Mark</Typography>
              <Typography variant="h2" fontWeight={900} mt={0.5}>
                {decided && totalMark != null ? totalMark : '—'}
              </Typography>
              <Typography variant="body2" sx={{ opacity: 0.7 }}>out of {max}</Typography>

              {decided && totalMark != null && (
                <>
                  <Chip
                    label={`Grade ${grade?.label}`}
                    size="small"
                    sx={{ mt: 2, bgcolor: 'rgba(255,255,255,0.2)', color: 'white', fontWeight: 700, borderRadius: 999 }}
                  />
                  <Box mt={2} px={2}>
                    <LinearProgress
                      variant="determinate"
                      value={Math.round((totalMark / max) * 100)}
                      sx={{ height: 8, borderRadius: 4, bgcolor: 'rgba(255,255,255,0.2)',
                        '& .MuiLinearProgress-bar': { bgcolor: 'white', borderRadius: 4 } }}
                    />
                    <Typography variant="caption" sx={{ opacity: 0.75, mt: 0.5, display: 'block' }}>
                      {Math.round((totalMark / max) * 100)}% scored
                    </Typography>
                  </Box>
                </>
              )}

              {!decided && (
                <Box mt={2}>
                  <Chip
                    icon={<HourglassEmpty sx={{ color: 'white !important' }} />}
                    label="Mark Not Yet Assigned"
                    size="small"
                    sx={{ bgcolor: 'rgba(255,193,7,0.3)', color: 'white', borderRadius: 999 }}
                  />
                </Box>
              )}
            </CardContent>
          </Card>
        </Grid>

        {/* Status + Stats */}
        <Grid size={{ xs: 12, md: 8 }}>
          <Grid container spacing={2}>
            {[
              {
                label: 'Status',
                value: decided ? 'Marks Released' : 'Pending',
                sub: decided ? 'Your assignment has been evaluated' : 'Waiting for staff to assign marks',
                color: decided ? '#059669' : '#EA580C',
                icon: decided ? <CheckCircle sx={{ fontSize: 32 }} /> : <HourglassEmpty sx={{ fontSize: 32 }} />,
                bg: decided ? '#ECFDF5' : '#FFF7ED',
              },
              {
                label: 'Max Marks',
                value: max,
                sub: 'Total marks for assignment',
                color: '#4F46E5',
                icon: <Assignment sx={{ fontSize: 32 }} />,
                bg: '#EEF2FF',
              },
              {
                label: 'Semester',
                value: `Sem ${user?.sem}`,
                sub: `Batch ${user?.batch} · ${user?.dept}`,
                color: '#7C3AED',
                icon: <EmojiEvents sx={{ fontSize: 32 }} />,
                bg: '#F5F3FF',
              },
            ].map((s) => (
              <Grid size={{ xs: 12, sm: 4 }} key={s.label}>
                <Card sx={{ bgcolor: s.bg, height: '100%' }}>
                  <CardContent>
                    <Box display="flex" alignItems="center" gap={1.5} mb={1}>
                      <Avatar sx={{ bgcolor: s.color, width: 40, height: 40, color: 'white' }}>
                        {s.icon}
                      </Avatar>
                      <Typography variant="body2" color="text.secondary" fontWeight={600}>{s.label}</Typography>
                    </Box>
                    <Typography variant="h5" fontWeight={800} color={s.color}>{s.value}</Typography>
                    <Typography variant="caption" color="text.secondary">{s.sub}</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>

          {/* Score breakdown if marks given */}
          {decided && totalMark != null && (
            <Card sx={{ mt: 2 }}>
              <CardContent>
                <Typography variant="subtitle1" fontWeight={700} mb={1}>Score Breakdown</Typography>
                <ScoreBar mark={totalMark} max={max} color={grade?.color || '#4F46E5'} />
                <Box display="flex" gap={1} mt={2} flexWrap="wrap">
                  {parts.map((m, i) => (
                    <Chip key={i} label={`Assignment ${i + 1}: ${m}`} size="small"
                      sx={{ bgcolor: '#F3F4F6', fontWeight: 600 }} />
                  ))}
                  <Chip label={`Total: ${totalMark} / ${max}`} size="small"
                    sx={{ bgcolor: '#EEF2FF', color: '#4F46E5', fontWeight: 700 }} />
                </Box>
              </CardContent>
            </Card>
          )}
        </Grid>

        {/* Assignment Questions / Descriptions */}
        {questions.length > 0 && (
          <Grid size={{ xs: 12 }}>
            <Card>
              <CardContent>
                <Typography variant="h6" fontWeight={700} mb={2}>
                  Assignment Questions
                </Typography>
                {questions.map((q, i) => (
                  <Box key={i}>
                    <Box display="flex" gap={2} py={1.5}>
                      <Avatar sx={{ bgcolor: '#EEF2FF', color: '#4F46E5', width: 32, height: 32,
                        fontSize: 14, fontWeight: 700, flexShrink: 0 }}>
                        {i + 1}
                      </Avatar>
                      <Box>
                        {q.Course && (
                          <Chip label={q.Course} size="small"
                            sx={{ mb: 0.5, bgcolor: '#F5F3FF', color: '#7C3AED', fontWeight: 600 }} />
                        )}
                        {q.topic && (
                          <Typography variant="caption" color="text.secondary" display="block">
                            Topic: {q.topic}
                          </Typography>
                        )}
                        <Typography variant="body2" sx={{ mt: 0.5 }}>
                          {q.question || q.Question || q.Description || '—'}
                        </Typography>
                        {q.sdate && (
                          <Typography variant="caption" color="text.secondary">
                            {q.sdate} → {q.ldate || '—'}
                          </Typography>
                        )}
                      </Box>
                    </Box>
                    {i < questions.length - 1 && <Divider />}
                  </Box>
                ))}
              </CardContent>
            </Card>
          </Grid>
        )}

        {/* Empty state when no data at all */}
        {!row && !error && (
          <Grid size={{ xs: 12 }}>
            <Box py={6} textAlign="center">
              <Assignment sx={{ fontSize: 56, color: '#D1D5DB', mb: 2 }} />
              <Typography color="text.secondary">
                No assignment record found for Sem {user?.sem}, Batch {user?.batch}.
              </Typography>
              <Typography variant="caption" color="text.secondary">
                Your class staff may not have entered assignment marks yet.
              </Typography>
            </Box>
          </Grid>
        )}
      </Grid>
    </PageWrapper>
  );
}