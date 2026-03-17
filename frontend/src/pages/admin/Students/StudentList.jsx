import { useEffect, useState, useCallback } from 'react';
import {
  Box, Button, TextField, Select, MenuItem, FormControl, InputLabel,
  IconButton, Tooltip, Dialog, DialogTitle, DialogContent,
  DialogActions, Grid, Typography, Alert, Snackbar, InputAdornment,
  CircularProgress, Card,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Edit, Delete, Search, Close } from '@mui/icons-material';
import { motion } from 'framer-motion';
import { getStudents, addStudent, updateStudent, deleteStudent } from '../../../api/students';
import PageWrapper from '../../../components/common/PageWrapper';
import StatusBadge from '../../../components/common/StatusBadge';

const DEPTS = ['B.Sc IT', 'B.Sc CS', 'BCA', 'B.Com', 'B.Com CA', 'B.Sc Maths', 'B.Sc Physics', 'B.Sc Chemistry'];
const GENDERS = ['Male', 'Female', 'Other'];
const SEMS = [1,2,3,4,5,6];
const EMPTY_FORM = { RegNo:'', Name:'', Department:'', Batch:'', sem:'', Gender:'', DOB:'', Address:'', Mobileno:'', Emailid:'', Password:'' };

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
        setRows(data.data.map(r => ({ ...r, id: r.RegNo })));
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
        await updateStudent(dialog.data.RegNo, dialog.data);
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
    { field:'RegNo',  headerName:'REG. NO', width:120, renderCell: p => (
      <Typography variant="body2" fontWeight={600} color="primary.main">{p.value}</Typography>
    )},
    { field:'Name',   headerName:'NAME', flex:1, minWidth:150 },
    { field:'Department', headerName:'DEPARTMENT', width:140 },
    { field:'Batch',  headerName:'BATCH', width:80  },
    { field:'sem',    headerName:'SEM', width:70, renderCell: p => <StatusBadge status={`Sem ${p.value}`} color="primary" /> },
    { field:'Gender', headerName:'GENDER', width:100,
      renderCell: p => <StatusBadge status={p.value} color={p.value==='Male' ? 'info' : 'neutral'} /> },
    { field:'Emailid', headerName:'EMAIL', flex:1, minWidth:180 },
    { field:'Mobileno', headerName:'MOBILE', width:120 },
    {
      field:'actions', headerName:'ACTIONS', width:100, sortable:false,
      renderCell: (p) => (
        <Box sx={{ display: 'flex', gap: 0.5 }}>
          <Tooltip title="Edit">
            <IconButton 
              id={`edit-student-${p.row.RegNo}`} 
              size="small" 
              onClick={() => openEdit(p.row)}
              sx={{ color: '#6B7280', '&:hover': { color: '#4F46E5', bgcolor: 'rgba(79,70,229,0.1)' } }}
            >
              <Edit fontSize="small" />
            </IconButton>
          </Tooltip>
          <Tooltip title="Delete">
            <IconButton 
              id={`delete-student-${p.row.RegNo}`} 
              size="small" 
              onClick={() => setDelDialog({ open:true, id:p.row.RegNo, name:p.row.Name })}
              sx={{ color: '#6B7280', '&:hover': { color: '#EF4444', bgcolor: 'rgba(239,68,68,0.1)' } }}
            >
              <Delete fontSize="small" />
            </IconButton>
          </Tooltip>
        </Box>
      ),
    },
  ];

  const set = (key) => (e) => setDialog(d => ({ ...d, data: { ...d.data, [key]: e.target.value } }));

  return (
    <PageWrapper>
      {/* Header */}
      <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', mb: 3, flexWrap: 'wrap', gap: 2 }}>
        <Box>
          <Typography variant="h4" fontWeight={700} color="text.primary">Students</Typography>
          <Typography variant="body2" color="text.secondary">{rows.length} student(s) found</Typography>
        </Box>
        <Button 
          id="add-student-btn" 
          variant="contained" 
          startIcon={<Add />} 
          onClick={openAdd}
          sx={{ 
            bgcolor: '#4F46E5', 
            '&:hover': { bgcolor: '#4338CA' },
            boxShadow: 'none',
          }}
        >
          Add Student
        </Button>
      </Box>

      {/* Filters */}
      <Card 
        component={motion.div}
        initial={{ opacity: 0, y: 10 }}
        animate={{ opacity: 1, y: 0 }}
        sx={{ p: 2, mb: 3 }}
      >
        <Box sx={{ display: 'flex', gap: 2, flexWrap: 'wrap' }}>
          <TextField 
            id="student-search" 
            size="small" 
            placeholder="Search by name, reg. no or email..." 
            value={search}
            onChange={e => setSearch(e.target.value)} 
            sx={{ minWidth: 280, flex: 1 }}
            InputProps={{ 
              startAdornment: <InputAdornment position="start"><Search sx={{ color: '#9CA3AF' }} fontSize="small" /></InputAdornment> 
            }} 
          />
          <FormControl size="small" sx={{ minWidth: 160 }}>
            <InputLabel>Department</InputLabel>
            <Select value={filterDept} label="Department" id="filter-dept" onChange={e => setFilterDept(e.target.value)}>
              <MenuItem value="">All Departments</MenuItem>
              {depts.map(d => <MenuItem key={d} value={d}>{d}</MenuItem>)}
            </Select>
          </FormControl>
          <FormControl size="small" sx={{ minWidth: 120 }}>
            <InputLabel>Batch</InputLabel>
            <Select value={filterBatch} label="Batch" id="filter-batch" onChange={e => setFilterBatch(e.target.value)}>
              <MenuItem value="">All Batches</MenuItem>
              {batches.map(b => <MenuItem key={b} value={b}>{b}</MenuItem>)}
            </Select>
          </FormControl>
        </Box>
      </Card>

      {/* DataGrid */}
      <Card 
        component={motion.div}
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ delay: 0.1 }}
        sx={{ overflow: 'hidden' }}
      >
        <DataGrid
          rows={rows} 
          columns={columns} 
          loading={loading}
          pageSizeOptions={[10,25,50]} 
          initialState={{ pagination: { paginationModel: { pageSize: 10 } } }}
          disableRowSelectionOnClick 
          autoHeight
          sx={{ 
            border: 'none',
            '& .MuiDataGrid-columnHeaders': { 
              bgcolor: '#F9FAFB',
              borderBottom: '1px solid #E5E7EB',
            },
            '& .MuiDataGrid-columnHeaderTitle': {
              fontWeight: 600,
              fontSize: '0.75rem',
              color: '#374151',
            },
            '& .MuiDataGrid-cell': {
              borderColor: '#F3F4F6',
            },
            '& .MuiDataGrid-row:hover': {
              bgcolor: '#F9FAFB',
            },
          }}
        />
      </Card>

      {/* Add/Edit Dialog */}
      <Dialog open={dialog.open} onClose={closeDialog} maxWidth="md" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          {dialog.mode === 'add' ? 'Add New Student' : `Edit — ${dialog.data.Name}`}
          <IconButton onClick={closeDialog}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid item xs={12} sm={6}><TextField id="form-regno" fullWidth label="Register Number *" value={dialog.data.RegNo} onChange={set('RegNo')} disabled={dialog.mode==='edit'} /></Grid>
            <Grid item xs={12} sm={6}><TextField id="form-name" fullWidth label="Full Name *" value={dialog.data.Name} onChange={set('Name')} /></Grid>
            <Grid item xs={12} sm={6}>
              <FormControl fullWidth>
                <InputLabel>Department *</InputLabel>
                <Select value={dialog.data.Department} label="Department *" id="form-dept" onChange={set('Department')}>
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
    </PageWrapper>
  );
}
