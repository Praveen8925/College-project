import { useState, useRef } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, TextField,
  Select, MenuItem, FormControl, InputLabel, CircularProgress,
  Alert, Chip, Table, TableHead, TableRow, TableCell, TableBody,
  LinearProgress, Divider,
} from '@mui/material';
import { Download, Print, FilterList } from '@mui/icons-material';
import {
  BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip,
  ResponsiveContainer, Cell,
} from 'recharts';
import { getAttendanceReport } from '../../../api/reports';

const BATCHES = [2014, 2015, 2016, 2017, 2018];
const SEMS    = [1, 2, 3, 4, 5, 6];

const STATUS = {
  safe:    { color:'success', label:'Safe (≥75%)',    bg:'#E8F5E9', text:'#2E7D32' },
  warning: { color:'warning', label:'Warning (60-74%)', bg:'#FFF8E1', text:'#F57F17' },
  risk:    { color:'error',   label:'At Risk (<60%)', bg:'#FFEBEE', text:'#C62828' },
};
const rowStatus = pct => pct >= 75 ? 'safe' : pct >= 60 ? 'warning' : 'risk';

// Export CSV
function exportCSV(rows, batch, sem) {
  const hdr = ['RegNo','Name','Department','Sem','Working Days','Present','%'];
  const lines = rows.map(r =>
    [r.RegNo, r.Name, r.Department, r.sem, r.total_days, r.present_days, r.pct].join(',')
  );
  const csv  = [hdr.join(','), ...lines].join('\n');
  const blob = new Blob([csv], {type:'text/csv'});
  const url  = URL.createObjectURL(blob);
  const a    = Object.assign(document.createElement('a'), { href:url, download:`attendance_${batch}_sem${sem}.csv` });
  a.click(); URL.revokeObjectURL(url);
}

export default function AttendanceReport() {
  const [batch,   setBatch]   = useState('');
  const [sem,     setSem]     = useState('');
  const [filter,  setFilter]  = useState('all');
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(false);
  const [error,   setError]   = useState('');
  const printRef = useRef();

  const load = async () => {
    if (!batch) { setError('Please select a batch year.'); return; }
    setLoading(true); setError(''); setData(null);
    try {
      const { data: d } = await getAttendanceReport({ batch, sem });
      if (d.success) setData(d);
      else setError(d.message || 'No data found.');
    } catch { setError('Server error.'); }
    finally { setLoading(false); }
  };

  const filtered = (data?.students || []).filter(r => {
    if (filter === 'all') return true;
    const s = rowStatus(r.pct);
    return s === filter;
  });

  const chartData = (data?.students || []).map(r => ({
    name: r.RegNo.slice(-4), pct: r.pct,
    fill: r.pct>=75?'#2E7D32':r.pct>=60?'#F57F17':'#C62828'
  })).slice(0,40);

  const handlePrint = () => {
    const content = printRef.current?.innerHTML;
    const w = window.open('', '_blank');
    w.document.write(`<html><head><title>Attendance Report - Batch ${batch}</title>
      <style>body{font-family:Arial,sans-serif;font-size:12px;}
      table{width:100%;border-collapse:collapse;} th,td{border:1px solid #ccc;padding:6px;text-align:left;}
      th{background:#1A237E;color:white;} .safe{color:#2E7D32;} .warning{color:#F57F17;} .risk{color:#C62828;}
      h2{color:#1A237E;} @media print{button{display:none;}}</style></head>
      <body><h2>Attendance Report — Batch ${batch} ${sem?`Semester ${sem}`:''}</h2>${content}<br/>
      <p style="font-size:10px;color:#888;">Generated: ${new Date().toLocaleString()}</p></body></html>`);
    w.document.close(); w.print();
  };

  return (
    <Box sx={{ p:3 }}>
      <Typography variant="h5" fontWeight={700} mb={0.5}>Attendance Report</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>Student-wise attendance for any batch/semester</Typography>

      {/* Filter controls */}
      <Card sx={{ mb:3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="center">
            <Grid item xs={12} sm={3}>
              <FormControl fullWidth size="small">
                <InputLabel>Batch Year *</InputLabel>
                <Select id="att-batch" value={batch} label="Batch Year *" onChange={e=>setBatch(e.target.value)}>
                  {BATCHES.map(b=><MenuItem key={b} value={b}>{b}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={3}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester</InputLabel>
                <Select id="att-sem" value={sem} label="Semester" onChange={e=>setSem(e.target.value)}>
                  <MenuItem value="">All Semesters</MenuItem>
                  {SEMS.map(s=><MenuItem key={s} value={s}>Semester {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={3}>
              <FormControl fullWidth size="small">
                <InputLabel>Filter</InputLabel>
                <Select id="att-filter" value={filter} label="Filter" onChange={e=>setFilter(e.target.value)}>
                  <MenuItem value="all">All Students</MenuItem>
                  <MenuItem value="safe">Safe (≥75%)</MenuItem>
                  <MenuItem value="warning">Warning (60-74%)</MenuItem>
                  <MenuItem value="risk">At Risk (&lt;60%)</MenuItem>
                </Select>
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={3}>
              <Button id="load-att-report" fullWidth variant="contained" onClick={load} disabled={loading}
                startIcon={loading?<CircularProgress size={16}/>: <FilterList/>}>
                {loading ? 'Loading…' : 'Generate Report'}
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="warning" sx={{mb:2}}>{error}</Alert>}

      {data && (
        <>
          {/* Summary bar */}
          <Grid container spacing={2} mb={3}>
            {[
              {label:'Total Students', value:data.summary.total,   color:'#1A237E'},
              {label:'Safe (≥75%)',    value:data.summary.safe,    color:'#2E7D32'},
              {label:'Warning',        value:data.summary.warning,  color:'#F57F17'},
              {label:'At Risk (<60%)', value:data.summary.risk,    color:'#C62828'},
              {label:'Avg Attendance', value:`${data.summary.avg_pct}%`, color:'#4A148C'},
            ].map(s=>(
              <Grid item xs={6} sm key={s.label}>
                <Card sx={{textAlign:'center'}}>
                  <CardContent sx={{py:'12px !important'}}>
                    <Typography variant="h4" fontWeight={800} color={s.color}>{s.value}</Typography>
                    <Typography variant="caption" color="text.secondary">{s.label}</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>

          {/* Chart */}
          {chartData.length > 0 && (
            <Card sx={{mb:3}}>
              <CardContent>
                <Typography variant="h6" fontWeight={600} mb={2}>
                  Attendance % (first {chartData.length} students, color-coded)
                </Typography>
                <ResponsiveContainer width="100%" height={180}>
                  <BarChart data={chartData} margin={{top:0,right:10,left:-20,bottom:0}}>
                    <CartesianGrid strokeDasharray="3 3" stroke="#F0F0F0"/>
                    <XAxis dataKey="name" tick={{fontSize:9}} interval={Math.floor(chartData.length/20)}/>
                    <YAxis tick={{fontSize:11}} domain={[0,100]}/>
                    <Tooltip formatter={v=>[`${v}%`,'Attendance']}/>
                    <Bar dataKey="pct" radius={[2,2,0,0]}>
                      {chartData.map((c,i)=><Cell key={i} fill={c.fill}/>)}
                    </Bar>
                  </BarChart>
                </ResponsiveContainer>
              </CardContent>
            </Card>
          )}

          {/* Action buttons */}
          <Box display="flex" gap={2} mb={2} justifyContent="flex-end">
            <Button id="export-att-csv" startIcon={<Download/>} variant="outlined"
              onClick={()=>exportCSV(data.students, batch, sem)}>Export CSV</Button>
            <Button id="print-att-report" startIcon={<Print/>} variant="outlined"
              onClick={handlePrint}>Print Report</Button>
          </Box>

          {/* Table */}
          <Card>
            <CardContent sx={{p:0}}>
              <div ref={printRef}>
                <Table size="small" stickyHeader>
                  <TableHead>
                    <TableRow>
                      {['#','RegNo','Name','Dept','Sem','Working Days','Present','Absent','%','Status'].map(h=>(
                        <TableCell key={h} sx={{fontWeight:700,bgcolor:'#1A237E',color:'white',fontSize:'0.75rem'}}>{h}</TableCell>
                      ))}
                    </TableRow>
                  </TableHead>
                  <TableBody>
                    {filtered.map((r, i) => {
                      const s = rowStatus(r.pct);
                      const info = STATUS[s];
                      return (
                        <TableRow key={r.RegNo} sx={{'&:hover':{bgcolor:'#F8F9FF'}, bgcolor: i%2?'#FAFAFA':'white'}}>
                          <TableCell sx={{fontSize:'0.75rem',color:'#888'}}>{i+1}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem',fontWeight:600}}>{r.RegNo}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem'}}>{r.Name}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem'}}>{r.Department}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem',textAlign:'center'}}>{r.sem || '—'}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem',textAlign:'center'}}>{r.total_days}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem',textAlign:'center',color:'#2E7D32',fontWeight:700}}>{r.present_days}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem',textAlign:'center',color:'#C62828'}}>{Math.max(0,r.total_days-r.present_days)}</TableCell>
                          <TableCell sx={{fontSize:'0.75rem',textAlign:'center'}}>
                            <Box>
                              <Typography fontSize="0.75rem" fontWeight={800} color={info.text}>{r.pct}%</Typography>
                              <LinearProgress variant="determinate" value={r.pct}
                                color={s==='safe'?'success':s==='warning'?'warning':'error'}
                                sx={{height:4,borderRadius:2,mt:0.3}}/>
                            </Box>
                          </TableCell>
                          <TableCell>
                            <Chip label={info.label} size="small" color={info.color}
                              sx={{fontSize:'0.6rem',height:18}}/>
                          </TableCell>
                        </TableRow>
                      );
                    })}
                  </TableBody>
                </Table>
                {filtered.length === 0 && (
                  <Typography textAlign="center" py={4} color="text.secondary">No students match the selected filter.</Typography>
                )}
              </div>
            </CardContent>
          </Card>
          <Typography variant="caption" color="text.secondary" display="block" mt={1} textAlign="right">
            Showing {filtered.length} of {data.students.length} students · Source: {data.table}
          </Typography>
        </>
      )}
    </Box>
  );
}
