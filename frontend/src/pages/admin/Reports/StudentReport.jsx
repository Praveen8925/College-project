import { useState, useRef } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  CircularProgress, Alert, Chip, Avatar, Divider, Table, TableHead,
  TableRow, TableCell, TableBody, LinearProgress, Paper,
} from '@mui/material';
import {
  Print, Search, Person, School, CheckCircle, Warning, Cancel,
  Grade, Assignment, EventNote,
} from '@mui/icons-material';
import {
  RadarChart, Radar, PolarGrid, PolarAngleAxis, ResponsiveContainer,
  BarChart, Bar, XAxis, YAxis, Tooltip, Cell, Legend,
} from 'recharts';
import { getStudentReport } from '../../../api/reports';
import PageWrapper from '../../../components/common/PageWrapper';

const ATT_STATUS = {
  safe:    { color: '#059669', label: 'Safe',     icon: <CheckCircle /> },
  warning: { color: '#D97706', label: 'Warning',  icon: <Warning /> },
  risk:    { color: '#DC2626', label: 'At Risk',  icon: <Cancel /> },
};
const attStatus = (pct) => pct >= 75 ? 'safe' : pct >= 60 ? 'warning' : 'risk';

const GRADE_COLOR = { S: '#4F46E5', A: '#059669', B: '#0891B2', C: '#D97706', D: '#EA580C', F: '#DC2626' };
const getGrade = (pct) => {
  if (pct >= 90) return 'S';
  if (pct >= 80) return 'A';
  if (pct >= 70) return 'B';
  if (pct >= 60) return 'C';
  if (pct >= 50) return 'D';
  return 'F';
};

export default function StudentReport() {
  const [regno,   setRegno]   = useState('');
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(false);
  const [error,   setError]   = useState('');
  const printRef = useRef();

  const load = async () => {
    if (!regno.trim()) { setError('Please enter a register number.'); return; }
    setLoading(true); setError(''); setData(null);
    try {
      const { data: d } = await getStudentReport(regno.trim());
      if (d.success) setData(d);
      else setError(d.message || 'Student not found.');
    } catch (e) { setError(e.response?.data?.message || 'Server error.'); }
    finally { setLoading(false); }
  };

  const handlePrint = () => {
    const content = printRef.current?.innerHTML;
    const w = window.open('', '_blank');
    w.document.write(`
      <html>
      <head>
        <title>Student Report - ${data?.student?.RegNo}</title>
        <style>
          body { font-family: Arial, sans-serif; font-size: 12px; padding: 20px; }
          h1 { color: #4F46E5; font-size: 18px; margin-bottom: 5px; }
          h2 { color: #333; font-size: 14px; margin: 15px 0 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
          table { width: 100%; border-collapse: collapse; margin: 10px 0; }
          th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; font-size: 11px; }
          th { background: #4F46E5; color: white; }
          .info-row { display: flex; gap: 30px; margin: 10px 0; }
          .info-item { display: flex; gap: 5px; }
          .info-label { font-weight: bold; color: #555; }
          .safe { color: #059669; } .warning { color: #D97706; } .risk { color: #DC2626; }
          .header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #4F46E5; padding-bottom: 10px; }
          .college { font-size: 16px; font-weight: bold; color: #4F46E5; }
          .subtitle { color: #666; font-size: 11px; }
          @media print { button { display: none; } }
        </style>
      </head>
      <body>
        <div class="header">
          <div>
            <div class="college">SREE SARASWATHI THYAGARAJA COLLEGE</div>
            <div class="subtitle">Affiliated to Bharathiar University (Autonomous)</div>
          </div>
          <div style="text-align: right;">
            <div style="font-weight: bold;">CONSOLIDATED STUDENT REPORT</div>
            <div style="font-size: 10px; color: #888;">Generated: ${new Date().toLocaleString()}</div>
          </div>
        </div>
        ${content}
      </body>
      </html>
    `);
    w.document.close();
    w.print();
  };

  const student = data?.student;
  const semesters = data?.semesters || [];
  const overall = data?.overall;

  // Chart data for attendance trend
  const attChartData = semesters.map(s => ({
    name: `Sem ${s.sem}`,
    pct: s.attendance?.pct || 0,
    fill: s.attendance ? (attStatus(s.attendance.pct) === 'safe' ? '#059669' : attStatus(s.attendance.pct) === 'warning' ? '#D97706' : '#DC2626') : '#D1D5DB',
  }));

  // Chart data for marks comparison
  const marksChartData = semesters.map(s => ({
    name: `Sem ${s.sem}`,
    CT1: s.ct1?.avg || 0,
    CT2: s.ct2?.avg || 0,
    Model: s.model?.avg ? s.model.avg / 2 : 0, // Scale model to 25
  }));

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>Student Consolidated Report</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        View complete academic performance for a student across all semesters
      </Typography>

      {/* Search */}
      <Card sx={{ mb: 3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs: 12, sm: 6, md: 4 }}>
              <TextField
                fullWidth size="small" label="Register Number"
                placeholder="e.g., N5BIT0001"
                value={regno} onChange={e => setRegno(e.target.value.toUpperCase())}
                onKeyDown={e => e.key === 'Enter' && load()}
              />
            </Grid>
            <Grid>
              <Button variant="contained" startIcon={<Search />} onClick={load} disabled={loading}>
                {loading ? 'Loading...' : 'Search'}
              </Button>
            </Grid>
            {data && (
              <Grid>
                <Button variant="outlined" startIcon={<Print />} onClick={handlePrint}>
                  Print Report
                </Button>
              </Grid>
            )}
          </Grid>
        </CardContent>
      </Card>

      {loading && (
        <Box display="flex" justifyContent="center" py={8}>
          <CircularProgress size={48} />
        </Box>
      )}

      {error && <Alert severity="error" sx={{ mb: 2 }}>{error}</Alert>}

      {data && student && (
        <Box ref={printRef}>
          {/* Student Info Card */}
          <Card sx={{ mb: 3, background: 'linear-gradient(135deg,#4F46E5,#818CF8)', color: 'white' }}>
            <CardContent>
              <Grid container spacing={3} alignItems="center">
                <Grid>
                  <Avatar sx={{ width: 80, height: 80, bgcolor: 'rgba(255,255,255,0.2)', fontSize: 28 }}>
                    {student.Name?.charAt(0)}
                  </Avatar>
                </Grid>
                <Grid size="grow">
                  <Typography variant="h5" fontWeight={700}>{student.Name}</Typography>
                  <Typography variant="body2" sx={{ opacity: 0.8 }}>{student.RegNo}</Typography>
                  <Box display="flex" gap={2} mt={1} flexWrap="wrap">
                    <Chip label={student.Department} size="small" sx={{ bgcolor: 'rgba(255,255,255,0.2)', color: 'white' }} />
                    <Chip label={`Batch ${student.Batch}`} size="small" sx={{ bgcolor: 'rgba(255,255,255,0.2)', color: 'white' }} />
                    <Chip label={student.status || 'Active'} size="small"
                      sx={{ bgcolor: student.status === 'Alumni' ? 'rgba(255,255,255,0.3)' : 'rgba(16,185,129,0.5)', color: 'white' }} />
                  </Box>
                </Grid>
                {overall?.attendance?.pct != null && (
                  <Grid>
                    <Box textAlign="center">
                      <Typography variant="overline" sx={{ opacity: 0.7 }}>Overall Attendance</Typography>
                      <Typography variant="h3" fontWeight={900}>{overall.attendance.pct}%</Typography>
                      <Chip
                        icon={ATT_STATUS[attStatus(overall.attendance.pct)].icon}
                        label={ATT_STATUS[attStatus(overall.attendance.pct)].label}
                        size="small"
                        sx={{ bgcolor: 'rgba(255,255,255,0.2)', color: 'white', mt: 0.5 }}
                      />
                    </Box>
                  </Grid>
                )}
              </Grid>
            </CardContent>
          </Card>

          {/* Charts Row */}
          {semesters.length > 1 && (
            <Grid container spacing={3} mb={3}>
              <Grid size={{ xs: 12, md: 6 }}>
                <Card sx={{ height: '100%' }}>
                  <CardContent>
                    <Typography variant="subtitle1" fontWeight={700} mb={2}>Attendance Trend</Typography>
                    <ResponsiveContainer width="100%" height={200}>
                      <BarChart data={attChartData}>
                        <XAxis dataKey="name" tick={{ fontSize: 11 }} />
                        <YAxis domain={[0, 100]} tick={{ fontSize: 11 }} />
                        <Tooltip />
                        <Bar dataKey="pct" name="Attendance %">
                          {attChartData.map((e, i) => <Cell key={i} fill={e.fill} />)}
                        </Bar>
                      </BarChart>
                    </ResponsiveContainer>
                  </CardContent>
                </Card>
              </Grid>
              <Grid size={{ xs: 12, md: 6 }}>
                <Card sx={{ height: '100%' }}>
                  <CardContent>
                    <Typography variant="subtitle1" fontWeight={700} mb={2}>Marks Comparison (Avg per Exam)</Typography>
                    <ResponsiveContainer width="100%" height={200}>
                      <BarChart data={marksChartData}>
                        <XAxis dataKey="name" tick={{ fontSize: 11 }} />
                        <YAxis domain={[0, 25]} tick={{ fontSize: 11 }} />
                        <Tooltip />
                        <Legend wrapperStyle={{ fontSize: 11 }} />
                        <Bar dataKey="CT1" fill="#4F46E5" name="CT1" />
                        <Bar dataKey="CT2" fill="#059669" name="CT2" />
                        <Bar dataKey="Model" fill="#EA580C" name="Model" />
                      </BarChart>
                    </ResponsiveContainer>
                  </CardContent>
                </Card>
              </Grid>
            </Grid>
          )}

          {/* Semester-wise Details */}
          <Typography variant="h6" fontWeight={700} mb={2}>Semester-wise Performance</Typography>
          {semesters.map(sem => {
            const attS = sem.attendance ? attStatus(sem.attendance.pct) : null;
            return (
              <Card key={sem.sem} sx={{ mb: 2 }}>
                <CardContent>
                  <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
                    <Typography variant="subtitle1" fontWeight={700}>
                      Semester {sem.sem}
                    </Typography>
                    {sem.attendance && (
                      <Chip
                        icon={ATT_STATUS[attS].icon}
                        label={`${sem.attendance.pct}% (${sem.attendance.present}/${sem.attendance.total} days)`}
                        size="small"
                        sx={{ bgcolor: `${ATT_STATUS[attS].color}15`, color: ATT_STATUS[attS].color, fontWeight: 600 }}
                      />
                    )}
                  </Box>

                  <Grid container spacing={2}>
                    {/* CT1 */}
                    <Grid size={{ xs: 6, sm: 3 }}>
                      <Paper variant="outlined" sx={{ p: 1.5, textAlign: 'center' }}>
                        <Typography variant="caption" color="text.secondary">Cycle Test 1</Typography>
                        <Typography variant="h5" fontWeight={800} color="#4F46E5">
                          {sem.ct1?.total ?? '—'}
                        </Typography>
                        {sem.ct1 && (
                          <Typography variant="caption" color="text.secondary">
                            Avg: {sem.ct1.avg}/25
                          </Typography>
                        )}
                      </Paper>
                    </Grid>
                    {/* CT2 */}
                    <Grid size={{ xs: 6, sm: 3 }}>
                      <Paper variant="outlined" sx={{ p: 1.5, textAlign: 'center' }}>
                        <Typography variant="caption" color="text.secondary">Cycle Test 2</Typography>
                        <Typography variant="h5" fontWeight={800} color="#059669">
                          {sem.ct2?.total ?? '—'}
                        </Typography>
                        {sem.ct2 && (
                          <Typography variant="caption" color="text.secondary">
                            Avg: {sem.ct2.avg}/25
                          </Typography>
                        )}
                      </Paper>
                    </Grid>
                    {/* Model */}
                    <Grid size={{ xs: 6, sm: 3 }}>
                      <Paper variant="outlined" sx={{ p: 1.5, textAlign: 'center' }}>
                        <Typography variant="caption" color="text.secondary">Model Exam</Typography>
                        <Typography variant="h5" fontWeight={800} color="#EA580C">
                          {sem.model?.total ?? '—'}
                        </Typography>
                        {sem.model && (
                          <Typography variant="caption" color="text.secondary">
                            Avg: {sem.model.avg}/50
                          </Typography>
                        )}
                      </Paper>
                    </Grid>
                    {/* Assignment */}
                    <Grid size={{ xs: 6, sm: 3 }}>
                      <Paper variant="outlined" sx={{ p: 1.5, textAlign: 'center' }}>
                        <Typography variant="caption" color="text.secondary">Assignment</Typography>
                        <Typography variant="h5" fontWeight={800} color="#7C3AED">
                          {sem.assignment?.total ?? '—'}
                        </Typography>
                        {sem.assignment && (
                          <Typography variant="caption" color="text.secondary">
                            {sem.assignment.parts.length} assignments
                          </Typography>
                        )}
                      </Paper>
                    </Grid>
                  </Grid>
                </CardContent>
              </Card>
            );
          })}

          {semesters.length === 0 && (
            <Box py={6} textAlign="center">
              <School sx={{ fontSize: 56, color: '#D1D5DB', mb: 2 }} />
              <Typography color="text.secondary">No academic records found for this student.</Typography>
            </Box>
          )}
        </Box>
      )}
    </PageWrapper>
  );
}
