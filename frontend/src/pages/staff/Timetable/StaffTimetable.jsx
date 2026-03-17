import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, CircularProgress, Alert,
  Grid, Chip, Avatar, Table, TableBody, TableCell,
  TableContainer, TableHead, TableRow, Paper, FormControl,
  InputLabel, Select, MenuItem,
} from '@mui/material';
import { CalendarMonth, School, Person, AccessTime, MenuBook } from '@mui/icons-material';
import api from '../../../utils/axiosInstance';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

const TYPE_COLOR = {
  Theory:    { bg: '#EEF2FF', color: '#4F46E5' },
  Lab:       { bg: '#ECFDF5', color: '#059669' },
  Practical: { bg: '#ECFDF5', color: '#059669' },
  Elective:  { bg: '#FEF3C7', color: '#D97706' },
};

const SUBJECT_COLORS = [
  '#4F46E5','#7C3AED','#059669','#EA580C','#059669',
  '#DB2777','#0891B2','#6D28D9','#DC2626','#2563EB',
];

export default function StaffTimetable() {
  const { user } = useAuth();
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(false);
  const [error,   setError]   = useState('');
  const [sem,     setSem]     = useState('');

  const dept = user?.dept || '';

  const fetchSubjects = async (selectedSem) => {
    if (!dept || !selectedSem) return;
    setLoading(true);
    setError('');
    try {
      const res = await api.get('/student/timetable.php', {
        params: { dept, sem: selectedSem },
      });
      if (res.data.success) setData(res.data);
      else setError(res.data.message || 'No subjects found for this semester.');
    } catch (err) {
      setError(err.response?.data?.message || 'Could not load subjects.');
    } finally {
      setLoading(false);
    }
  };

  const handleSemChange = (e) => {
    const val = e.target.value;
    setSem(val);
    fetchSubjects(val);
  };

  const subjects = data?.subjects || [];

  const colorMap = {};
  subjects.forEach((s, i) => {
    colorMap[s.CourseID] = SUBJECT_COLORS[i % SUBJECT_COLORS.length];
  });

  const theory  = subjects.filter(s => (s.Type || '').toLowerCase() === 'theory');
  const lab     = subjects.filter(s => ['lab', 'practical'].includes((s.Type || '').toLowerCase()));

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>Department Timetable</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        {dept} — Subjects &amp; Staff Allocation
      </Typography>

      {/* Semester Selector */}
      <Card sx={{ mb: 3, borderLeft: '4px solid #4F46E5' }}>
        <CardContent sx={{ pb: '16px !important' }}>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs: 12, sm: 4, md: 3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Select Semester</InputLabel>
                <Select value={sem} label="Select Semester" onChange={handleSemChange}>
                  {[1, 2, 3, 4, 5, 6].map(n => (
                    <MenuItem key={n} value={n}>Semester {n}</MenuItem>
                  ))}
                </Select>
              </FormControl>
            </Grid>
            {sem && (
              <Grid item xs>
                <Typography variant="body2" color="text.secondary">
                  Showing subjects for <strong>{dept}</strong>, Semester <strong>{sem}</strong>
                </Typography>
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

      {!loading && error && <Alert severity="info" sx={{ mb: 2, borderRadius: 2 }}>{error}</Alert>}

      {!loading && !sem && (
        <Box py={8} textAlign="center">
          <CalendarMonth sx={{ fontSize: 56, color: '#D1D5DB', mb: 2 }} />
          <Typography color="text.secondary">Select a semester to view subjects</Typography>
        </Box>
      )}

      {!loading && sem && subjects.length > 0 && (
        <>
          {/* Summary Cards */}
          <Grid container spacing={2} mb={3}>
            {[
              { label: 'Total Subjects', value: subjects.length, icon: <MenuBook />,      color: '#4F46E5', bg: '#EEF2FF' },
              { label: 'Theory',         value: theory.length,   icon: <School />,        color: '#059669', bg: '#ECFDF5' },
              { label: 'Lab/Practical',  value: lab.length,      icon: <CalendarMonth />, color: '#7C3AED', bg: '#F5F3FF' },
              { label: 'Total Credits',  value: subjects.reduce((a, s) => a + (parseInt(s.Credit) || 0), 0),
                icon: <AccessTime />, color: '#EA580C', bg: '#FFF7ED' },
            ].map(s => (
              <Grid size={{ xs: 6, sm: 3 }} key={s.label}>
                <Card sx={{ bgcolor: s.bg, border: 'none', boxShadow: 'none' }}>
                  <CardContent sx={{ py: 2, px: 2.5 }}>
                    <Box display="flex" alignItems="center" gap={1.5} mb={0.5}>
                      <Avatar sx={{ bgcolor: s.color, width: 36, height: 36, color: 'white' }}>{s.icon}</Avatar>
                      <Typography variant="body2" color="text.secondary" fontWeight={600}>{s.label}</Typography>
                    </Box>
                    <Typography variant="h4" fontWeight={700} color={s.color}>{s.value}</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>

          {/* Subject Table */}
          <Card sx={{ mb: 3 }}>
            <CardContent sx={{ pb: '16px !important' }}>
              <Typography variant="h6" fontWeight={700} mb={2}>
                Subjects — Semester {sem}
              </Typography>
              <TableContainer component={Paper} elevation={0} sx={{ border: '1px solid #E5E7EB', borderRadius: 3 }}>
                <Table size="small">
                  <TableHead>
                    <TableRow sx={{ bgcolor: '#F9FAFB' }}>
                      <TableCell sx={{ fontWeight: 700 }}>#</TableCell>
                      <TableCell sx={{ fontWeight: 700 }}>Course ID</TableCell>
                      <TableCell sx={{ fontWeight: 700 }}>Course Name</TableCell>
                      <TableCell sx={{ fontWeight: 700 }}>Staff</TableCell>
                      <TableCell sx={{ fontWeight: 700 }} align="center">Credits</TableCell>
                      <TableCell sx={{ fontWeight: 700 }} align="center">Type</TableCell>
                    </TableRow>
                  </TableHead>
                  <TableBody>
                    {subjects.map((s, i) => {
                      const tc = TYPE_COLOR[s.Type] || TYPE_COLOR.Theory;
                      return (
                        <TableRow key={s.CourseID} hover sx={{ '&:last-child td': { border: 0 } }}>
                          <TableCell>
                            <Avatar sx={{ bgcolor: colorMap[s.CourseID], width: 28, height: 28,
                              fontSize: 12, fontWeight: 700, color: 'white' }}>
                              {i + 1}
                            </Avatar>
                          </TableCell>
                          <TableCell>
                            <Chip label={s.CourseID} size="small"
                              sx={{ bgcolor: colorMap[s.CourseID], color: 'white',
                                fontWeight: 700, fontSize: '0.7rem' }} />
                          </TableCell>
                          <TableCell>
                            <Typography variant="body2" fontWeight={600}>{s.Course_Name}</Typography>
                          </TableCell>
                          <TableCell>
                            <Box display="flex" alignItems="center" gap={0.5}>
                              <Person sx={{ fontSize: 14, color: '#9CA3AF' }} />
                              <Typography variant="body2" color="text.secondary">{s.StaffName}</Typography>
                            </Box>
                          </TableCell>
                          <TableCell align="center">
                            <Typography variant="body2" fontWeight={600}>{s.Credit || '—'}</Typography>
                          </TableCell>
                          <TableCell align="center">
                            <Chip label={s.Type || 'Theory'} size="small"
                              sx={{ bgcolor: tc.bg, color: tc.color, fontWeight: 600, fontSize: '0.7rem', borderRadius: 999 }} />
                          </TableCell>
                        </TableRow>
                      );
                    })}
                  </TableBody>
                </Table>
              </TableContainer>
            </CardContent>
          </Card>

          {/* Subject Detail Cards */}
          <Typography variant="h6" fontWeight={700} mb={2}>Subject Details</Typography>
          <Grid container spacing={2}>
            {subjects.map((s) => {
              const tc = TYPE_COLOR[s.Type] || TYPE_COLOR.Theory;
              return (
                <Grid size={{ xs: 12, sm: 6, md: 4 }} key={s.CourseID}>
                  <Card sx={{ height: '100%', borderTop: `3px solid ${colorMap[s.CourseID]}` }}>
                    <CardContent>
                      <Box display="flex" justifyContent="space-between" alignItems="flex-start" mb={1}>
                        <Chip label={s.CourseID} size="small"
                          sx={{ bgcolor: colorMap[s.CourseID], color: 'white', fontWeight: 700 }} />
                        <Chip label={s.Type || 'Theory'} size="small"
                          sx={{ bgcolor: tc.bg, color: tc.color, fontWeight: 600, borderRadius: 999 }} />
                      </Box>
                      <Typography variant="subtitle1" fontWeight={700} mb={0.5}>
                        {s.Course_Name}
                      </Typography>
                      <Box display="flex" alignItems="center" gap={0.5} mb={0.5}>
                        <Person sx={{ fontSize: 14, color: '#9CA3AF' }} />
                        <Typography variant="body2" color="text.secondary">{s.StaffName}</Typography>
                      </Box>
                      <Box display="flex" alignItems="center" gap={0.5} mb={0.5}>
                        <AccessTime sx={{ fontSize: 14, color: '#9CA3AF' }} />
                        <Typography variant="body2" color="text.secondary">
                          {s.Credit || '—'} credits
                        </Typography>
                      </Box>
                      {s.Total_Mark && (
                        <Box display="flex" alignItems="center" gap={0.5}>
                          <School sx={{ fontSize: 14, color: '#9CA3AF' }} />
                          <Typography variant="body2" color="text.secondary">
                            Marks: {s.Total_Mark}
                          </Typography>
                        </Box>
                      )}
                    </CardContent>
                  </Card>
                </Grid>
              );
            })}
          </Grid>
        </>
      )}

      {!loading && sem && subjects.length === 0 && !error && (
        <Box py={8} textAlign="center">
          <CalendarMonth sx={{ fontSize: 56, color: '#D1D5DB', mb: 2 }} />
          <Typography color="text.secondary">
            No subjects found for {dept}, Semester {sem}.
          </Typography>
        </Box>
      )}
    </PageWrapper>
  );
}
