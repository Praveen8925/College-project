import { useEffect, useState, useCallback } from 'react';
import {
  Box, Button, TextField, Select, MenuItem, FormControl, InputLabel,
  Chip, IconButton, Tooltip, Dialog, DialogTitle, DialogContent,
  DialogActions, Grid, Typography, Alert, Snackbar, InputAdornment,
  CircularProgress,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Edit, Delete, Search, Visibility, Close } from '@mui/icons-material';
import { getStudents, addStudent, updateStudent, deleteStudent } from '../../../api/students';

const DEPTS = ['B.Sc IT', 'B.Sc CS', 'BCA', 'B.Com', 'B.Com CA', 'B.Sc Maths', 'B.Sc Physics', 'B.Sc Chemistry'];
const GENDERS = ['Male', 'Female', 'Other'];
const SEMS = [1,2,3,4,5,6];
const EMPTY_FORM = { Regno:'', Name:'', Dept:'', Batch:'', sem:'', Gender:'', DOB:'', Address:'', Mobileno:'', Emailid:'', Password:'' };

export default function StudentList() {
  const [rows,      setRows]      = useState([]);
  const [depts,     setDepts]     = useState([]);
  const [batches,   setBatches]   = useState([]);
  const [loading,   setLoading]   = useState(true);
  const [search,    setSearch]    = useState('');
  const [filterDept,setFilterDept]= useState('');
  const [filterBatch,setFilterBatch]=useState('');
  const [dialog,    setDialog]    = useState({ open:false, mode:'add', data: EMPTY_FORM });
  const [delDialog, setDelDialog] = useState({ open:false, id:'', name:'' });
  const [snack,     setSnack]     = useState({ open:false, msg:'', sev:'success' });
  const [saving,    setSaving]    = useState(false);
  const [error,     setError]     = useState('');

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getStudents({ search, dept: filterDept, batch: filterBatch });
      if (data.success) {
        setRows(data.data.map(r => ({ ...r, id: r.Regno })));
        setDepts(data.depts || []);
        setBatches(data.batches || []);
      }
    } catch { setError('Failed to load students.'); }
    finally { setLoading(false); }
  }, [search, filterDept, filterBatch]);

  useEffect(() => { load(); }, [load]);

  const openAdd  = () => setDialog({ open:true, mode:'add', data: EMPTY_FORM });
  const openEdit = (row) => setDialog({ open:true, mode:'edit', data: { ...row } });
  const closeDialog = () => setDialog(d => ({ ...d, open:false }));

  const handleSave = async () => {
    setSaving(true); setError('');
    try {
      if (dialog.mode === 'add') {
        await addStudent(dialog.data);
        setSnack({ open:true, msg:'Student added successfully!', sev:'success' });
      } else {
        await updateStudent(dialog.data.Regno, dialog.data);
        setSnack({ open:true, msg:'Student updated successfully!', sev:'success' });
      }
      closeDialog(); load();
    } catch (err) {
      setError(err.response?.data?.message || 'Save failed.');
    } finally { setSaving(false); }
  };

  const handleDelete = async () => {
    try {
      await deleteStudent(delDialog.id);
      setSnack({ open:true, msg:'Student removed.', sev:'info' });
      setDelDialog({ open:false, id:'', name:'' });
      load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  const columns = [
    { field:'Regno', headerName:'Reg. No', width:120, renderCell: p => <b>{p.value}</b> },
    { field:'Name',   headerName:'Name',       flex:1, minWidth:150 },
    { field:'Dept',   headerName:'Department', width:160 },
    { field:'Batch',  headerName:'Batch',      width:80  },
    { field:'sem',    headerName:'Sem',        width:70, renderCell: p => <Chip label={p.value} size="small" variant="outlined" /> },
    { field:'Gender', headerName:'Gender',     width:90,
      renderCell: p => <Chip label={p.value} size="small" color={p.value==='Male'?'primary':'secondary'} variant="outlined" /> },
    { field:'Emailid', headerName:'Email',     flex:1, minWidth:180 },
    { field:'Mobileno', headerName:'Mobile',   width:120 },
    {
      field:'actions', headerName:'Actions', width:120, sortable:false,
      renderCell: (p) => (
        <Box>
          <Tooltip title="Edit"><IconButton id={`edit-student-${p.row.Regno}`} size="small" color="primary" onClick={() => openEdit(p.row)}><Edit fontSize="small" /></IconButton></Tooltip>
          <Tooltip title="Delete"><IconButton id={`delete-student-${p.row.Regno}`} size="small" color="error" onClick={() => setDelDialog({ open:true, id:p.row.Regno, name:p.row.Name })}><Delete fontSize="small" /></IconButton></Tooltip>
        </Box>
      ),
    },
  ];

  const set = (key) => (e) => setDialog(d => ({ ...d, data: { ...d.data, [key]: e.target.value } }));

  return (
    <Box sx={{ p: 3 }}>
      {/* Header */}
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
        <Box>
          <Typography variant="h5" fontWeight={700}>Student Management</Typography>
          <Typography variant="body2" color="text.secondary">{rows.length} student(s) found</Typography>
        </Box>
        <Button id="add-student-btn" variant="contained" startIcon={<Add />} onClick={openAdd}>Add Student</Button>
      </Box>

      {/* Filters */}
      <Box display="flex" gap={2} mb={2} flexWrap="wrap">
        <TextField id="student-search" size="small" placeholder="Search by name, reg. no or email..." value={search}
          onChange={e => setSearch(e.target.value)} sx={{ minWidth:260 }}
          InputProps={{ startAdornment: <InputAdornment position="start"><Search fontSize="small" /></InputAdornment> }} />
        <FormControl size="small" sx={{ minWidth:160 }}>
          <InputLabel>Department</InputLabel>
          <Select value={filterDept} label="Department" id="filter-dept" onChange={e => setFilterDept(e.target.value)}>
            <MenuItem value="">All</MenuItem>
            {depts.map(d => <MenuItem key={d} value={d}>{d}</MenuItem>)}
          </Select>
        </FormControl>
        <FormControl size="small" sx={{ minWidth:100 }}>
          <InputLabel>Batch</InputLabel>
          <Select value={filterBatch} label="Batch" id="filter-batch" onChange={e => setFilterBatch(e.target.value)}>
            <MenuItem value="">All</MenuItem>
            {batches.map(b => <MenuItem key={b} value={b}>{b}</MenuItem>)}
          </Select>
        </FormControl>
      </Box>

      {/* DataGrid */}
      <Box sx={{ borderRadius: 2, overflow: 'hidden', boxShadow: '0 2px 12px rgba(0,0,0,0.07)' }}>
        <DataGrid
          rows={rows} columns={columns} loading={loading}
          pageSizeOptions={[10,25,50]} initialState={{ pagination: { paginationModel: { pageSize: 10 } } }}
          disableRowSelectionOnClick autoHeight
          sx={{ bgcolor: 'white', border: 'none', '& .MuiDataGrid-columnHeaders': { bgcolor: '#F4F6F8', fontWeight: 700 } }}
        />
      </Box>

      {/* Add/Edit Dialog */}
      <Dialog open={dialog.open} onClose={closeDialog} maxWidth="md" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          {dialog.mode === 'add' ? 'Add New Student' : `Edit — ${dialog.data.Name}`}
          <IconButton onClick={closeDialog}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid item xs={12} sm={6}><TextField id="form-regno" fullWidth label="Register Number *" value={dialog.data.Regno} onChange={set('Regno')} disabled={dialog.mode==='edit'} /></Grid>
            <Grid item xs={12} sm={6}><TextField id="form-name" fullWidth label="Full Name *" value={dialog.data.Name} onChange={set('Name')} /></Grid>
            <Grid item xs={12} sm={6}>
              <FormControl fullWidth>
                <InputLabel>Department *</InputLabel>
                <Select value={dialog.data.Dept} label="Department *" id="form-dept" onChange={set('Dept')}>
                  {DEPTS.map(d => <MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={3}><TextField id="form-batch" fullWidth label="Batch (Year)" type="number" value={dialog.data.Batch} onChange={set('Batch')} /></Grid>
            <Grid item xs={12} sm={3}>
              <FormControl fullWidth>
                <InputLabel>Semester *</InputLabel>
                <Select value={dialog.data.sem} label="Semester *" id="form-sem" onChange={set('sem')}>
                  {SEMS.map(s => <MenuItem key={s} value={s}>{s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={6}>
              <FormControl fullWidth>
                <InputLabel>Gender *</InputLabel>
                <Select value={dialog.data.Gender} label="Gender *" id="form-gender" onChange={set('Gender')}>
                  {GENDERS.map(g => <MenuItem key={g} value={g}>{g}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={6}><TextField id="form-dob" fullWidth label="Date of Birth" type="date" InputLabelProps={{ shrink:true }} value={dialog.data.DOB||''} onChange={set('DOB')} /></Grid>
            <Grid item xs={12}><TextField id="form-address" fullWidth label="Address" multiline rows={2} value={dialog.data.Address||''} onChange={set('Address')} /></Grid>
            <Grid item xs={12} sm={6}><TextField id="form-mobile" fullWidth label="Mobile Number" value={dialog.data.Mobileno||''} onChange={set('Mobileno')} /></Grid>
            <Grid item xs={12} sm={6}><TextField id="form-email" fullWidth label="Email ID" type="email" value={dialog.data.Emailid||''} onChange={set('Emailid')} /></Grid>
            {dialog.mode === 'add' && (
              <Grid item xs={12} sm={6}><TextField id="form-password" fullWidth label="Password *" type="password" value={dialog.data.Password} onChange={set('Password')} /></Grid>
            )}
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={closeDialog}>Cancel</Button>
          <Button id="save-student-btn" variant="contained" onClick={handleSave} disabled={saving}>
            {saving ? <CircularProgress size={20} /> : (dialog.mode==='add' ? 'Add Student' : 'Save Changes')}
          </Button>
        </DialogActions>
      </Dialog>

      {/* Delete Confirm */}
      <Dialog open={delDialog.open} onClose={() => setDelDialog({ open:false, id:'', name:'' })} maxWidth="xs" fullWidth>
        <DialogTitle>Confirm Delete</DialogTitle>
        <DialogContent><Typography>Remove student <b>{delDialog.name}</b>? This cannot be undone.</Typography></DialogContent>
        <DialogActions>
          <Button onClick={() => setDelDialog({ open:false, id:'', name:'' })}>Cancel</Button>
          <Button id="confirm-delete-student" color="error" variant="contained" onClick={handleDelete}>Delete</Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
