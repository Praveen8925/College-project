import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, Dialog, DialogTitle,
  DialogContent, DialogActions, IconButton, Tooltip, Alert,
  Snackbar, CircularProgress, Chip,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Delete, Search, Close } from '@mui/icons-material';
import { getAllocations, saveAllocation, deleteAllocation } from '../../../api/staff';
import PageWrapper from '../../../components/common/PageWrapper';

const EMPTY = { Batch:'', Sem:'', Department:'', Staff_Department:'', Type:'odd', CourseID:'', StaffID:'' };

export default function StaffAllocation() {
  const [rows,     setRows]     = useState([]);
  const [staffList,setStaffList]= useState([]);
  const [subjects, setSubjects] = useState([]);
  const [depts,    setDepts]    = useState([]);
  const [batches,  setBatches]  = useState([]);
  const [loading,  setLoading]  = useState(true);
  const [filterDept, setFilterDept] = useState('');
  const [filterBatch,setFilterBatch]= useState('');
  const [filterSem,  setFilterSem]  = useState('');
  const [dialog,   setDialog]   = useState({ open:false, data:{ ...EMPTY } });
  const [delDlg,   setDelDlg]   = useState({ open:false, row:null });
  const [snack,    setSnack]    = useState({ open:false, msg:'', sev:'success' });
  const [saving,   setSaving]   = useState(false);
  const [error,    setError]    = useState('');

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getAllocations({ dept:filterDept, batch:filterBatch, sem:filterSem });
      if (data.success) {
        setRows(data.data.map((r,i)=>({ ...r, id:`${r.Batch}-${r.Sem}-${r.CourseID}` })));
        setStaffList(data.staff || []);
        setSubjects(data.subjects || []);
        setDepts(data.depts || []);
        setBatches(data.batches || []);
      }
    } catch { setError('Failed to load allocations.'); }
    finally { setLoading(false); }
  }, [filterDept, filterBatch, filterSem]);

  useEffect(() => { load(); }, [load]);

  const handleSave = async () => {
    setSaving(true); setError('');
    try {
      await saveAllocation(dialog.data);
      setSnack({ open:true, msg:'Allocation saved!', sev:'success' });
      setDialog(d=>({ ...d, open:false }));
      load();
    } catch(e) { setError(e.response?.data?.message || 'Save failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async () => {
    const r = delDlg.row;
    try {
      await deleteAllocation({ batch:r.Batch, sem:r.Sem, code:r.CourseID });
      setSnack({ open:true, msg:'Removed.', sev:'info' });
      setDelDlg({ open:false, row:null }); load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  const set = k => e => setDialog(d=>({ ...d, data:{ ...d.data, [k]:e.target.value } }));

  const columns = [
    { field:'Batch',      headerName:'Batch',      width:80 },
    { field:'Sem',        headerName:'Sem',         width:60 },
    { field:'Department', headerName:'Department',  width:130 },
    { field:'CourseID',   headerName:'Course ID',   width:120 },
    { field:'Course_Name',headerName:'Subject',     flex:1, minWidth:160 },
    { field:'StaffName',  headerName:'Staff',       width:160,
      renderCell: p => p.value || <Chip label={p.row.StaffID} size="small" variant="outlined" /> },
    { field:'Type',       headerName:'Type',        width:80,
      renderCell: p => <Chip label={p.value} size="small"
        sx={{ bgcolor: p.value==='odd'?'#EEF2FF':'#ECFDF5', color: p.value==='odd'?'#4F46E5':'#059669' }} /> },
    {
      field:'actions', headerName:'Actions', width:90, sortable:false,
      renderCell: p => (
        <Tooltip title="Remove">
          <IconButton size="small" color="error" onClick={() => setDelDlg({ open:true, row:p.row })}>
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
          <Typography variant="h4" fontWeight={700}>Staff Allocation</Typography>
          <Typography variant="body2" color="text.secondary">Assign staff members to subjects &amp; classes</Typography>
        </Box>
        <Button variant="contained" startIcon={<Add />} onClick={() => setDialog({ open:true, data:{ ...EMPTY } })}>
          Add Allocation
        </Button>
      </Box>

      {/* Filters */}
      <Card sx={{ mb: 2 }}>
        <CardContent sx={{ py: 1.5 }}>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs: 12, sm: 4, md: 3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department</InputLabel>
                <Select value={filterDept} label="Department" onChange={e=>setFilterDept(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {depts.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 6, sm: 3, md: 2 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Batch</InputLabel>
                <Select value={filterBatch} label="Batch" onChange={e=>setFilterBatch(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {batches.map(b=><MenuItem key={b} value={b}>{b}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 6, sm: 3, md: 2 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester</InputLabel>
                <Select value={filterSem} label="Semester" onChange={e=>setFilterSem(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {[1,2,3,4,5,6].map(s=><MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid>
              <Button variant="outlined" startIcon={<Search />} onClick={load}>Search</Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      <Box sx={{ borderRadius:2, overflow:'hidden', boxShadow:'0 1px 3px rgba(0,0,0,0.08)' }}>
        <DataGrid rows={rows} columns={columns} loading={loading}
          pageSizeOptions={[10,25,50]} initialState={{ pagination:{ paginationModel:{ pageSize:10 } } }}
          disableRowSelectionOnClick autoHeight
          sx={{ bgcolor:'white', border:'none', '& .MuiDataGrid-columnHeaders':{ bgcolor:'#F9FAFB', fontWeight:700 } }}
        />
      </Box>

      {/* Add Dialog */}
      <Dialog open={dialog.open} onClose={() => setDialog(d=>({...d,open:false}))} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          Add Staff Allocation
          <IconButton onClick={() => setDialog(d=>({...d,open:false}))}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid size={{ xs: 6 }}>
              <TextField fullWidth size="small" label="Batch *" value={dialog.data.Batch} onChange={set('Batch')} />
            </Grid>
            <Grid size={{ xs: 6 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester *</InputLabel>
                <Select value={dialog.data.Sem} label="Semester *" onChange={set('Sem')}>
                  {[1,2,3,4,5,6].map(s=><MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 12 }}>
              <TextField fullWidth size="small" label="Department *" value={dialog.data.Department} onChange={set('Department')} />
            </Grid>
            <Grid size={{ xs: 12 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Subject *</InputLabel>
                <Select value={dialog.data.CourseID} label="Subject *" onChange={e => {
                  const sub = subjects.find(s=>s.CourseID===e.target.value);
                  setDialog(d=>({ ...d, data:{ ...d.data, CourseID:e.target.value, Department:sub?.Programme_Name||d.data.Department } }));
                }}>
                  {subjects.map(s=><MenuItem key={s.CourseID} value={s.CourseID}>{s.Course_Name} ({s.CourseID})</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 12 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Staff *</InputLabel>
                <Select value={dialog.data.StaffID} label="Staff *" onChange={set('StaffID')}>
                  {staffList.map(s=><MenuItem key={s.SID} value={s.SID}>{s.Name} ({s.SID})</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 6 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Type</InputLabel>
                <Select value={dialog.data.Type} label="Type" onChange={set('Type')}>
                  <MenuItem value="odd">Odd</MenuItem>
                  <MenuItem value="even">Even</MenuItem>
                </Select>
              </FormControl>
            </Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={() => setDialog(d=>({...d,open:false}))}>Cancel</Button>
          <Button variant="contained" onClick={handleSave} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : 'Save Allocation'}
          </Button>
        </DialogActions>
      </Dialog>

      {/* Delete confirm */}
      <Dialog open={delDlg.open} onClose={()=>setDelDlg({open:false,row:null})} maxWidth="xs" fullWidth>
        <DialogTitle>Remove Allocation</DialogTitle>
        <DialogContent>
          <Typography>Remove <b>{delDlg.row?.Course_Name || delDlg.row?.CourseID}</b> from <b>{delDlg.row?.StaffName}</b>?</Typography>
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
