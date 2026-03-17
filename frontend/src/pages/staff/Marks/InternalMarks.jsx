import { useState } from 'react';
import {
  Box, Card, CardContent, Typography, TextField, Select, MenuItem,
  FormControl, InputLabel, Button, Grid, CircularProgress, Alert,
  Table, TableBody, TableCell, TableContainer, TableHead, TableRow,
  Paper, Chip, Snackbar, ToggleButton, ToggleButtonGroup, IconButton, Tooltip,
} from '@mui/material';
import { Search, Save } from '@mui/icons-material';
import { getInternalMarks, saveInternalMark } from '../../../api/marks';

const SEMS      = [1,2,3,4,5,6];
const TEST_TYPES = ['CT1','CT2','Model'];
const MAX_MARK   = { CT1:25, CT2:25, Model:50 };

export default function InternalMarks() {
  const [batch,    setBatch]    = useState('');
  const [sem,      setSem]      = useState('');
  const [testType, setTestType] = useState('CT1');
  const [rows,     setRows]     = useState([]);   // {Regno, Name, mark}
  const [markMap,  setMarkMap]  = useState({});   // {Regno: mark}
  const [editMap,  setEditMap]  = useState({});
  const [loading,  setLoading]  = useState(false);
  const [saving,   setSaving]   = useState('');
  const [fetched,  setFetched]  = useState(false);
  const [error,    setError]    = useState('');
  const [snack,    setSnack]    = useState({ open:false, msg:'', sev:'success' });

  const load = async () => {
    if (!batch || !sem) { setError('Batch and semester required.'); return; }
    setLoading(true); setError(''); setFetched(false);
    try {
      const { data } = await getInternalMarks({ batch, sem, testType });
      if (data.success) {
        setRows(data.students);
        // Prefill existing marks
        const pre = {};
        data.students.forEach(s => {
          const m = data.marks?.[s.Regno];
          pre[s.Regno] = m?.Mark ?? m?.mark ?? '';
        });
        setMarkMap(pre); setEditMap({});  setFetched(true);
      } else { setError(data.message || 'Failed.'); }
    } catch (err) { setError(err.response?.data?.message || 'Failed to load.'); }
    finally { setLoading(false); }
  };

  const handleSave = async (regno) => {
    setSaving(regno);
    try {
      const { data } = await saveInternalMark({ batch:parseInt(batch), sem:parseInt(sem), RegNo:regno, testType, mark: markMap[regno]||'0' });
      if (data.success) {
        setSnack({ open:true, msg:`Mark saved for ${regno}`, sev:'success' });
        setEditMap(e => ({ ...e, [regno]:false }));
      } else { setSnack({ open:true, msg:data.message||'Error.', sev:'error' }); }
    } catch { setSnack({ open:true, msg:'Save failed.', sev:'error' }); }
    finally { setSaving(''); }
  };

  const maxM = MAX_MARK[testType] || 50;

  return (
    <Box sx={{ p:3 }}>
      <Typography variant="h5" fontWeight={700} mb={0.5}>Internal Marks</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>Enter CT1, CT2 and Model Exam marks for students</Typography>
      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      <Card sx={{ mb:3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="flex-end">
            <Grid item xs={12} sm={2.5}>
              <TextField id="marks-batch" fullWidth label="Batch Year *" type="number" value={batch}
                onChange={e => setBatch(e.target.value)} placeholder="e.g. 2022" />
            </Grid>
            <Grid item xs={12} sm={2.5}>
              <FormControl fullWidth>
                <InputLabel>Semester *</InputLabel>
                <Select value={sem} label="Semester *" id="marks-sem" onChange={e => setSem(e.target.value)}>
                  {SEMS.map(s => <MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={4}>
              <Typography variant="caption" color="text.secondary" display="block" mb={0.5}>Test Type</Typography>
              <ToggleButtonGroup value={testType} exclusive onChange={(_, v) => { if(v) setTestType(v); }} size="small" fullWidth>
                {TEST_TYPES.map(t => (
                  <ToggleButton key={t} value={t} id={`test-type-${t}`} sx={{ fontWeight:600 }}>
                    {t} ({MAX_MARK[t]})
                  </ToggleButton>
                ))}
              </ToggleButtonGroup>
            </Grid>
            <Grid item xs={12} sm={3}>
              <Button id="marks-fetch-btn" fullWidth variant="contained" size="large"
                onClick={load} disabled={loading}
                startIcon={loading ? <CircularProgress size={18}/> : <Search />}>
                Load Students
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {fetched && rows.length > 0 && (
        <>
          <Box display="flex" alignItems="center" gap={2} mb={2}>
            <Chip label={`${testType} — Max: ${maxM}`} color="primary" />
            <Chip label={`${rows.length} students`} variant="outlined" />
          </Box>
          <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 2px 12px rgba(0,0,0,0.07)' }}>
            <Table size="small">
              <TableHead>
                <TableRow sx={{ bgcolor:'#F4F6F8' }}>
                  <TableCell sx={{ fontWeight:700 }}>#</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Reg. No.</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Name</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>{testType} Mark (/{maxM})</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Status</TableCell>
                  <TableCell sx={{ fontWeight:700 }}>Action</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {rows.map((s, i) => {
                  const m = parseInt(markMap[s.Regno]);
                  const pct = isNaN(m) ? 0 : Math.round((m/maxM)*100);
                  return (
                    <TableRow key={s.Regno} hover>
                      <TableCell>{i+1}</TableCell>
                      <TableCell><b>{s.Regno}</b></TableCell>
                      <TableCell>{s.Name}</TableCell>
                      <TableCell>
                        {editMap[s.Regno] ? (
                          <TextField id={`mark-${s.Regno}`} size="small" type="number" sx={{ width:100 }}
                            value={markMap[s.Regno] ?? ''} inputProps={{ min:0, max:maxM }}
                            onChange={e => setMarkMap(m => ({ ...m, [s.Regno]: e.target.value }))} />
                        ) : (
                          <Typography fontWeight={600} color={markMap[s.Regno]!=='' ? 'text.primary' : 'text.secondary'}>
                            {markMap[s.Regno] !== '' ? `${markMap[s.Regno]} / ${maxM}` : '—'}
                          </Typography>
                        )}
                      </TableCell>
                      <TableCell>
                        {!isNaN(m) && markMap[s.Regno] !== '' && (
                          <Chip label={`${pct}%`} size="small"
                            color={pct >= 40 ? 'success' : 'error'} variant="outlined" />
                        )}
                      </TableCell>
                      <TableCell>
                        {editMap[s.Regno] ? (
                          <Button id={`save-int-mark-${s.Regno}`} size="small" variant="contained"
                            startIcon={saving===s.Regno ? <CircularProgress size={14}/> : <Save />}
                            onClick={() => handleSave(s.Regno)} disabled={saving===s.Regno}>
                            Save
                          </Button>
                        ) : (
                          <Button id={`edit-int-mark-${s.Regno}`} size="small" variant="outlined"
                            onClick={() => setEditMap(e => ({ ...e, [s.Regno]:true }))}>
                            Edit
                          </Button>
                        )}
                      </TableCell>
                    </TableRow>
                  );
                })}
              </TableBody>
            </Table>
          </TableContainer>
        </>
      )}

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
