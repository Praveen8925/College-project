import { useState } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, Alert, CircularProgress,
  Table, TableBody, TableCell, TableContainer, TableHead, TableRow,
  Paper, Chip, ToggleButton, ToggleButtonGroup,
} from '@mui/material';
import { Search, Print } from '@mui/icons-material';
import { getCOEMarks } from '../../../api/marks';
import PageWrapper from '../../../components/common/PageWrapper';

const DEPTS = ['CSE','IT','ECE','EEE','MECH','CIVIL','MBA','MCA','B.Sc(IT)','B.Sc(CS)','BCA'];

function markColor(mark, max) {
  if (mark == null || mark === '' || !max) return '#9CA3AF';
  const pct = (parseFloat(mark) / parseFloat(max)) * 100;
  if (pct >= 75) return '#059669';
  if (pct >= 50) return '#D97706';
  return '#DC2626';
}

export default function COEMarks() {
  const [batch,    setBatch]    = useState('');
  const [dept,     setDept]     = useState('');
  const [sem,      setSem]      = useState('');
  const [subjects, setSubjects] = useState([]);
  const [students, setStudents] = useState([]);
  const [loading,  setLoading]  = useState(false);
  const [searched, setSearched] = useState(false);
  const [error,    setError]    = useState('');
  const [view,     setView]     = useState('all'); // 'all' | 'CT1' | 'CT2' | 'Model'

  const load = async () => {
    if (!batch || !dept || !sem) { setError('Please fill Batch, Department and Semester.'); return; }
    setLoading(true); setError('');
    try {
      const { data } = await getCOEMarks({ batch, dept, sem });
      if (data.success) {
        setSubjects(data.subjects || []);
        setStudents(data.students || []);
        setSearched(true);
      } else { setError(data.message || 'No data found.'); }
    } catch(e) { setError(e.response?.data?.message || 'Failed to load COE marks.'); }
    finally { setLoading(false); }
  };

  const tests = view === 'all' ? ['CT1','CT2','Model'] : [view];

  return (
    <PageWrapper>
      {/* Header */}
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>COE Internal Marks</Typography>
          <Typography variant="body2" color="text.secondary">Consolidated internal marks view for Controller of Examinations</Typography>
        </Box>
        {searched && (
          <Button variant="outlined" startIcon={<Print />} onClick={()=>window.print()} className="no-print">Print</Button>
        )}
      </Box>

      {/* Filters */}
      <Card sx={{ mb: 3 }} className="no-print">
        <CardContent>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:6, sm:3, md:2 }}>
              <TextField fullWidth size="small" label="Batch *" value={batch} onChange={e=>setBatch(e.target.value)} placeholder="e.g. 2022" />
            </Grid>
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department *</InputLabel>
                <Select value={dept} label="Department *" onChange={e=>setDept(e.target.value)}>
                  {DEPTS.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
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
              <Button variant="contained" startIcon={loading?<CircularProgress size={16}/>:<Search/>} onClick={load} disabled={loading}>
                {loading ? 'Loading…' : 'Generate'}
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {searched && students.length === 0 && !loading && (
        <Alert severity="info">No mark records found for the selected class.</Alert>
      )}

      {searched && students.length > 0 && (
        <>
          {/* Test filter toggle */}
          <Box display="flex" alignItems="center" gap={2} mb={2} className="no-print">
            <Typography variant="body2" fontWeight={600} color="text.secondary">Show:</Typography>
            <ToggleButtonGroup value={view} exclusive onChange={(_,v)=>v&&setView(v)} size="small">
              <ToggleButton value="all">All Tests</ToggleButton>
              <ToggleButton value="CT1">CT1</ToggleButton>
              <ToggleButton value="CT2">CT2</ToggleButton>
              <ToggleButton value="Model">Model</ToggleButton>
            </ToggleButtonGroup>
          </Box>

          <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)', overflow:'auto' }}>
            <Table size="small" stickyHeader>
              <TableHead>
                {/* Row 1 — Subject grouping */}
                <TableRow>
                  <TableCell rowSpan={2} sx={{ fontWeight:700, bgcolor:'#F9FAFB', minWidth:80, position:'sticky', left:0, zIndex:4 }}>Reg No</TableCell>
                  <TableCell rowSpan={2} sx={{ fontWeight:700, bgcolor:'#F9FAFB', minWidth:160, position:'sticky', left:80, zIndex:4 }}>Name</TableCell>
                  {subjects.map(sub=>(
                    <TableCell key={sub.CourseID} colSpan={tests.length}
                      sx={{ fontWeight:700, bgcolor:'#EEF2FF', textAlign:'center', borderLeft:'2px solid #C7D2FE' }}>
                      <Box>{sub.CourseID}</Box>
                      <Typography variant="caption" color="text.secondary">{sub.Course_Name}</Typography>
                    </TableCell>
                  ))}
                </TableRow>
                {/* Row 2 — Test type headers */}
                <TableRow>
                  {subjects.map(sub=>
                    tests.map(t=>(
                      <TableCell key={`${sub.CourseID}-${t}`}
                        sx={{ fontWeight:600, bgcolor:'#F5F3FF', textAlign:'center', fontSize:'0.7rem',
                          borderLeft: t===tests[0]?'2px solid #C7D2FE':'none', minWidth:55 }}>
                        {t}
                      </TableCell>
                    ))
                  )}
                </TableRow>
              </TableHead>
              <TableBody>
                {students.map((s,i)=>(
                  <TableRow key={s.Regno} sx={{ bgcolor:i%2===0?'white':'#FAFAFA', '&:hover':{ bgcolor:'#F5F3FF' } }}>
                    <TableCell sx={{ fontWeight:600, position:'sticky', left:0, bgcolor:'inherit', zIndex:1 }}>{s.Regno}</TableCell>
                    <TableCell sx={{ position:'sticky', left:80, bgcolor:'inherit', zIndex:1 }}>{s.Name}</TableCell>
                    {subjects.map(sub=>
                      tests.map(t=>{
                        const key  = `${sub.CourseID}_${t}`;
                        const mark = s.marks?.[key];
                        const max  = t==='Model' ? 50 : 25;
                        return (
                          <TableCell key={key} align="center"
                            sx={{ borderLeft: t===tests[0]?'2px solid #E0E7FF':'none',
                              color: markColor(mark, max), fontWeight:600, fontSize:'0.8rem' }}>
                            {mark ?? '—'}
                          </TableCell>
                        );
                      })
                    )}
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>

          <Box mt={1} display="flex" justifyContent="space-between">
            <Typography variant="caption" color="text.secondary">{dept} | Batch {batch} | Sem {sem}</Typography>
            <Typography variant="caption" color="text.secondary">{students.length} students · {subjects.length} subjects</Typography>
          </Box>
        </>
      )}

      <style>{`@media print { .no-print { display:none !important; } }`}</style>
    </PageWrapper>
  );
}
