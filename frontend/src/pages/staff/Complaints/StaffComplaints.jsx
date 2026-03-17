import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, Button, TextField, Select,
  MenuItem, FormControl, InputLabel, Grid, Dialog, DialogTitle,
  DialogContent, DialogActions, CircularProgress, Alert, Snackbar,
  Chip, List, ListItem, ListItemText, Divider, IconButton,
} from '@mui/material';
import { Add, Close, ReportProblem, CheckCircle, HourglassEmpty } from '@mui/icons-material';
import { getComplaints, addComplaint } from '../../../api/complaints';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';
import StatusBadge from '../../../components/common/StatusBadge';

const TYPES = ['Infrastructure','Student Discipline','Academic','Hostel','Lab','Library','Other'];
const COMPLAINT_TO = ['HOD','Principal','Admin','Management'];
const TODAY = new Date().toISOString().split('T')[0];
const EMPTY = { Type:'Infrastructure', Complaint_To:'HOD', Description:'', class_no:'', Date:TODAY };

export default function StaffComplaints() {
  const { user } = useAuth();
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
      // Load complaints submitted by this staff (filter by dept)
      const { data } = await getComplaints({ dept: user?.dept });
      if (data.success) setComplaints(data.data || []);
    } catch { /* silent */ }
    finally { setLoading(false); }
  };

  useEffect(() => { if (user?.id) load(); }, [user]);

  const set = k => e => setForm(f => ({ ...f, [k]: e.target.value }));

  const handleSubmit = async () => {
    if (!form.Description.trim()) { setError('Description is required.'); return; }
    setSaving(true); setError('');
    try {
      // Generate a unique complaint ID
      const cid = `ST${user?.id?.slice(-4) || 'XX'}${Date.now().toString().slice(-4)}`;
      const payload = {
        ...form,
        Complaint_ID: cid,
        Batch: new Date().getFullYear(),
        Department: user?.dept || '',
      };
      const { data } = await addComplaint(payload);
      if (data.success) {
        setSnack({ open:true, msg:'Complaint submitted successfully!', sev:'success' });
        setAddOpen(false); setForm(EMPTY); load();
      } else { setError(data.message || 'Submission failed.'); }
    } catch(e) { setError(e.response?.data?.message || 'Submission failed.'); }
    finally { setSaving(false); }
  };

  const pending  = complaints.filter(c => c.Status?.toLowerCase() !== 'resolved').length;
  const resolved = complaints.filter(c => c.Status?.toLowerCase() === 'resolved').length;

  return (
    <PageWrapper>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Complaints</Typography>
          <Typography variant="body2" color="text.secondary">Submit and track complaints — {user?.dept}</Typography>
        </Box>
        <Button variant="contained" startIcon={<Add />} onClick={() => { setError(''); setAddOpen(true); }}>
          New Complaint
        </Button>
      </Box>

      {/* Summary */}
      <Grid container spacing={2} mb={3}>
        <Grid size={{ xs:6, sm:3 }}>
          <Card sx={{ borderLeft:'4px solid #D97706', borderRadius:2 }}>
            <CardContent sx={{ py:1.5 }}>
              <Typography variant="h4" fontWeight={700} color="#D97706">{pending}</Typography>
              <Typography variant="caption" color="text.secondary">Pending</Typography>
            </CardContent>
          </Card>
        </Grid>
        <Grid size={{ xs:6, sm:3 }}>
          <Card sx={{ borderLeft:'4px solid #059669', borderRadius:2 }}>
            <CardContent sx={{ py:1.5 }}>
              <Typography variant="h4" fontWeight={700} color="#059669">{resolved}</Typography>
              <Typography variant="caption" color="text.secondary">Resolved</Typography>
            </CardContent>
          </Card>
        </Grid>
      </Grid>

      {/* Complaints list */}
      <Card sx={{ borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)' }}>
        <CardContent sx={{ p:0 }}>
          {loading ? (
            <Box display="flex" justifyContent="center" py={4}><CircularProgress /></Box>
          ) : complaints.length === 0 ? (
            <Box textAlign="center" py={5}>
              <ReportProblem sx={{ fontSize:48, color:'#D1D5DB', mb:1 }} />
              <Typography color="text.secondary">No complaints found</Typography>
            </Box>
          ) : (
            <List disablePadding>
              {complaints.map((c, i) => (
                <Box key={c.Complaint_ID}>
                  {i > 0 && <Divider />}
                  <ListItem alignItems="flex-start" sx={{ px:2.5, py:2, '&:hover':{ bgcolor:'#F9FAFB' } }}>
                    <ListItemText
                      primary={
                        <Box display="flex" alignItems="center" gap={1} flexWrap="wrap">
                          <Typography variant="body1" fontWeight={600}>{c.Description}</Typography>
                          <Chip label={c.Type} size="small" variant="outlined" />
                          <StatusBadge
                            status={c.Status?.toLowerCase()==='resolved' ? 'Resolved' : 'Pending'}
                          />
                        </Box>
                      }
                      secondary={
                        <Box mt={0.5}>
                          <Typography variant="caption" color="text.secondary">
                            ID: <b>{c.Complaint_ID}</b> &nbsp;|&nbsp;
                            To: <b>{c.Complaint_To}</b> &nbsp;|&nbsp;
                            Date: {c.Date ? new Date(c.Date).toLocaleDateString('en-IN') : '—'}
                            {c.class_no && <> &nbsp;|&nbsp; Room: <b>{c.class_no}</b></>}
                          </Typography>
                          {c.Status?.toLowerCase() === 'resolved' && c.solved_description && (
                            <Box mt={0.5} sx={{ bgcolor:'#ECFDF5', px:1.5, py:0.75, borderRadius:1 }}>
                              <Typography variant="caption" color="#059669">
                                ✓ Resolution: {c.solved_description}
                              </Typography>
                            </Box>
                          )}
                        </Box>
                      }
                    />
                  </ListItem>
                </Box>
              ))}
            </List>
          )}
        </CardContent>
      </Card>

      {/* Submit Dialog */}
      <Dialog open={addOpen} onClose={() => setAddOpen(false)} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          <Box display="flex" alignItems="center" gap={1}>
            <ReportProblem color="primary" /> New Complaint
          </Box>
          <IconButton onClick={() => setAddOpen(false)}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid size={{ xs:12, sm:6 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Type *</InputLabel>
                <Select value={form.Type} label="Type *" onChange={set('Type')}>
                  {TYPES.map(t => <MenuItem key={t} value={t}>{t}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:12, sm:6 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Complaint To *</InputLabel>
                <Select value={form.Complaint_To} label="Complaint To *" onChange={set('Complaint_To')}>
                  {COMPLAINT_TO.map(t => <MenuItem key={t} value={t}>{t}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:12, sm:6 }}>
              <TextField fullWidth size="small" label="Room / Class No" value={form.class_no} onChange={set('class_no')} />
            </Grid>
            <Grid size={{ xs:12, sm:6 }}>
              <TextField fullWidth size="small" type="date" label="Date *"
                value={form.Date} onChange={set('Date')} InputLabelProps={{ shrink:true }} />
            </Grid>
            <Grid size={{ xs:12 }}>
              <TextField fullWidth size="small" label="Description *" multiline rows={3}
                value={form.Description} onChange={set('Description')}
                placeholder="Describe the issue in detail…" />
            </Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={() => setAddOpen(false)}>Cancel</Button>
          <Button variant="contained" onClick={handleSubmit} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : 'Submit Complaint'}
          </Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3500} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
