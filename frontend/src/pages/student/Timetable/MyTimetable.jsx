import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, CircularProgress, Alert,
  Grid, Chip, Avatar, Table, TableBody, TableCell,
  TableContainer, TableHead, TableRow, Paper,
} from '@mui/material';
import { CalendarMonth, School, Person, AccessTime, MenuBook } from '@mui/icons-material';
import { getStudentTimetable } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

const TYPE_COLOR = {
  Theory:    { bg: '#EEF2FF', color: '#4F46E5' },
  Lab:       { bg: '#ECFDF5', color: '#059669' },
  Practical: { bg: '#ECFDF5', color: '#059669' },
  Elective:  { bg: '#FFF7ED', color: '#EA580C' },
};

const SUBJECT_COLORS = [
  '#4F46E5','#7C3AED','#059669','#EA580C','#0891B2',
  '#DB2777','#2563EB','#6D28D9','#DC2626','#4338CA',
];

export default function MyTimetable() {
  const { user }  = useAuth();
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');

  useEffect(() => {
    if (!user?.dept) return;
    (async () => {
      setLoading(true);
      try {
        const { data: res } = await getStudentTimetable({ dept: user.dept, sem: user.sem, batch: user.batch });
        if (res.success) setData(res);
        else setError(res.message || 'No subject data found.');
      } catch (err) {
        setError(err.response?.data?.message || 'Could not load subjects.');
      } finally { setLoading(false); }
    })();
  }, [user]);

  if (loading) return (
    <Box display="flex" justifyContent="center" py={10}><CircularProgress size={48} /></Box>
  );

  const subjects = data?.subjects || [];

  // Assign a color to each subject
  const colorMap = {};
  subjects.forEach((s, i) => {
    colorMap[s.CourseID] = SUBJECT_COLORS[i % SUBJECT_COLORS.length];
  });

  const theory   = subjects.filter(s => (s.Type || '').toLowerCase() === 'theory');
  const lab      = subjects.filter(s => ['lab','practical'].includes((s.Type || '').toLowerCase()));
  const elective = subjects.filter(s => (s.Type || '').toLowerCase() === 'elective');

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>My Timetable & Subjects</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        {user?.dept} · Semester {user?.sem} · Batch {user?.batch}
      </Typography>

      {error && <Alert severity="info" sx={{ mb: 2, borderRadius: 2 }}>{error}</Alert>}

      {/* Summary Cards */}
      <Grid container spacing={2} mb={3}>
        {[
          { label: 'Total Subjects', value: subjects.length, icon: <MenuBook />, color: '#4F46E5', bg: '#EEF2FF' },
          { label: 'Theory',         value: theory.length,   icon: <School />,   color: '#059669', bg: '#ECFDF5' },
          { label: 'Lab/Practical',  value: lab.length,      icon: <CalendarMonth />, color: '#7C3AED', bg: '#F5F3FF' },
          { label: 'Weekly Credit Hours', value: subjects.reduce((a, s) => a + (parseInt(s.Credit) || 0), 0),
            icon: <AccessTime />, color: '#EA580C', bg: '#FFF7ED' },
        ].map(s => (
          <Grid size={{ xs: 6, sm: 3 }} key={s.label}>
            <Card sx={{ bgcolor: s.bg }}>
              <CardContent sx={{ py: 2, px: 2.5 }}>
                <Box display="flex" alignItems="center" gap={1.5} mb={0.5}>
                  <Avatar sx={{ bgcolor: s.color, width: 36, height: 36, color: 'white' }}>{s.icon}</Avatar>
                  <Typography variant="body2" color="text.secondary" fontWeight={600}>{s.label}</Typography>
                </Box>
                <Typography variant="h4" fontWeight={900} color={s.color}>{s.value}</Typography>
              </CardContent>
            </Card>
          </Grid>
        ))}
      </Grid>

      {/* Subject Table */}
      {subjects.length === 0 ? (
        <Box py={8} textAlign="center">
          <CalendarMonth sx={{ fontSize: 56, color: '#D1D5DB', mb: 2 }} />
          <Typography color="text.secondary">
            No subjects found for {user?.dept}, Semester {user?.sem}.
          </Typography>
          <Typography variant="caption" color="text.secondary">
            Please contact your department for the current semester timetable.
          </Typography>
        </Box>
      ) : (
        <>
          <Card sx={{ mb: 3 }}>
            <CardContent sx={{ pb: '16px !important' }}>
              <Typography variant="h6" fontWeight={700} mb={2}>
                Subjects — Semester {user?.sem}
              </Typography>
              <TableContainer component={Paper} elevation={0} sx={{ border: '1px solid #E5E7EB', borderRadius: 2 }}>
                <Table size="small">
                  <TableHead>
                    <TableRow sx={{ bgcolor: '#F9FAFB' }}>
                      <TableCell sx={{ fontWeight: 700 }}>#</TableCell>
                      <TableCell sx={{ fontWeight: 700 }}>Subject Code</TableCell>
                      <TableCell sx={{ fontWeight: 700 }}>Subject Name</TableCell>
                      <TableCell sx={{ fontWeight: 700 }}>Staff</TableCell>
                      <TableCell sx={{ fontWeight: 700 }} align="center">Hours/Week</TableCell>
                      <TableCell sx={{ fontWeight: 700 }} align="center">Type</TableCell>
                    </TableRow>
                  </TableHead>
                  <TableBody>
                    {subjects.map((s, i) => {
                      const tc = TYPE_COLOR[s.Type] || TYPE_COLOR.Theory;
                      return (
                        <TableRow key={s.CourseID} hover
                          sx={{ '&:last-child td': { border: 0 } }}>
                          <TableCell>
                            <Avatar sx={{
                              bgcolor: colorMap[s.CourseID], width: 28, height: 28,
                              fontSize: 12, fontWeight: 700, color: 'white',
                            }}>
                              {i + 1}
                            </Avatar>
                          </TableCell>
                          <TableCell>
                            <Chip label={s.CourseID} size="small"
                              sx={{ bgcolor: colorMap[s.CourseID], color: 'white',
                                fontWeight: 700, fontSize: '0.7rem', borderRadius: 999 }} />
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
                            <Box display="flex" alignItems="center" justifyContent="center" gap={0.5}>
                              <AccessTime sx={{ fontSize: 14, color: '#9CA3AF' }} />
                              <Typography variant="body2">{s.Credit || '—'}</Typography>
                            </Box>
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
            {subjects.map((s, i) => {
              const tc = TYPE_COLOR[s.Type] || TYPE_COLOR.Theory;
              return (
                <Grid size={{ xs: 12, sm: 6, md: 4 }} key={s.CourseID}>
                  <Card sx={{ height: '100%', borderTop: `4px solid ${colorMap[s.CourseID]}` }}>
                    <CardContent>
                      <Box display="flex" justifyContent="space-between" alignItems="flex-start" mb={1}>
                        <Chip label={s.CourseID} size="small"
                          sx={{ bgcolor: colorMap[s.CourseID], color: 'white', fontWeight: 700, borderRadius: 999 }} />
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
    </PageWrapper>
  );
}
