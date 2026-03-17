import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, TextField, Select, MenuItem,
  FormControl, InputLabel, Button, Grid, CircularProgress, Alert,
  Table, TableBody, TableCell, TableContainer, TableHead, TableRow,
  Paper, Chip, IconButton, Dialog, DialogTitle, DialogContent,
  DialogActions, Snackbar, Divider, Avatar,
} from '@mui/material';
import { Add, Delete, Work, Close } from '@mui/icons-material';
import { getWorkDiary, addWorkDiary, deleteWorkDiary } from '../../../api/workdiary';
import { useAuth } from '../../../context/AuthContext';

const TODAY = new Date().toISOString().split('T')[0];
const PERIODS = ['1','2','3','4','5','6','7','8'];
const EMPTY = { Date:TODAY, Subject:'', Topic:'', ClassNo:'', Period:'', StudentsPresent:'' };

export default function WorkDiary() {
  const { user } = useAuth();
  const [entries, setEntries] = useState([]);
  const [loading, setLoading] = useState(true);
  const [addOpen, setAddOpen] = useState(false);
  const [form,    setForm]    = useState(EMPTY);
  const [saving,  setSaving]  = useState(false);
  const [delId,   setDelId]   = useState(null);
  const [error,   setError]   = useState('');
  const [snack,   setSnack]   = useState({ open:false, msg:'', sev:'success' });

  const load = async () => {
    setLoading(true);
    try {
      const { data } = await getWorkDiary(user?.id);
      if (data.success) setEntries(data.data);
      else setError(data.message || 'Load failed.');
    } catch (err) { setError(err.response?.data?.message || 'Failed to load diary.'); }
    finally { setLoading(false); }
  };
  useEffect(() => { if (user?.id) load(); }, [user]);

  const set = (k) => (e) => setForm(f => ({ ...f, [k]: e.target.value }));

  const handleAdd = async () => {
    if (!form.Subject || !form.Topic || !form.Date) { setError('Date, Subject and Topic are required.'); return; }
    setSaving(true); setError('');
    try {
      const { data } = await addWorkDiary({ ...form, SID: user?.id });
      if (data.success) {
        setSnack({ open:true, msg:'Work diary entry added!', sev:'success' });
        setAddOpen(false); setForm(EMPTY); load();
      } else { setError(data.message); }
    } catch (err) { setError(err.response?.data?.message || 'Save failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async () => {
    try {
      await deleteWorkDiary(delId);
      setSnack({ open:true, msg:'Entry deleted.', sev:'info' });
      setDelId(null); load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  // Group entries by date
  const grouped = entries.reduce((acc, e) => {
    const d = e.Date || 'Unknown';
    if (!acc[d]) acc[d] = [];
    acc[d].push(e);
    return acc;
  }, {});

  return (
    <Box sx={{ p:3 }}>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h5" fontWeight={700}>Work Diary</Typography>
          <Typography variant="body2" color="text.secondary">{user?.name} · {user?.dept}</Typography>
        </Box>
        <Button id="add-diary-btn" variant="contained" startIcon={<Add />} onClick={() => setAddOpen(true)}>
          Add Entry
        </Button>
      </Box>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {loading ? (
        <Box display="flex" justifyContent="center" py={6}><CircularProgress /></Box>
      ) : entries.length === 0 ? (
        <Box py={8} textAlign="center">
          <Work sx={{ fontSize:56, color:'#ccc', mb:2 }} />
          <Typography color="text.secondary">No work diary entries yet. Add your first entry!</Typography>
        </Box>
      ) : (
        Object.entries(grouped)
          .sort(([a],[b]) => b.localeCompare(a))
          .map(([date, dayEntries]) => (
          <Box key={date} mb={3}>
            <Box display="flex" alignItems="center" gap={1} mb={1.5}>
              <Chip label={new Date(date).toLocaleDateString('en-IN',{weekday:'long',day:'numeric',month:'long',year:'numeric'})}
                color="primary" size="small" />
              <Chip label={`${dayEntries.length} period(s)`} variant="outlined" size="small" />
            </Box>
            <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 1px 8px rgba(0,0,0,0.06)' }}>
              <Table size="small">
                <TableHead>
                  <TableRow sx={{ bgcolor:'#F4F6F8' }}>
                    <TableCell sx={{ fontWeight:700 }}>Period</TableCell>
                    <TableCell sx={{ fontWeight:700 }}>Class</TableCell>
                    <TableCell sx={{ fontWeight:700 }}>Subject</TableCell>
                    <TableCell sx={{ fontWeight:700 }}>Topic Covered</TableCell>
                    <TableCell sx={{ fontWeight:700 }}>Students</TableCell>
                    <TableCell />
                  </TableRow>
                </TableHead>
                <TableBody>
                  {dayEntries.map((e, i) => {
                    const pk = e.WID ?? e.ID ?? e.id ?? i;
                    return (
                      <TableRow key={pk} hover>
                        <TableCell><Chip label={`Period ${e.Period || '—'}`} size="small" variant="outlined"/></TableCell>
                        <TableCell>{e.ClassNo || '—'}</TableCell>
                        <TableCell><b>{e.Subject}</b></TableCell>
                        <TableCell>{e.Topic}</TableCell>
                        <TableCell>{e.StudentsPresent ?? e.NoStudents ?? '—'}</TableCell>
                        <TableCell align="right">
                          <IconButton id={`del-diary-${pk}`} size="small" color="error"
                            onClick={() => setDelId(pk)}>
                            <Delete fontSize="small" />
                          </IconButton>
                        </TableCell>
                      </TableRow>
                    );
                  })}
                </TableBody>
              </Table>
            </TableContainer>
          </Box>
        ))
      )}

      {/* Add Dialog */}
      <Dialog open={addOpen} onClose={() => setAddOpen(false)} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          Add Work Diary Entry
          <IconButton onClick={() => setAddOpen(false)}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid item xs={6}><TextField id="diary-date" fullWidth label="Date *" type="date" InputLabelProps={{ shrink:true }} value={form.Date} onChange={set('Date')} /></Grid>
            <Grid item xs={6}>
              <FormControl fullWidth>
                <InputLabel>Period</InputLabel>
                <Select value={form.Period} label="Period" id="diary-period" onChange={set('Period')}>
                  {PERIODS.map(p => <MenuItem key={p} value={p}>Period {p}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={6}><TextField id="diary-class" fullWidth label="Class / Section" value={form.ClassNo} onChange={set('ClassNo')} placeholder="e.g. III B.Sc IT A" /></Grid>
            <Grid item xs={6}><TextField id="diary-students" fullWidth label="Students Present" type="number" value={form.StudentsPresent} onChange={set('StudentsPresent')} /></Grid>
            <Grid item xs={12}><TextField id="diary-subject" fullWidth label="Subject *" value={form.Subject} onChange={set('Subject')} /></Grid>
            <Grid item xs={12}><TextField id="diary-topic" fullWidth label="Topic Covered *" multiline rows={2} value={form.Topic} onChange={set('Topic')} /></Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={() => setAddOpen(false)}>Cancel</Button>
          <Button id="save-diary-btn" variant="contained" onClick={handleAdd} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : 'Add Entry'}
          </Button>
        </DialogActions>
      </Dialog>

      {/* Delete Confirm */}
      <Dialog open={!!delId} onClose={() => setDelId(null)} maxWidth="xs" fullWidth>
        <DialogTitle>Delete Entry</DialogTitle>
        <DialogContent><Typography>Remove this work diary entry?</Typography></DialogContent>
        <DialogActions>
          <Button onClick={() => setDelId(null)}>Cancel</Button>
          <Button id="confirm-del-diary" color="error" variant="contained" onClick={handleDelete}>Delete</Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
