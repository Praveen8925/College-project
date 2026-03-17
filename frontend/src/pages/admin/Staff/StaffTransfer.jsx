import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, Dialog, DialogTitle,
  DialogContent, DialogActions, IconButton, Alert, Snackbar,
  CircularProgress, Chip,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Close, SwapHoriz } from '@mui/icons-material';
import { getTransfers, saveTransfer, getStaffList } from '../../../api/staff';
import PageWrapper from '../../../components/common/PageWrapper';

const DEPTS = ['CSE','IT','ECE','EEE','MECH','CIVIL','MBA','MCA'];
const EMPTY = { Staffid:'', Department:'', Transferedto:'', Date:'' };

export default function StaffTransfer() {
  const [rows,     setRows]     = useState([]);
  const [staffOpts,setStaffOpts]= useState([]);
  const [loading,  setLoading]  = useState(true);
  const [filterDept,setFilterDept]=useState('');
  const [dialog,   setDialog]   = useState({ open:false, data:{ ...EMPTY } });
  const [snack,    setSnack]    = useState({ open:false, msg:'', sev:'success' });
  const [saving,   setSaving]   = useState(false);
  const [error,    setError]    = useState('');

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getTransfers({ dept: filterDept });
      if (data.success) setRows(data.data.map((r,i)=>({ ...r, id:i })));
    } catch { setError('Failed to load transfers.'); }
    finally { setLoading(false); }
  }, [filterDept]);

  const loadStaff = async () => {
    try {
      const { data } = await getStaffList();
      if (data.success) setStaffOpts(data.data || []);
    } catch {}
  };

  useEffect(() => { load(); }, [load]);

  const openDialog = () => {
    loadStaff();
    setError('');
    setDialog({ open:true, data:{ ...EMPTY, Date: new Date().toISOString().split('T')[0] } });
  };

  const handleSave = async () => {
    const d = dialog.data;
    if (!d.Staffid || !d.Transferedto || !d.Date) {
      setError('Please fill all required fields.'); return;
    }
    setSaving(true); setError('');
    try {
      await saveTransfer(d);
      setSnack({ open:true, msg:'Transfer recorded!', sev:'success' });
      setDialog(prev => ({ ...prev, open:false }));
      load();
    } catch(e) { setError(e.response?.data?.message || 'Save failed.'); }
    finally { setSaving(false); }
  };

  const set = k => e => setDialog(d => ({ ...d, data:{ ...d.data, [k]:e.target.value } }));

  const columns = [
    { field:'Staffid',     headerName:'Staff ID',   width:120 },
    { field:'StaffName',   headerName:'Staff Name', flex:1, minWidth:150 },
    { field:'Department',  headerName:'From Dept',  width:130 },
    { field:'Transferedto',headerName:'To Dept',    width:130,
      renderCell: p => <Chip label={p.value} size="small" sx={{ bgcolor:'#EEF2FF', color:'#4F46E5', fontWeight:600 }} /> },
    { field:'Date', headerName:'Transfer Date', width:140,
      renderCell: p => p.value ? new Date(p.value).toLocaleDateString('en-IN') : '—' },
  ];

  return (
    <PageWrapper>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Staff Transfer</Typography>
          <Typography variant="body2" color="text.secondary">Record inter-department staff transfers</Typography>
        </Box>
        <Button variant="contained" startIcon={<SwapHoriz />} onClick={openDialog}>
          New Transfer
        </Button>
      </Box>

      {/* Filter */}
      <Card sx={{ mb:2 }}>
        <CardContent sx={{ py:1.5 }}>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Filter by Department</InputLabel>
                <Select value={filterDept} label="Filter by Department" onChange={e=>setFilterDept(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {DEPTS.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid>
              <Button variant="outlined" onClick={load}>Search</Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && !dialog.open && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      <Box sx={{ borderRadius:2, overflow:'hidden', boxShadow:'0 1px 3px rgba(0,0,0,0.08)' }}>
        <DataGrid rows={rows} columns={columns} loading={loading}
          pageSizeOptions={[10,25]} initialState={{ pagination:{ paginationModel:{ pageSize:10 } } }}
          disableRowSelectionOnClick autoHeight
          sx={{ bgcolor:'white', border:'none', '& .MuiDataGrid-columnHeaders':{ bgcolor:'#F9FAFB', fontWeight:700 } }}
        />
      </Box>

      {/* Dialog */}
      <Dialog open={dialog.open} onClose={()=>setDialog(d=>({...d,open:false}))} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          <Box display="flex" alignItems="center" gap={1}>
            <SwapHoriz color="primary" />
            Record Staff Transfer
          </Box>
          <IconButton onClick={()=>setDialog(d=>({...d,open:false}))}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid size={{ xs:12 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Staff *</InputLabel>
                <Select value={dialog.data.Staffid} label="Staff *" onChange={e => {
                  const s = staffOpts.find(x=>x.SID===e.target.value);
                  setDialog(d=>({ ...d, data:{ ...d.data, Staffid:e.target.value, Department:s?.Department||'' } }));
                }}>
                  {staffOpts.map(s=><MenuItem key={s.SID} value={s.SID}>{s.Name} ({s.SID}) — {s.Department}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:6 }}>
              <TextField fullWidth size="small" label="Current Department" value={dialog.data.Department}
                InputProps={{ readOnly:true }} helperText="Auto-filled from staff record" />
            </Grid>
            <Grid size={{ xs:6 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Transfer To *</InputLabel>
                <Select value={dialog.data.Transferedto} label="Transfer To *" onChange={set('Transferedto')}>
                  {DEPTS.filter(d=>d!==dialog.data.Department).map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:6 }}>
              <TextField fullWidth size="small" label="Transfer Date *" type="date"
                value={dialog.data.Date} onChange={set('Date')} InputLabelProps={{ shrink:true }} />
            </Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={()=>setDialog(d=>({...d,open:false}))}>Cancel</Button>
          <Button variant="contained" onClick={handleSave} disabled={saving} startIcon={saving?<CircularProgress size={16}/>:null}>
            {saving ? 'Saving…' : 'Record Transfer'}
          </Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={()=>setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
