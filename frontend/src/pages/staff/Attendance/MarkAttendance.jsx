import { useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, TextField, Select,
  MenuItem, FormControl, InputLabel, Button, Chip, Avatar,
  Alert, Snackbar, CircularProgress, ToggleButton, ToggleButtonGroup,
  Table, TableBody, TableCell, TableContainer, TableHead, TableRow,
  Paper, LinearProgress, Tooltip, IconButton,
} from '@mui/material';
import { CheckCircle, Cancel, Save, Search, People } from '@mui/icons-material';
import { getAttendanceStudents, saveAttendance } from '../../../api/attendance';
import { useAuth } from '../../../context/AuthContext';

const SEMS  = [1,2,3,4,5,6];

export default function MarkAttendance() {
  const { user } = useAuth();

  const [batch,    setBatch]    = useState('');
  const [sem,      setSem]      = useState('');
  const [date,     setDate]     = useState(new Date().toISOString().split('T')[0]);
  const [students, setStudents] = useState([]);
  const [marks,    setMarks]    = useState({}); // { RegNo: 'P'|'A' }
  const [loading,  setLoading]  = useState(false);
  const [saving,   setSaving]   = useState(false);
  const [fetched,  setFetched]  = useState(false);
  const [error,    setError]    = useState('');
  const [snack,    setSnack]    = useState({ open:false, msg:'', sev:'success' });

  const handleFetch = async () => {
    if (!batch || !sem) { setError('Please enter batch and select semester.'); return; }
    setLoading(true); setError(''); setFetched(false);
    try {
      const { data } = await getAttendanceStudents({ batch, sem });
      if (data.success) {
        setStudents(data.data);
        // Default all to Present
        const initial = {};
        data.data.forEach(s => { initial[s.Regno] = 'P'; });
        setMarks(initial);
        setFetched(true);
      } else { setError(data.message || 'No students found.'); }
    } catch { setError('Failed to load students.'); }
    finally { setLoading(false); }
  };

  const toggleAll = (status) => {
    const all = {};
    students.forEach(s => { all[s.Regno] = status; });
    setMarks(all);
  };

  const handleSave = async () => {
    if (!students.length) return;
    setSaving(true);
    try {
      const records = students.map(s => ({ RegNo: s.Regno, status: marks[s.Regno] || 'A' }));
      const { data } = await saveAttendance({ batch:parseInt(batch), sem:parseInt(sem), date, records });
      if (data.success) {
        setSnack({ open:true, msg:`Attendance saved for ${records.length} students!`, sev:'success' });
        setFetched(false); setStudents([]); setMarks({});
      } else { setSnack({ open:true, msg:data.message||'Save failed.', sev:'error' }); }
    } catch (err) {
      setSnack({ open:true, msg: err.response?.data?.message || 'Save failed.', sev:'error' });
    } finally { setSaving(false); }
  };

  const present = Object.values(marks).filter(v => v==='P').length;
  const absent  = students.length - present;

  return (
    <Box sx={{ p:3 }}>
      <Typography variant="h5" fontWeight={700} mb={0.5}>Mark Attendance</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>Select a class to record today's attendance</Typography>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {/* Filter Bar */}
      <Card sx={{ mb:3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="flex-end">
            <Grid item xs={12} sm={3}>
              <TextField id="att-batch" fullWidth label="Batch Year *" type="number" value={batch}
                onChange={e => setBatch(e.target.value)} placeholder="e.g. 2022" />
            </Grid>
            <Grid item xs={12} sm={3}>
              <FormControl fullWidth>
                <InputLabel>Semester *</InputLabel>
                <Select value={sem} label="Semester *" id="att-sem" onChange={e => setSem(e.target.value)}>
                  {SEMS.map(s => <MenuItem key={s} value={s}>Semester {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={3}>
              <TextField id="att-date" fullWidth label="Date" type="date" value={date}
                onChange={e => setDate(e.target.value)} InputLabelProps={{ shrink:true }} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <Button id="fetch-students-btn" fullWidth variant="contained" size="large"
                onClick={handleFetch} disabled={loading} startIcon={loading ? <CircularProgress size={18}/> : <Search />}>
                Load Students
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {/* Student Attendance Table */}
      {fetched && students.length > 0 && (
        <>
          {/* Summary + Controls */}
          <Box display="flex" justifyContent="space-between" alignItems="center" mb={2} flexWrap="wrap" gap={1}>
            <Box display="flex" gap={2}>
              <Chip icon={<CheckCircle />} label={`Present: ${present}`} color="success" variant="filled" />
              <Chip icon={<Cancel />}      label={`Absent: ${absent}`}   color="error"   variant="filled" />
              <Chip icon={<People />}      label={`Total: ${students.length}`} color="primary" variant="outlined" />
            </Box>
            <Box display="flex" gap={1}>
              <Button id="mark-all-present" size="small" variant="outlined" color="success" onClick={() => toggleAll('P')}>All Present</Button>
              <Button id="mark-all-absent"  size="small" variant="outlined" color="error"   onClick={() => toggleAll('A')}>All Absent</Button>
              <Button id="save-attendance-btn" variant="contained" startIcon={saving ? <CircularProgress size={18}/> : <Save />}
                onClick={handleSave} disabled={saving}>
                Save Attendance
              </Button>
            </Box>
          </Box>

          <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 2px 12px rgba(0,0,0,0.07)' }}>
            <Table size="small">
              <TableHead>
                <TableRow sx={{ bgcolor:'#F4F6F8' }}>
                  <TableCell sx={{ fontWeight:700 }}>#</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Reg. No.</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Name</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Dept</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Overall %</TableCell>
                  <TableCell sx={{ fontWeight:700, textAlign:'center' }}>Status</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {students.map((s, i) => (
                  <TableRow key={s.Regno} hover sx={{ bgcolor: marks[s.Regno]==='A' ? '#FFF3F3' : 'inherit' }}>
                    <TableCell>{i+1}</TableCell>
                    <TableCell><b>{s.Regno}</b></TableCell>
                    <TableCell>{s.Name}</TableCell>
                    <TableCell><Chip label={s.Dept} size="small" variant="outlined" /></TableCell>
                    <TableCell>
                      <Box display="flex" alignItems="center" gap={1}>
                        <LinearProgress variant="determinate" value={s.pct}
                          color={s.pct < 75 ? 'error' : 'success'}
                          sx={{ flex:1, height:6, borderRadius:3 }} />
                        <Typography variant="caption" fontWeight={600} color={s.pct < 75 ? 'error.main' : 'success.main'}>
                          {s.pct}%
                        </Typography>
                      </Box>
                    </TableCell>
                    <TableCell align="center">
                      <ToggleButtonGroup
                        value={marks[s.Regno] || 'P'}
                        exclusive
                        onChange={(_, v) => { if(v) setMarks(m => ({...m,[s.Regno]:v})); }}
                        size="small"
                      >
                        <ToggleButton value="P" id={`att-p-${s.Regno}`}
                          sx={{ px:2, '&.Mui-selected':{ bgcolor:'#E8F5E9', color:'#2E7D32', borderColor:'#2E7D32' } }}>P</ToggleButton>
                        <ToggleButton value="A" id={`att-a-${s.Regno}`}
                          sx={{ px:2, '&.Mui-selected':{ bgcolor:'#FFEBEE', color:'#C62828', borderColor:'#C62828' } }}>A</ToggleButton>
                      </ToggleButtonGroup>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        </>
      )}

      {fetched && students.length === 0 && (
        <Alert severity="info">No students found for Batch {batch}, Semester {sem}. Add students via Admin panel.</Alert>
      )}

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
