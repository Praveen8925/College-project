import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, Alert, Snackbar,
  CircularProgress, Chip, Table, TableBody, TableCell, TableContainer,
  TableHead, TableRow, Paper, Dialog, DialogTitle, DialogContent,
  DialogActions, Tooltip,
} from '@mui/material';
import { Search, CheckCircle, Lock, LockOpen } from '@mui/icons-material';
import { getFinalizeList, finalizeSubjects } from '../../../api/subjects';
import PageWrapper from '../../../components/common/PageWrapper';

const DEPTS = ['B.Sc(IT)','B.Sc(CS)','BCA','CSE','IT','ECE','EEE','MECH','CIVIL','MBA','MCA'];

export default function FinalizeSubjects() {
  const [rows,      setRows]      = useState([]);
  const [depts,     setDepts]     = useState([]);
  const [batches,   setBatches]   = useState([]);
  const [loading,   setLoading]   = useState(false);
  const [searched,  setSearched]  = useState(false);
  const [filterDept,setFilterDept]= useState('');
  const [filterBatch,setFilterBatch]=useState('');
  const [filterSem, setFilterSem] = useState('');
  const [confirm,   setConfirm]   = useState({ open:false, action:'', batch:'', dept:'', sem:'' });
  const [saving,    setSaving]    = useState(false);
  const [snack,     setSnack]     = useState({ open:false, msg:'', sev:'success' });
  const [error,     setError]     = useState('');

  const load = useCallback(async () => {
    setLoading(true); setError('');
    try {
      const { data } = await getFinalizeList({ dept:filterDept, batch:filterBatch, sem:filterSem });
      if (data.success) {
        setRows(data.data || []);
        setDepts(data.depts || []);
        setBatches(data.batches || []);
        setSearched(true);
      }
    } catch { setError('Failed to load subjects.'); }
    finally { setLoading(false); }
  }, [filterDept, filterBatch, filterSem]);

  useEffect(() => { load(); }, []);

  const handleAction = async () => {
    setSaving(true);
    try {
      const { data } = await finalizeSubjects({
        action:  confirm.action,
        batch:   confirm.batch,
        dept:    confirm.dept,
        sem:     confirm.sem,
      });
      setSnack({ open:true, msg: data.message || 'Done!', sev:'success' });
      setConfirm(c=>({...c, open:false}));
      load();
    } catch(e) {
      setSnack({ open:true, msg: e.response?.data?.message || 'Action failed.', sev:'error' });
    } finally { setSaving(false); }
  };

  // Group rows by Batch+Dept+Sem to show finalize button per group
  const groups = {};
  rows.forEach(r => {
    const key = `${r.Batch}||${r.Programme_Name}||${r.sem}`;
    if (!groups[key]) groups[key] = { Batch:r.Batch, Dept:r.Programme_Name, sem:r.sem, subjects:[], decided: r.decided };
    groups[key].subjects.push(r);
    if (r.decided === 'y') groups[key].decided = 'y';
  });
  const groupList = Object.values(groups);

  return (
    <PageWrapper>
      <Box mb={3}>
        <Typography variant="h4" fontWeight={700}>Finalize Subjects</Typography>
        <Typography variant="body2" color="text.secondary">
          Lock subject lists per batch / department / semester for examinations
        </Typography>
      </Box>

      {/* Filters */}
      <Card sx={{ mb:3 }}>
        <CardContent sx={{ py:1.5 }}>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department</InputLabel>
                <Select value={filterDept} label="Department" onChange={e=>setFilterDept(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {depts.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:6, sm:3, md:2 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Batch</InputLabel>
                <Select value={filterBatch} label="Batch" onChange={e=>setFilterBatch(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {batches.map(b=><MenuItem key={b} value={b}>{b}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:6, sm:3, md:2 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester</InputLabel>
                <Select value={filterSem} label="Semester" onChange={e=>setFilterSem(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {[1,2,3,4,5,6].map(s=><MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid>
              <Button variant="outlined" startIcon={<Search />} onClick={load} disabled={loading}>
                {loading ? <CircularProgress size={18}/> : 'Search'}
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {searched && groupList.length === 0 && !loading && (
        <Alert severity="info">No subjects found for the selected filters.</Alert>
      )}

      <Grid container spacing={2}>
        {groupList.map(g => {
          const isFinalized = g.subjects.every(s => s.decided === 'y');
          return (
            <Grid key={`${g.Batch}-${g.Dept}-${g.sem}`} size={{ xs:12, md:6 }}>
              <Card sx={{ borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)',
                borderTop: `3px solid ${isFinalized ? '#059669' : '#4F46E5'}` }}>
                <CardContent sx={{ pb:'8px !important' }}>
                  <Box display="flex" justifyContent="space-between" alignItems="center" mb={1}>
                    <Box>
                      <Typography variant="subtitle1" fontWeight={700}>{g.Dept}</Typography>
                      <Typography variant="caption" color="text.secondary">Batch {g.Batch} · Semester {g.sem}</Typography>
                    </Box>
                    <Box display="flex" alignItems="center" gap={1}>
                      {isFinalized
                        ? <Chip icon={<Lock fontSize="small"/>} label="Finalized" size="small"
                            sx={{ bgcolor:'#ECFDF5', color:'#059669', fontWeight:700 }} />
                        : <Chip icon={<LockOpen fontSize="small"/>} label="Not Finalized" size="small"
                            sx={{ bgcolor:'#FEF3C7', color:'#D97706', fontWeight:700 }} />
                      }
                    </Box>
                  </Box>

                  <TableContainer sx={{ maxHeight:180, mb:1.5 }}>
                    <Table size="small">
                      <TableHead>
                        <TableRow sx={{ bgcolor:'#F9FAFB' }}>
                          <TableCell sx={{ fontWeight:700, fontSize:'0.72rem', py:0.5 }}>Code</TableCell>
                          <TableCell sx={{ fontWeight:700, fontSize:'0.72rem', py:0.5 }}>Subject</TableCell>
                          <TableCell sx={{ fontWeight:700, fontSize:'0.72rem', py:0.5 }}>Type</TableCell>
                          <TableCell sx={{ fontWeight:700, fontSize:'0.72rem', py:0.5 }}>Credits</TableCell>
                        </TableRow>
                      </TableHead>
                      <TableBody>
                        {g.subjects.map(s=>(
                          <TableRow key={s.CourseID}>
                            <TableCell sx={{ fontSize:'0.75rem', py:0.5, fontWeight:600, color:'#4F46E5' }}>{s.CourseID}</TableCell>
                            <TableCell sx={{ fontSize:'0.75rem', py:0.5 }}>{s.Course_Name}</TableCell>
                            <TableCell sx={{ py:0.5 }}>
                              <Chip label={s.Type} size="small" variant="outlined" sx={{ fontSize:'0.65rem' }} />
                            </TableCell>
                            <TableCell sx={{ fontSize:'0.75rem', py:0.5 }}>{s.Credit}</TableCell>
                          </TableRow>
                        ))}
                      </TableBody>
                    </Table>
                  </TableContainer>

                  <Box display="flex" gap={1} justifyContent="flex-end">
                    {!isFinalized ? (
                      <Button size="small" variant="contained" startIcon={<Lock fontSize="small"/>}
                        sx={{ bgcolor:'#059669', '&:hover':{ bgcolor:'#047857' } }}
                        onClick={()=>setConfirm({ open:true, action:'finalize', batch:g.Batch, dept:g.Dept, sem:g.sem })}>
                        Finalize
                      </Button>
                    ) : (
                      <Button size="small" variant="outlined" startIcon={<LockOpen fontSize="small"/>} color="warning"
                        onClick={()=>setConfirm({ open:true, action:'unfinalize', batch:g.Batch, dept:g.Dept, sem:g.sem })}>
                        Unfinalize
                      </Button>
                    )}
                  </Box>
                </CardContent>
              </Card>
            </Grid>
          );
        })}
      </Grid>

      {/* Confirm dialog */}
      <Dialog open={confirm.open} onClose={()=>setConfirm(c=>({...c,open:false}))} maxWidth="xs" fullWidth>
        <DialogTitle>
          {confirm.action === 'finalize' ? '🔒 Finalize Subjects' : '🔓 Unfinalize Subjects'}
        </DialogTitle>
        <DialogContent>
          <Typography>
            {confirm.action === 'finalize'
              ? <>Lock all subjects for <b>{confirm.dept}</b> Batch <b>{confirm.batch}</b> Sem <b>{confirm.sem}</b>? This will mark them as ready for examination.</>
              : <>Unlock subjects for <b>{confirm.dept}</b> Batch <b>{confirm.batch}</b> Sem <b>{confirm.sem}</b>?</>
            }
          </Typography>
        </DialogContent>
        <DialogActions>
          <Button onClick={()=>setConfirm(c=>({...c,open:false}))}>Cancel</Button>
          <Button variant="contained"
            color={confirm.action==='finalize'?'success':'warning'}
            onClick={handleAction} disabled={saving}>
            {saving ? <CircularProgress size={20}/> : confirm.action==='finalize' ? 'Finalize' : 'Unfinalize'}
          </Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={()=>setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
