import { useEffect, useState, useCallback } from 'react';
import {
  Box, Button, TextField, Select, MenuItem, FormControl, InputLabel,
  Chip, IconButton, Tooltip, Dialog, DialogTitle, DialogContent,
  DialogActions, Grid, Typography, Alert, Snackbar, InputAdornment,
  CircularProgress, Tabs, Tab,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Edit, Delete, Search, Close } from '@mui/icons-material';
import { getStaffList, addStaff, updateStaff, deleteStaff } from '../../../api/staff';

const DESIGNATIONS = ['Professor','Associate Professor','Assistant Professor','Senior Lecturer','Lecturer','Lab Assistant','Office Staff'];
const EMPTY_FORM = { SID:'', Name:'', Department:'', Designation:'', Emailid:'', Password:'',
                     Qualification:'', DOB:'', Address:'', Mobileno:'', DOJ:'', UGExp:0, PGExp:0, Industryexp:0, Domain:'' };

export default function StaffList() {
  const [rows,      setRows]      = useState([]);
  const [depts,     setDepts]     = useState([]);
  const [loading,   setLoading]   = useState(true);
  const [search,    setSearch]    = useState('');
  const [filterDept,setFilterDept]= useState('');
  const [dialog,    setDialog]    = useState({ open:false, mode:'add', data: EMPTY_FORM, tab:0 });
  const [delDialog, setDelDialog] = useState({ open:false, id:'', name:'' });
  const [snack,     setSnack]     = useState({ open:false, msg:'', sev:'success' });
  const [saving,    setSaving]    = useState(false);
  const [error,     setError]     = useState('');

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getStaffList({ search, dept: filterDept });
      if (data.success) {
        setRows(data.data.map(r => ({ ...r, id: r.SID })));
        setDepts(data.depts || []);
      }
    } catch { setError('Failed to load staff.'); }
    finally { setLoading(false); }
  }, [search, filterDept]);

  useEffect(() => { load(); }, [load]);

  const openAdd  = () => setDialog({ open:true, mode:'add', data: EMPTY_FORM, tab:0 });
  const openEdit = (row) => setDialog({ open:true, mode:'edit', data: { ...row }, tab:0 });
  const closeDialog = () => setDialog(d => ({ ...d, open:false }));

  const handleSave = async () => {
    setSaving(true); setError('');
    try {
      if (dialog.mode === 'add') { await addStaff(dialog.data); setSnack({ open:true, msg:'Staff added!', sev:'success' }); }
      else { await updateStaff(dialog.data.SID, dialog.data); setSnack({ open:true, msg:'Staff updated!', sev:'success' }); }
      closeDialog(); load();
    } catch (err) { setError(err.response?.data?.message || 'Save failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async () => {
    try {
      await deleteStaff(delDialog.id);
      setSnack({ open:true, msg:'Staff removed.', sev:'info' });
      setDelDialog({ open:false, id:'', name:'' }); load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  const columns = [
    { field:'SID',         headerName:'Staff ID',     width:110, renderCell: p => <b>{p.value}</b> },
    { field:'Name',        headerName:'Name',         flex:1, minWidth:150 },
    { field:'Department',  headerName:'Department',   width:160 },
    { field:'Designation', headerName:'Designation',  width:180,
      renderCell: p => <Chip label={p.value} size="small" variant="outlined" color="primary" /> },
    { field:'Emailid',     headerName:'Email',        flex:1, minWidth:180 },
    { field:'Mobileno',    headerName:'Mobile',       width:120 },
    {
      field:'actions', headerName:'Actions', width:110, sortable:false,
      renderCell: (p) => (
        <Box>
          <Tooltip title="Edit"><IconButton id={`edit-staff-${p.row.SID}`} size="small" color="primary" onClick={() => openEdit(p.row)}><Edit fontSize="small" /></IconButton></Tooltip>
          <Tooltip title="Delete"><IconButton id={`delete-staff-${p.row.SID}`} size="small" color="error" onClick={() => setDelDialog({ open:true, id:p.row.SID, name:p.row.Name })}><Delete fontSize="small" /></IconButton></Tooltip>
        </Box>
      ),
    },
  ];

  const set = (key) => (e) => setDialog(d => ({ ...d, data: { ...d.data, [key]: e.target.value } }));

  return (
    <Box sx={{ p: 3 }}>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
        <Box>
          <Typography variant="h5" fontWeight={700}>Staff Management</Typography>
          <Typography variant="body2" color="text.secondary">{rows.length} staff member(s) found</Typography>
        </Box>
        <Button id="add-staff-btn" variant="contained" startIcon={<Add />} onClick={openAdd}>Add Staff</Button>
      </Box>

      <Box display="flex" gap={2} mb={2} flexWrap="wrap">
        <TextField id="staff-search" size="small" placeholder="Search by name, SID or email..." value={search}
          onChange={e => setSearch(e.target.value)} sx={{ minWidth:260 }}
          InputProps={{ startAdornment: <InputAdornment position="start"><Search fontSize="small" /></InputAdornment> }} />
        <FormControl size="small" sx={{ minWidth:160 }}>
          <InputLabel>Department</InputLabel>
          <Select value={filterDept} label="Department" id="staff-filter-dept" onChange={e => setFilterDept(e.target.value)}>
            <MenuItem value="">All</MenuItem>
            {depts.map(d => <MenuItem key={d} value={d}>{d}</MenuItem>)}
          </Select>
        </FormControl>
      </Box>

      <Box sx={{ borderRadius: 2, overflow:'hidden', boxShadow:'0 2px 12px rgba(0,0,0,0.07)' }}>
        <DataGrid
          rows={rows} columns={columns} loading={loading}
          pageSizeOptions={[10,25,50]} initialState={{ pagination:{ paginationModel:{ pageSize:10 } } }}
          disableRowSelectionOnClick autoHeight
          sx={{ bgcolor:'white', border:'none', '& .MuiDataGrid-columnHeaders':{ bgcolor:'#F4F6F8', fontWeight:700 } }}
        />
      </Box>

      {/* Add/Edit Dialog with Tabs */}
      <Dialog open={dialog.open} onClose={closeDialog} maxWidth="md" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          {dialog.mode==='add' ? 'Add New Staff' : `Edit — ${dialog.data.Name}`}
          <IconButton onClick={closeDialog}><Close /></IconButton>
        </DialogTitle>
        <Tabs value={dialog.tab} onChange={(_, v) => setDialog(d=>({...d,tab:v}))} sx={{ px:3, borderBottom:1, borderColor:'divider' }}>
          <Tab label="Basic Info" id="tab-basic" />
          <Tab label="Profile Details" id="tab-profile" />
        </Tabs>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}
          {dialog.tab === 0 && (
            <Grid container spacing={2}>
              <Grid item xs={12} sm={6}><TextField id="form-sid" fullWidth label="Staff ID *" value={dialog.data.SID} onChange={set('SID')} disabled={dialog.mode==='edit'} /></Grid>
              <Grid item xs={12} sm={6}><TextField id="form-staff-name" fullWidth label="Full Name *" value={dialog.data.Name} onChange={set('Name')} /></Grid>
              <Grid item xs={12} sm={6}><TextField id="form-staff-dept" fullWidth label="Department *" value={dialog.data.Department} onChange={set('Department')} /></Grid>
              <Grid item xs={12} sm={6}>
                <FormControl fullWidth>
                  <InputLabel>Designation *</InputLabel>
                  <Select value={dialog.data.Designation} label="Designation *" id="form-designation" onChange={set('Designation')}>
                    {DESIGNATIONS.map(d => <MenuItem key={d} value={d}>{d}</MenuItem>)}
                  </Select>
                </FormControl>
              </Grid>
              <Grid item xs={12} sm={6}><TextField id="form-staff-email" fullWidth label="Email ID *" type="email" value={dialog.data.Emailid} onChange={set('Emailid')} /></Grid>
              {dialog.mode==='add' && <Grid item xs={12} sm={6}><TextField id="form-staff-pass" fullWidth label="Password *" type="password" value={dialog.data.Password} onChange={set('Password')} /></Grid>}
            </Grid>
          )}
          {dialog.tab === 1 && (
            <Grid container spacing={2}>
              <Grid item xs={12} sm={6}><TextField id="form-qualification" fullWidth label="Qualification" value={dialog.data.Qualification||''} onChange={set('Qualification')} /></Grid>
              <Grid item xs={12} sm={6}><TextField id="form-domain" fullWidth label="Domain / Specialization" value={dialog.data.Domain||''} onChange={set('Domain')} /></Grid>
              <Grid item xs={12} sm={6}><TextField id="form-staff-dob" fullWidth label="Date of Birth" type="date" InputLabelProps={{ shrink:true }} value={dialog.data.DOB||''} onChange={set('DOB')} /></Grid>
              <Grid item xs={12} sm={6}><TextField id="form-doj" fullWidth label="Date of Joining" type="date" InputLabelProps={{ shrink:true }} value={dialog.data.DOJ||''} onChange={set('DOJ')} /></Grid>
              <Grid item xs={12}><TextField id="form-staff-address" fullWidth label="Address" multiline rows={2} value={dialog.data.Address||''} onChange={set('Address')} /></Grid>
              <Grid item xs={12} sm={6}><TextField id="form-staff-mobile" fullWidth label="Mobile Number" value={dialog.data.Mobileno||''} onChange={set('Mobileno')} /></Grid>
              <Grid item xs={12} sm={2}><TextField id="form-ugexp" fullWidth label="UG Exp (yrs)" type="number" value={dialog.data.UGExp||0} onChange={set('UGExp')} /></Grid>
              <Grid item xs={12} sm={2}><TextField id="form-pgexp" fullWidth label="PG Exp (yrs)" type="number" value={dialog.data.PGExp||0} onChange={set('PGExp')} /></Grid>
              <Grid item xs={12} sm={2}><TextField id="form-indexp" fullWidth label="Industry Exp" type="number" value={dialog.data.Industryexp||0} onChange={set('Industryexp')} /></Grid>
            </Grid>
          )}
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={closeDialog}>Cancel</Button>
          <Button id="save-staff-btn" variant="contained" onClick={handleSave} disabled={saving}>
            {saving ? <CircularProgress size={20} /> : (dialog.mode==='add' ? 'Add Staff' : 'Save Changes')}
          </Button>
        </DialogActions>
      </Dialog>

      <Dialog open={delDialog.open} onClose={() => setDelDialog({ open:false, id:'', name:'' })} maxWidth="xs" fullWidth>
        <DialogTitle>Confirm Delete</DialogTitle>
        <DialogContent><Typography>Remove staff member <b>{delDialog.name}</b>? This cannot be undone.</Typography></DialogContent>
        <DialogActions>
          <Button onClick={() => setDelDialog({ open:false, id:'', name:'' })}>Cancel</Button>
          <Button id="confirm-delete-staff" color="error" variant="contained" onClick={handleDelete}>Delete</Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
