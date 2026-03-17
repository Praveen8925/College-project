import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, Dialog, DialogTitle,
  DialogContent, DialogActions, IconButton, Alert, Snackbar,
  CircularProgress, Tooltip,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Delete, Close, ManageAccounts } from '@mui/icons-material';
import { getClassIncharge, saveClassIncharge, deleteClassIncharge, getStaffList } from '../../../api/staff';
import PageWrapper from '../../../components/common/PageWrapper';

const DEPTS = ['CSE','IT','ECE','EEE','MECH','CIVIL','MBA','MCA'];
const EMPTY = { Batch:'', Department:'', sem:'', SID:'' };

export default function ClassIncharge() {
  const [rows,     setRows]     = useState([]);
  const [staffOpts,setStaffOpts]= useState([]);
  const [loading,  setLoading]  = useState(true);
  const [filterDept,setFilterDept]= useState('');
  const [dialog,   setDialog]   = useState({ open:false, data:{ ...EMPTY } });
  const [delDlg,   setDelDlg]   = useState({ open:false, row:null });
  const [snack,    setSnack]    = useState({ open:false, msg:'', sev:'success' });
  const [saving,   setSaving]   = useState(false);
  const [error,    setError]    = useState('');

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getClassIncharge({ dept: filterDept });
      if (data.success) setRows(data.data.map((r,i)=>({ ...r, id:`${r.Batch}-${r.Department}-${r.sem}` })));
    } catch { setError('Failed to load data.'); }
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
    loadStaff(); setError('');
    setDialog({ open:true, data:{ ...EMPTY } });
  };

  const handleSave = async () => {
    const d = dialog.data;
    if (!d.Batch || !d.Department || !d.sem || !d.SID) {
      setError('All fields are required.'); return;
    }
    setSaving(true); setError('');
    try {
      await saveClassIncharge(d);
      setSnack({ open:true, msg:'Class incharge assigned!', sev:'success' });
      setDialog(prev => ({ ...prev, open:false }));
      load();
    } catch(e) { setError(e.response?.data?.message || 'Save failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async () => {
    const r = delDlg.row;
    try {
      await deleteClassIncharge({ batch:r.Batch, dept:r.Department, sem:r.sem });
      setSnack({ open:true, msg:'Removed.', sev:'info' });
      setDelDlg({ open:false, row:null }); load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  const set = k => e => setDialog(d=>({ ...d, data:{ ...d.data, [k]:e.target.value } }));

  const columns = [
    { field:'Batch',      headerName:'Batch',      width:90 },
    { field:'Department', headerName:'Department', width:130 },
    { field:'sem',        headerName:'Sem',        width:70 },
    { field:'SID',        headerName:'Staff ID',   width:120 },
    { field:'StaffName',  headerName:'Staff Name', flex:1, minWidth:160 },
    { field:'Qualification', headerName:'Qualification', width:150 },
    {
      field:'actions', headerName:'Actions', width:90, sortable:false,
      renderCell: p => (
        <Tooltip title="Remove">
          <IconButton size="small" color="error" onClick={()=>setDelDlg({ open:true, row:p.row })}>
            <Delete fontSize="small" />
          </IconButton>
        </Tooltip>
      ),
    },
  ];

  return (
    <PageWrapper>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Class Incharge</Typography>
          <Typography variant="body2" color="text.secondary">Assign class incharge for each batch &amp; semester</Typography>
        </Box>
        <Button variant="contained" startIcon={<Add />} onClick={openDialog}>Assign Incharge</Button>
      </Box>

      <Card sx={{ mb:2 }}>
        <CardContent sx={{ py:1.5 }}>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department</InputLabel>
                <Select value={filterDept} label="Department" onChange={e=>setFilterDept(e.target.value)}>
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

      {/* Assign dialog */}
      <Dialog open={dialog.open} onClose={()=>setDialog(d=>({...d,open:false}))} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          <Box display="flex" alignItems="center" gap={1}><ManageAccounts color="primary"/>Assign Class Incharge</Box>
          <IconButton onClick={()=>setDialog(d=>({...d,open:false}))}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid size={{ xs:6 }}>
              <TextField fullWidth size="small" label="Batch *" value={dialog.data.Batch} onChange={set('Batch')} />
            </Grid>
            <Grid size={{ xs:6 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester *</InputLabel>
                <Select value={dialog.data.sem} label="Semester *" onChange={set('sem')}>
                  {[1,2,3,4,5,6].map(s=><MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:12 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department *</InputLabel>
                <Select value={dialog.data.Department} label="Department *" onChange={set('Department')}>
                  {DEPTS.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:12 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Staff (Incharge) *</InputLabel>
                <Select value={dialog.data.SID} label="Staff (Incharge) *" onChange={set('SID')}>
                  {staffOpts.map(s=><MenuItem key={s.SID} value={s.SID}>{s.Name} — {s.Department}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={()=>setDialog(d=>({...d,open:false}))}>Cancel</Button>
          <Button variant="contained" onClick={handleSave} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : 'Assign'}
          </Button>
        </DialogActions>
      </Dialog>

      {/* Delete confirm */}
      <Dialog open={delDlg.open} onClose={()=>setDelDlg({open:false,row:null})} maxWidth="xs" fullWidth>
        <DialogTitle>Remove Class Incharge</DialogTitle>
        <DialogContent>
          <Typography>Remove incharge for Batch <b>{delDlg.row?.Batch}</b>, {delDlg.row?.Department}, Sem <b>{delDlg.row?.sem}</b>?</Typography>
        </DialogContent>
        <DialogActions>
          <Button onClick={()=>setDelDlg({open:false,row:null})}>Cancel</Button>
          <Button color="error" variant="contained" onClick={handleDelete}>Remove</Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={()=>setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
