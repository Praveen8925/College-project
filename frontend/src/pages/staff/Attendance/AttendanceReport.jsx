import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button,
  Select, MenuItem, FormControl, InputLabel, Alert, CircularProgress,
  Table, TableBody, TableCell, TableContainer, TableHead, TableRow,
  Paper, Chip, TextField,
} from '@mui/material';
import { Search, Print } from '@mui/icons-material';
import { getAttendanceReport } from '../../../api/attendance';
import PageWrapper from '../../../components/common/PageWrapper';

const DEPTS = ['CSE','IT','ECE','EEE','MECH','CIVIL','MBA','MCA'];

function pct(present, total) {
  if (!total) return null;
  return Math.round((present / total) * 100);
}

function PctChip({ value }) {
  if (value === null) return <Typography variant="caption" color="text.secondary">—</Typography>;
  const color = value >= 75 ? '#059669' : value >= 60 ? '#D97706' : '#DC2626';
  const bg    = value >= 75 ? '#ECFDF5' : value >= 60 ? '#FFFBEB' : '#FEF2F2';
  return <Chip label={`${value}%`} size="small" sx={{ bgcolor:bg, color, fontWeight:700, minWidth:52 }} />;
}

export default function AttendanceReport() {
  const [students,  setStudents]  = useState([]);
  const [subjects,  setSubjects]  = useState([]);
  const [loading,   setLoading]   = useState(false);
  const [searched,  setSearched]  = useState(false);
  const [dept,      setDept]      = useState('');
  const [batch,     setBatch]     = useState('');
  const [sem,       setSem]       = useState('');
  const [error,     setError]     = useState('');

  const load = async () => {
    if (!dept || !batch || !sem) { setError('Please select Department, Batch and Semester.'); return; }
    setLoading(true); setError('');
    try {
      const { data } = await getAttendanceReport({ dept, batch, sem });
      if (data.success) {
        setStudents(data.students || []);
        setSubjects(data.subjects || []);
        setSearched(true);
      } else {
        setError(data.message || 'No data found.');
      }
    } catch(e) { setError(e.response?.data?.message || 'Failed to load attendance report.'); }
    finally { setLoading(false); }
  };

  return (
    <PageWrapper>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Attendance Report</Typography>
          <Typography variant="body2" color="text.secondary">Per-student, per-subject attendance overview</Typography>
        </Box>
        {searched && (
          <Button variant="outlined" startIcon={<Print />} onClick={()=>window.print()} className="no-print">
            Print
          </Button>
        )}
      </Box>

      {/* Filter */}
      <Card sx={{ mb:3 }} className="no-print">
        <CardContent>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department *</InputLabel>
                <Select value={dept} label="Department *" onChange={e=>setDept(e.target.value)}>
                  {DEPTS.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:6, sm:3, md:2 }}>
              <TextField fullWidth size="small" label="Batch *" value={batch} onChange={e=>setBatch(e.target.value)} />
            </Grid>
            <Grid size={{ xs:6, sm:3, md:2 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester *</InputLabel>
                <Select value={sem} label="Semester *" onChange={e=>setSem(e.target.value)}>
                  {[1,2,3,4,5,6].map(s=><MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid>
              <Button variant="contained" startIcon={<Search />} onClick={load} disabled={loading}>
                {loading ? <CircularProgress size={18}/> : 'Generate Report'}
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {searched && !loading && students.length === 0 && (
        <Alert severity="info">No attendance data found for the selected class.</Alert>
      )}

      {searched && students.length > 0 && (
        <>
          {/* Legend */}
          <Box display="flex" gap={1} mb={2} alignItems="center" className="no-print">
            <Typography variant="caption" fontWeight={600} color="text.secondary">Legend:</Typography>
            <PctChip value={80} /> <Typography variant="caption">≥75% Good</Typography>
            <PctChip value={65} /> <Typography variant="caption">60–74% Average</Typography>
            <PctChip value={50} /> <Typography variant="caption">&lt;60% Low</Typography>
          </Box>

          <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)', overflow:'auto' }}>
            <Table size="small" stickyHeader>
              <TableHead>
                <TableRow>
                  <TableCell sx={{ fontWeight:700, bgcolor:'#F9FAFB', minWidth:80, zIndex:3 }}>Reg No</TableCell>
                  <TableCell sx={{ fontWeight:700, bgcolor:'#F9FAFB', minWidth:160, zIndex:3 }}>Student Name</TableCell>
                  {subjects.map(sub => (
                    <TableCell key={sub} sx={{ fontWeight:700, bgcolor:'#F9FAFB', textAlign:'center', minWidth:90 }}>
                      {sub}
                    </TableCell>
                  ))}
                  <TableCell sx={{ fontWeight:700, bgcolor:'#EEF2FF', textAlign:'center', minWidth:90 }}>Overall</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {students.map((s,i) => {
                  const subAttPct = subjects.map(sub => {
                    const present = Number(s[`${sub}_present`] ?? 0);
                    const total   = Number(s[`${sub}_total`]   ?? 0);
                    return pct(present, total);
                  });
                  const totalPresent = subjects.reduce((acc,sub)=> acc + Number(s[`${sub}_present`]||0), 0);
                  const totalPeriods = subjects.reduce((acc,sub)=> acc + Number(s[`${sub}_total`]  ||0), 0);
                  const overallPct   = pct(totalPresent, totalPeriods);

                  return (
                    <TableRow key={s.Regno || i} sx={{ bgcolor: i%2===0?'white':'#FAFAFA', '&:hover':{ bgcolor:'#F5F3FF' } }}>
                      <TableCell sx={{ fontWeight:600 }}>{s.Regno}</TableCell>
                      <TableCell>{s.Name}</TableCell>
                      {subAttPct.map((p,j)=>(
                        <TableCell key={j} align="center"><PctChip value={p} /></TableCell>
                      ))}
                      <TableCell align="center" sx={{ bgcolor:'#EEF2FF' }}><PctChip value={overallPct} /></TableCell>
                    </TableRow>
                  );
                })}
              </TableBody>
            </Table>
          </TableContainer>

          <Box mt={1} display="flex" justifyContent="space-between">
            <Typography variant="caption" color="text.secondary">
              {dept} | Batch {batch} | Sem {sem}
            </Typography>
            <Typography variant="caption" color="text.secondary">
              {students.length} students · {subjects.length} subjects
            </Typography>
          </Box>
        </>
      )}

      <style>{`
        @media print {
          .no-print { display:none !important; }
        }
      `}</style>
    </PageWrapper>
  );
}
