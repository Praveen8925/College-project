import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, Button, TextField, Select,
  MenuItem, FormControl, InputLabel, Grid, Dialog, DialogTitle,
  DialogContent, DialogActions, CircularProgress, Alert, Snackbar,
  Chip, List, ListItem, ListItemText, Divider, IconButton,
} from '@mui/material';
import { Add, Close, ReportProblem } from '@mui/icons-material';
import { getStudentComplaints, submitComplaint } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';

const TYPES      = ['Academic','Hostel','Transport','Library','Lab','Canteen','Staff','Other'];
const COMPLAINT_TO = ['HOD','Principal','Admin','Class Advisor'];
const STATUS_COLOR = { Pending:'warning', Resolved:'success', default:'default' };
const TODAY = new Date().toISOString().split('T')[0];
const EMPTY = { Type:'Academic', Complaint_To:'HOD', Description:'', class_no:'', Date:TODAY };

export default function MyComplaints() {
  const { user }  = useAuth();
  const [complaints, setComplaints] = useState([]);
  const [loading,    setLoading]    = useState(true);
  const [addOpen,    setAddOpen]    = useState(false);
  const [form,       setForm]       = useState(EMPTY);
  const [saving,     setSaving]     = useState(false);
  const [error,      setError]      = useState('');
  const [snack,      setSnack]      = useState({ open:false, msg:'', sev:'success' });

  const load = async () => {
    setLoading(true);
    try {
      const { data } = await getStudentComplaints({ batch:user?.batch, dept:user?.dept });
      if (data.success) setComplaints(data.data);
      else setError(data.message || 'No data.');
    } catch { setError('Could not load complaints.'); }
    finally { setLoading(false); }
  };
  useEffect(() => { if (user?.id) load(); }, [user]);

  const set = (k) => (e) => setForm(f => ({ ...f, [k]: e.target.value }));

  const handleSubmit = async () => {
    if (!form.Description.trim()) { setError('Description is required.'); return; }
    setSaving(true); setError('');
    try {
      const { data } = await submitComplaint({
        ...form,
        Batch:      user?.batch,
        Department: user?.dept,
      });
      if (data.success) {
        setSnack({ open:true, msg:`Complaint ${data.id} submitted successfully!`, sev:'success' });
        setAddOpen(false); setForm(EMPTY); load();
      } else { setError(data.message || 'Submission failed.'); }
    } catch (err) { setError(err.response?.data?.message || 'Submission failed.'); }
    finally { setSaving(false); }
  };

  const pending  = complaints.filter(c => c.Status !== 'Resolved').length;
  const resolved = complaints.filter(c => c.Status === 'Resolved').length;

  return (
    <Box sx={{ p:3 }}>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h5" fontWeight={700}>My Complaints</Typography>
          <Typography variant="body2" color="text.secondary">
            Batch {user?.batch} · {user?.dept}
          </Typography>
        </Box>
        <Button id="submit-complaint-btn" variant="contained" startIcon={<Add />}
          onClick={() => setAddOpen(true)}>
          Submit Complaint
        </Button>
      </Box>

      {/* Stats Row */}
      <Grid container spacing={2} mb={3}>
        {[
          { label:'Total',    value: complaints.length, color:'#1A237E' },
          { label:'Pending',  value: pending,           color:'#E65100' },
          { label:'Resolved', value: resolved,          color:'#2E7D32' },
        ].map(s => (
          <Grid item xs={4} key={s.label}>
            <Card sx={{ textAlign:'center' }}>
              <CardContent sx={{ py:'14px !important' }}>
                <Typography variant="h3" fontWeight={800} color={s.color}>{loading ? '…' : s.value}</Typography>
                <Typography variant="body2" color="text.secondary">{s.label}</Typography>
              </CardContent>
            </Card>
          </Grid>
        ))}
      </Grid>

      {/* Complaint List */}
      {loading ? (
        <Box display="flex" justifyContent="center" py={6}><CircularProgress /></Box>
      ) : complaints.length === 0 ? (
        <Box py={8} textAlign="center">
          <ReportProblem sx={{ fontSize:56, color:'#ccc', mb:2 }} />
          <Typography color="text.secondary">No complaints submitted yet.</Typography>
          <Button variant="contained" sx={{ mt:2 }} onClick={() => setAddOpen(true)}>Submit Your First Complaint</Button>
        </Box>
      ) : (
        <Card>
          <CardContent sx={{ p:0 }}>
            <List disablePadding>
              {complaints.map((c, i) => (
                <Box key={c.Complaint_ID}>
                  <ListItem sx={{ py:2, px:3 }}>
                    <Box width="100%">
                      <Box display="flex" justifyContent="space-between" alignItems="flex-start">
                        <Box display="flex" gap={1} flexWrap="wrap" alignItems="center">
                          <Typography variant="body2" fontWeight={700} color="text.secondary">{c.Complaint_ID}</Typography>
                          <Chip label={c.Type} size="small" variant="outlined" />
                          {c.Complaint_To && <Chip label={`To: ${c.Complaint_To}`} size="small" sx={{ bgcolor:'#E8EAF6' }} />}
                        </Box>
                        <Chip label={c.Status} size="small"
                          color={STATUS_COLOR[c.Status] || 'default'} />
                      </Box>
                      <Typography variant="body1" mt={0.8} fontWeight={500}>{c.Description}</Typography>
                      {c.Status === 'Resolved' && c.solved_description && (
                        <Box mt={1} p={1} sx={{ bgcolor:'#E8F5E9', borderRadius:1 }}>
                          <Typography variant="caption" color="success.main">
                            <b>Resolution:</b> {c.solved_description}
                          </Typography>
                        </Box>
                      )}
                      <Typography variant="caption" color="text.secondary" display="block" mt={0.5}>
                        Filed: {c.Date}
                        {c.rdate && ` · Resolved: ${c.rdate}`}
                      </Typography>
                    </Box>
                  </ListItem>
                  {i < complaints.length - 1 && <Divider />}
                </Box>
              ))}
            </List>
          </CardContent>
        </Card>
      )}

      {/* Submit Dialog */}
      <Dialog open={addOpen} onClose={() => setAddOpen(false)} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          Submit New Complaint
          <IconButton onClick={() => setAddOpen(false)}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid item xs={6}>
              <FormControl fullWidth>
                <InputLabel>Complaint Type *</InputLabel>
                <Select value={form.Type} label="Complaint Type *" id="cmp-type" onChange={set('Type')}>
                  {TYPES.map(t => <MenuItem key={t} value={t}>{t}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={6}>
              <FormControl fullWidth>
                <InputLabel>Complaint To</InputLabel>
                <Select value={form.Complaint_To} label="Complaint To" id="cmp-to" onChange={set('Complaint_To')}>
                  {COMPLAINT_TO.map(t => <MenuItem key={t} value={t}>{t}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={6}>
              <TextField id="cmp-date" fullWidth label="Date" type="date" InputLabelProps={{ shrink:true }}
                value={form.Date} onChange={set('Date')} />
            </Grid>
            <Grid item xs={6}>
              <TextField id="cmp-class" fullWidth label="Class / Section" value={form.class_no}
                onChange={set('class_no')} placeholder="e.g. III B.Sc IT A" />
            </Grid>
            <Grid item xs={12}>
              <TextField id="cmp-desc" fullWidth label="Description *" multiline rows={4}
                value={form.Description} onChange={set('Description')}
                placeholder="Describe your complaint in detail…" />
            </Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={() => setAddOpen(false)}>Cancel</Button>
          <Button id="submit-complaint-confirm" variant="contained" color="error"
            onClick={handleSubmit} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : 'Submit Complaint'}
          </Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={4000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
