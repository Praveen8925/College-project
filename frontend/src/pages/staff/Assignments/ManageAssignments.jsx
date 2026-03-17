import { useState } from 'react';
import {
  Box, Card, CardContent, Typography, TextField, Select, MenuItem,
  FormControl, InputLabel, Button, Grid, CircularProgress, Alert,
  Table, TableBody, TableCell, TableContainer, TableHead, TableRow,
  Paper, LinearProgress, Chip, Avatar, Snackbar, IconButton, Tooltip,
} from '@mui/material';
import { Search, Save, Edit, CheckCircle } from '@mui/icons-material';
import { getAttendanceStudents } from '../../../api/attendance';
import { saveAssignment } from '../../../api/assignments';

const SEMS = [1,2,3,4,5,6];

export default function ManageAssignments() {
  const [batch,    setBatch]    = useState('');
  const [sem,      setSem]      = useState('');
  const [students, setStudents] = useState([]);
  const [markMap,  setMarkMap]  = useState({}); // { Regno: mark }
  const [editMap,  setEditMap]  = useState({}); // { Regno: true }
  const [loading,  setLoading]  = useState(false);
  const [saving,   setSaving]   = useState('');
  const [fetched,  setFetched]  = useState(false);
  const [error,    setError]    = useState('');
  const [snack,    setSnack]    = useState({ open:false, msg:'', sev:'success' });

  const handleFetch = async () => {
    if (!batch || !sem) { setError('Please enter batch and select semester.'); return; }
    setLoading(true); setError('');
    try {
      const { data } = await getAttendanceStudents({ batch, sem });
      if (data.success) {
        setStudents(data.data); setFetched(true); setMarkMap({}); setEditMap({});
      } else { setError(data.message || 'No students found.'); }
    } catch { setError('Failed to load students.'); }
    finally { setLoading(false); }
  };

  const handleSaveMark = async (regno) => {
    setSaving(regno);
    try {
      const { data } = await saveAssignment({ batch:parseInt(batch), sem:parseInt(sem), RegNo:regno, ass_mark: markMap[regno]||'0' });
      if (data.success) {
        setSnack({ open:true, msg:`Mark saved for ${regno}`, sev:'success' });
        setEditMap(e => ({ ...e, [regno]: false }));
      } else { setSnack({ open:true, msg:data.message||'Failed.', sev:'error' }); }
    } catch { setSnack({ open:true, msg:'Save failed.', sev:'error' }); }
    finally { setSaving(''); }
  };

  return (
    <Box sx={{ p:3 }}>
      <Typography variant="h5" fontWeight={700} mb={0.5}>Assignment Marks</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>Enter assignment marks for a class</Typography>
      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      <Card sx={{ mb:3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="flex-end">
            <Grid item xs={12} sm={4}>
              <TextField id="asgn-batch" fullWidth label="Batch Year *" type="number" value={batch}
                onChange={e => setBatch(e.target.value)} placeholder="e.g. 2022" />
            </Grid>
            <Grid item xs={12} sm={4}>
              <FormControl fullWidth>
                <InputLabel>Semester *</InputLabel>
                <Select value={sem} label="Semester *" id="asgn-sem" onChange={e => setSem(e.target.value)}>
                  {SEMS.map(s => <MenuItem key={s} value={s}>Semester {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={4}>
              <Button id="asgn-fetch-btn" fullWidth variant="contained" size="large"
                onClick={handleFetch} disabled={loading}
                startIcon={loading ? <CircularProgress size={18}/> : <Search />}>
                Load Students
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {fetched && students.length > 0 && (
        <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 2px 12px rgba(0,0,0,0.07)' }}>
          <Table size="small">
            <TableHead>
              <TableRow sx={{ bgcolor:'#F4F6F8' }}>
                <TableCell sx={{ fontWeight:700 }}>#</TableCell>
                <TableCell sx={{ fontWeight:700 }}>Reg. No.</TableCell>
                <TableCell sx={{ fontWeight:700 }}>Name</TableCell>
                <TableCell sx={{ fontWeight:700 }}>Department</TableCell>
                <TableCell sx={{ fontWeight:700 }}>Assignment Mark</TableCell>
                <TableCell sx={{ fontWeight:700 }}>Action</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {students.map((s, i) => (
                <TableRow key={s.Regno} hover>
                  <TableCell>{i+1}</TableCell>
                  <TableCell><b>{s.Regno}</b></TableCell>
                  <TableCell>{s.Name}</TableCell>
                  <TableCell><Chip label={s.Dept} size="small" variant="outlined" /></TableCell>
                  <TableCell>
                    {editMap[s.Regno] ? (
                      <TextField
                        id={`mark-${s.Regno}`}
                        size="small" type="number" sx={{ width:100 }}
                        value={markMap[s.Regno] ?? ''}
                        onChange={e => setMarkMap(m => ({ ...m, [s.Regno]: e.target.value }))}
                        inputProps={{ min:0, max:25 }}
                        placeholder="0-25"
                      />
                    ) : (
                      <Typography variant="body2" fontWeight={markMap[s.Regno] ? 700 : 400} color={markMap[s.Regno] ? 'primary' : 'text.secondary'}>
                        {markMap[s.Regno] ? `${markMap[s.Regno]} / 25` : '—'}
                      </Typography>
                    )}
                  </TableCell>
                  <TableCell>
                    {editMap[s.Regno] ? (
                      <Button id={`save-mark-${s.Regno}`} size="small" variant="contained" startIcon={saving===s.Regno ? <CircularProgress size={14}/> : <Save />}
                        onClick={() => handleSaveMark(s.Regno)} disabled={saving===s.Regno}>
                        Save
                      </Button>
                    ) : (
                      <Tooltip title="Edit mark">
                        <IconButton id={`edit-mark-${s.Regno}`} size="small" color="primary"
                          onClick={() => setEditMap(e => ({ ...e, [s.Regno]:true }))}>
                          <Edit fontSize="small" />
                        </IconButton>
                      </Tooltip>
                    )}
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>
      )}

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
