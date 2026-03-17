import { useEffect, useState, useCallback } from 'react';
import {
  Box, Button, Typography, Chip, IconButton, Tooltip, Dialog,
  DialogTitle, DialogContent, DialogActions, TextField, Select,
  MenuItem, FormControl, InputLabel, Alert, Snackbar, CircularProgress,
} from '@mui/material';
import { DataGrid } from '@mui/x-data-grid';
import { CheckCircle, FilterList, Refresh } from '@mui/icons-material';
import { getComplaints, resolveComplaint } from '../../../api/complaints';
import PageWrapper from '../../../components/common/PageWrapper';
import StatusBadge from '../../../components/common/StatusBadge';

export default function ComplaintManager() {
  const [rows,    setRows]    = useState([]);
  const [loading, setLoading] = useState(true);
  const [filter,  setFilter]  = useState('');
  const [resolve, setResolve] = useState({ open:false, id:'', desc:'' });
  const [saving,  setSaving]  = useState(false);
  const [snack,   setSnack]   = useState({ open:false, msg:'', sev:'success' });

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const { data } = await getComplaints({ status: filter });
      if (data.success) setRows(data.data.map(r => ({ ...r, id: r.Complaint_ID })));
    } catch {}
    finally { setLoading(false); }
  }, [filter]);

  useEffect(() => { load(); }, [load]);

  const handleResolve = async () => {
    setSaving(true);
    try {
      await resolveComplaint({ Complaint_ID: resolve.id, solved_description: resolve.desc || 'Resolved by admin.' });
      setSnack({ open:true, msg:'Complaint resolved!', sev:'success' });
      setResolve({ open:false, id:'', desc:'' }); load();
    } catch { setSnack({ open:true, msg:'Failed.', sev:'error' }); }
    finally { setSaving(false); }
  };

  const columns = [
    { field:'Complaint_ID', headerName:'ID',          width:120, renderCell: p => <b>{p.value}</b> },
    { field:'Date',        headerName:'Date',          width:110 },
    { field:'Department',  headerName:'Department',    width:130 },
    { field:'Type',        headerName:'Type',          width:100, renderCell: p => <Chip label={p.value} size="small" variant="outlined" /> },
    { field:'Description', headerName:'Description',   flex:1, minWidth:200 },
    { field:'Complaint_To',headerName:'Raised To',     width:160 },
    {
      field:'Status', headerName:'Status', width:110,
      renderCell: p => <StatusBadge status={p.value} />
    },
    {
      field:'actions', headerName:'Action', width:110, sortable:false,
      renderCell: (p) => p.row.Status !== 'Resolved' ? (
        <Tooltip title="Mark Resolved">
          <IconButton id={`resolve-${p.row.Complaint_ID}`} size="small" color="success"
            onClick={() => setResolve({ open:true, id:p.row.Complaint_ID, desc:'' })}>
            <CheckCircle />
          </IconButton>
        </Tooltip>
      ) : null,
    },
  ];

  return (
    <PageWrapper>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={2}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Complaints Manager</Typography>
          <Typography variant="body2" color="text.secondary">{rows.length} complaint(s) found</Typography>
        </Box>
        <Box display="flex" gap={1}>
          <FormControl size="small" sx={{ minWidth:140 }}>
            <InputLabel>Filter Status</InputLabel>
            <Select value={filter} label="Filter Status" id="complaints-status-filter" onChange={e => setFilter(e.target.value)}>
              <MenuItem value="">All</MenuItem>
              <MenuItem value="Pending">Pending</MenuItem>
              <MenuItem value="Resolved">Resolved</MenuItem>
            </Select>
          </FormControl>
          <Tooltip title="Refresh"><IconButton id="complaints-refresh-btn" onClick={load}><Refresh /></IconButton></Tooltip>
        </Box>
      </Box>

      <Box sx={{ borderRadius:2, overflow:'hidden', boxShadow:'0 1px 3px rgba(0,0,0,0.08)' }}>
        <DataGrid
          rows={rows} columns={columns} loading={loading}
          pageSizeOptions={[10,25,50]} initialState={{ pagination:{ paginationModel:{ pageSize:10 } } }}
          disableRowSelectionOnClick autoHeight
          sx={{ bgcolor:'white', border:'none', '& .MuiDataGrid-columnHeaders':{ bgcolor:'#F9FAFB', fontWeight:700 } }}
        />
      </Box>

      {/* Resolve Dialog */}
      <Dialog open={resolve.open} onClose={() => setResolve({ open:false, id:'', desc:'' })} maxWidth="sm" fullWidth>
        <DialogTitle>Resolve Complaint — {resolve.id}</DialogTitle>
        <DialogContent dividers>
          <TextField id="resolve-desc-field" fullWidth multiline rows={3} label="Resolution Description"
            value={resolve.desc} onChange={e => setResolve(r => ({ ...r, desc: e.target.value }))}
            placeholder="Describe how this complaint was resolved..." />
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={() => setResolve({ open:false, id:'', desc:'' })}>Cancel</Button>
          <Button id="confirm-resolve-btn" variant="contained" color="success" onClick={handleResolve} disabled={saving}>
            {saving ? <CircularProgress size={20} /> : 'Mark as Resolved'}
          </Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
