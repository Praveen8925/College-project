import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, Alert, CircularProgress,
  Chip, Divider, Table, TableBody, TableCell, TableContainer,
  TableHead, TableRow, Paper,
} from '@mui/material';
import { Print, Search, PeopleAlt, FileDownload } from '@mui/icons-material';
import { getStaffReport } from '../../../api/reports';
import { exportToExcel } from '../../../utils/exportExcel';
import PageWrapper from '../../../components/common/PageWrapper';

export default function StaffReport() {
  const [rows,       setRows]       = useState([]);
  const [deptSummary,setDeptSummary]= useState([]);
  const [depts,      setDepts]      = useState([]);
  const [loading,    setLoading]    = useState(false);
  const [search,     setSearch]     = useState('');
  const [filterDept, setFilterDept] = useState('');
  const [error,      setError]      = useState('');

  const load = useCallback(async () => {
    setLoading(true); setError('');
    try {
      const { data } = await getStaffReport({ search, dept: filterDept });
      if (data.success) {
        setRows(data.data || []);
        setDeptSummary(data.deptSummary || []);
        setDepts(data.depts || []);
      }
    } catch { setError('Failed to load staff report.'); }
    finally { setLoading(false); }
  }, [search, filterDept]);

  useEffect(() => { load(); }, []);

  const handlePrint = () => window.print();
  const handleExport = () => {
    if (rows.length === 0) return;
    exportToExcel(rows, 'Staff_Report', 'Staff Data', 
      ['SID','Name','Department','Designation','Qualification','DOJ','UGExp','PGExp','Mobileno','subjects_allocated','diary_entries'],
      { SID:'Staff ID', Name:'Staff Name', Department:'Department', Designation:'Designation', 
        Qualification:'Qualification', DOJ:'Date of Joining', UGExp:'UG Experience (Yrs)',
        PGExp:'PG Experience (Yrs)', Mobileno:'Mobile No', subjects_allocated:'Subjects Allocated',
        diary_entries:'Diary Entries' }
    );
  };

  return (
    <PageWrapper>
      {/* Header */}
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Staff Report</Typography>
          <Typography variant="body2" color="text.secondary">Comprehensive staff overview by department</Typography>
        </Box>
        <Box display="flex" gap={1}>
          <Button variant="outlined" startIcon={<Print />} onClick={handlePrint} className="no-print">
            Print Report
          </Button>
          <Button variant="contained" startIcon={<FileDownload />} onClick={handleExport} className="no-print">
            Export Excel
          </Button>
        </Box>
      </Box>

      {/* Dept summary cards */}
      <Grid container spacing={2} mb={3}>
        {deptSummary.map(d=>(
          <Grid key={d.Department} size={{ xs:6, sm:4, md:3, lg:2 }}>
            <Card sx={{ textAlign:'center', borderTop:'3px solid #4F46E5', borderRadius:2 }}>
              <CardContent sx={{ py:1.5, px:1 }}>
                <Typography variant="h5" fontWeight={700} color="primary">{d.count}</Typography>
                <Typography variant="caption" color="text.secondary">{d.Department}</Typography>
              </CardContent>
            </Card>
          </Grid>
        ))}
      </Grid>

      {/* Filters */}
      <Card sx={{ mb:2 }} className="no-print">
        <CardContent sx={{ py:1.5 }}>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:12, sm:5 }}>
              <TextField fullWidth size="small" label="Search name / ID" value={search}
                onChange={e=>setSearch(e.target.value)}
                onKeyDown={e=>e.key==='Enter' && load()} />
            </Grid>
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department</InputLabel>
                <Select value={filterDept} label="Department" onChange={e=>setFilterDept(e.target.value)}>
                  <MenuItem value="">All</MenuItem>
                  {depts.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid>
              <Button variant="contained" startIcon={<Search />} onClick={load}>Search</Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {/* Print header */}
      <Box display="none" className="print-header" sx={{ mb:2, textAlign:'center' }}>
        <Typography variant="h5" fontWeight={700}>Staff Report</Typography>
        <Typography variant="body2">Generated on {new Date().toLocaleDateString('en-IN')}</Typography>
      </Box>

      <TableContainer component={Paper} sx={{ borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)' }}>
        <Table size="small">
          <TableHead>
            <TableRow sx={{ bgcolor:'#F9FAFB' }}>
              {['SID','Name','Department','Designation','Qualification','DOJ','Experience (UG+PG)','Mobile','Subjects Allotted','Diary Entries'].map(h=>(
                <TableCell key={h} sx={{ fontWeight:700, fontSize:'0.75rem', py:1.5 }}>{h}</TableCell>
              ))}
            </TableRow>
          </TableHead>
          <TableBody>
            {loading ? (
              <TableRow><TableCell colSpan={10} align="center" sx={{ py:4 }}><CircularProgress size={28}/></TableCell></TableRow>
            ) : rows.length === 0 ? (
              <TableRow><TableCell colSpan={10} align="center" sx={{ py:4, color:'text.secondary' }}>No staff records found.</TableCell></TableRow>
            ) : rows.map((r,i)=>(
              <TableRow key={r.SID} sx={{ '&:hover':{ bgcolor:'#F5F3FF' }, bgcolor: i%2===0?'white':'#FAFAFA' }}>
                <TableCell sx={{ fontWeight:600, color:'#4F46E5' }}>{r.SID}</TableCell>
                <TableCell sx={{ fontWeight:500 }}>{r.Name}</TableCell>
                <TableCell><Chip label={r.Department} size="small" sx={{ bgcolor:'#EEF2FF', color:'#4F46E5' }} /></TableCell>
                <TableCell>{r.Designation || '—'}</TableCell>
                <TableCell>{r.Qualification || '—'}</TableCell>
                <TableCell>{r.DOJ ? new Date(r.DOJ).toLocaleDateString('en-IN') : '—'}</TableCell>
                <TableCell>{[r.UGExp, r.PGExp].filter(Boolean).join(' / ') || '—'} yrs</TableCell>
                <TableCell>{r.Mobileno || '—'}</TableCell>
                <TableCell align="center">{r.subjects_allocated ?? 0}</TableCell>
                <TableCell align="center">{r.diary_entries ?? 0}</TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>

      <Box mt={1} display="flex" justifyContent="flex-end">
        <Typography variant="caption" color="text.secondary">Total: {rows.length} staff members</Typography>
      </Box>

      <style>{`
        @media print {
          .no-print { display:none !important; }
          .print-header { display:block !important; }
        }
      `}</style>
    </PageWrapper>
  );
}
