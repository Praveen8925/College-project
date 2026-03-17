import { useEffect, useState, useCallback } from 'react';
import {
  Box, Button, TextField, Select, MenuItem, FormControl, InputLabel,
  IconButton, Tooltip, Dialog, DialogTitle, DialogContent, DialogActions,
  Grid, Typography, Alert, Snackbar, InputAdornment, Chip, CircularProgress,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { Add, Delete, Search, Close } from '@mui/icons-material';
import { getSubjects, addSubject, deleteSubject } from '../../../api/subjects';

const TYPES = ['Theory','Practical','Elective','Skill-Based'];
const SEMS  = [1,2,3,4,5,6];
const EMPTY = { SubjectCode:'', SubjectName:'', Department:'', Batch:'', sem:'', NoOfHours:5, Type:'Theory' };

export default function SubjectList() {
  const [rows,      setRows]      = useState([]);
  const [depts,     setDepts]     = useState([]);
  const [batches,   setBatches]   = useState([]);
  const [loading,   setLoading]   = useState(true);
  const [filterDept,setFilterDept]= useState('');
  const [filterBatch,setFilterBatch]=useState('');
  const [dialog,    setDialog]    = useState({ open:false, data: EMPTY });
  const [delId,     setDelId]     = useState(null);
  const [saving,    setSaving]    = useState(false);
  const [error,     setError]     = useState('');
  const [snack,     setSnack]     = useState({ open:false, msg:'', sev:'success' });

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getSubjects({ dept: filterDept, batch: filterBatch });
      if (data.success) {
        setRows(data.data.map(r => ({ ...r, id: r.SubjectCode })));
        setDepts(data.depts || []); setBatches(data.batches || []);
      }
    } catch {} finally { setLoading(false); }
  }, [filterDept, filterBatch]);

  useEffect(() => { load(); }, [load]);

  const handleSave = async () => {
    setSaving(true); setError('');
    try {
      await addSubject(dialog.data);
      setSnack({ open:true, msg:'Subject added!', sev:'success' });
      setDialog(d=>({...d,open:false})); load();
    } catch (err) { setError(err.response?.data?.message || 'Save failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async () => {
    try {
      await deleteSubject(delId);
      setSnack({ open:true, msg:'Subject removed.', sev:'info' });
      setDelId(null); load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  const set = (key) => (e) => setDialog(d => ({ ...d, data: { ...d.data, [key]: e.target.value } }));

  const columns = [
    { field:'SubjectCode', headerName:'Code',        width:130, renderCell:p=><b>{p.value}</b> },
    { field:'SubjectName', headerName:'Subject Name', flex:1, minWidth:200 },
    { field:'Department',  headerName:'Department',   width:160 },
    { field:'Batch',       headerName:'Batch',        width:80  },
    { field:'sem',         headerName:'Sem',          width:70, renderCell:p=><Chip label={p.value} size="small" variant="outlined" /> },
    { field:'NoOfHours',   headerName:'Hours/Week',   width:110 },
    { field:'Type',        headerName:'Type',         width:110, renderCell:p=><Chip label={p.value} size="small" color={p.value==='Practical'?'secondary':'primary'} variant="outlined"/> },
    {
      field:'actions', headerName:'Actions', width:90, sortable:false,
      renderCell:(p)=>(<Tooltip title="Delete"><IconButton id={`del-sub-${p.row.SubjectCode}`} size="small" color="error" onClick={()=>setDelId(p.row.SubjectCode)}><Delete fontSize="small"/></IconButton></Tooltip>),
    },
  ];

  return (
    <Box sx={{ p:3 }}>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
        <Box>
          <Typography variant="h5" fontWeight={700}>Subject Management</Typography>
          <Typography variant="body2" color="text.secondary">{rows.length} subject(s)</Typography>
        </Box>
        <Button id="add-subject-btn" variant="contained" startIcon={<Add />} onClick={()=>setDialog({ open:true, data:EMPTY })}>Add Subject</Button>
      </Box>

      <Box display="flex" gap={2} mb={2} flexWrap="wrap">
        <FormControl size="small" sx={{ minWidth:160 }}>
          <InputLabel>Department</InputLabel>
          <Select value={filterDept} label="Department" id="sub-filter-dept" onChange={e=>setFilterDept(e.target.value)}>
            <MenuItem value="">All</MenuItem>
            {depts.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
          </Select>
        </FormControl>
        <FormControl size="small" sx={{ minWidth:100 }}>
          <InputLabel>Batch</InputLabel>
          <Select value={filterBatch} label="Batch" id="sub-filter-batch" onChange={e=>setFilterBatch(e.target.value)}>
            <MenuItem value="">All</MenuItem>
            {batches.map(b=><MenuItem key={b} value={b}>{b}</MenuItem>)}
          </Select>
        </FormControl>
      </Box>

      <Box sx={{ borderRadius:2, overflow:'hidden', boxShadow:'0 2px 12px rgba(0,0,0,0.07)' }}>
        <DataGrid rows={rows} columns={columns} loading={loading} pageSizeOptions={[10,25,50]}
          initialState={{ pagination:{ paginationModel:{ pageSize:10 } } }}
          disableRowSelectionOnClick autoHeight
          sx={{ bgcolor:'white', border:'none','& .MuiDataGrid-columnHeaders':{ bgcolor:'#F4F6F8', fontWeight:700 } }} />
      </Box>

      <Dialog open={dialog.open} onClose={()=>setDialog(d=>({...d,open:false}))} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          Add New Subject <IconButton onClick={()=>setDialog(d=>({...d,open:false}))}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          {error && <Alert severity="error" sx={{mb:2}}>{error}</Alert>}
          <Grid container spacing={2}>
            <Grid item xs={6}><TextField id="sub-code" fullWidth label="Subject Code *" value={dialog.data.SubjectCode} onChange={set('SubjectCode')} /></Grid>
            <Grid item xs={6}><TextField id="sub-name" fullWidth label="Subject Name *" value={dialog.data.SubjectName} onChange={set('SubjectName')} /></Grid>
            <Grid item xs={6}><TextField id="sub-dept" fullWidth label="Department *" value={dialog.data.Department} onChange={set('Department')} /></Grid>
            <Grid item xs={3}><TextField id="sub-batch" fullWidth label="Batch" type="number" value={dialog.data.Batch} onChange={set('Batch')} /></Grid>
            <Grid item xs={3}>
              <FormControl fullWidth><InputLabel>Sem *</InputLabel>
                <Select value={dialog.data.sem} label="Sem *" id="sub-sem" onChange={set('sem')}>
                  {SEMS.map(s=><MenuItem key={s} value={s}>{s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={6}>
              <FormControl fullWidth><InputLabel>Type</InputLabel>
                <Select value={dialog.data.Type} label="Type" id="sub-type" onChange={set('Type')}>
                  {TYPES.map(t=><MenuItem key={t} value={t}>{t}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={6}><TextField id="sub-hours" fullWidth label="Hours/Week" type="number" value={dialog.data.NoOfHours} onChange={set('NoOfHours')} /></Grid>
          </Grid>
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={()=>setDialog(d=>({...d,open:false}))}>Cancel</Button>
          <Button id="save-subject-btn" variant="contained" onClick={handleSave} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : 'Add Subject'}
          </Button>
        </DialogActions>
      </Dialog>

      <Dialog open={!!delId} onClose={()=>setDelId(null)} maxWidth="xs" fullWidth>
        <DialogTitle>Delete Subject</DialogTitle>
        <DialogContent><Typography>Remove subject <b>{delId}</b>?</Typography></DialogContent>
        <DialogActions>
          <Button onClick={()=>setDelId(null)}>Cancel</Button>
          <Button id="confirm-delete-subject" color="error" variant="contained" onClick={handleDelete}>Delete</Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={()=>setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{width:'100%'}}>{snack.msg}</Alert>
      </Snackbar>
    </Box>
  );
}
