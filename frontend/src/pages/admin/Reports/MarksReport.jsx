import { useState, useRef } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button, Select,
  MenuItem, FormControl, InputLabel, CircularProgress, Alert, Chip,
  Table, TableHead, TableRow, TableCell, TableBody, LinearProgress,
} from '@mui/material';
import { Download, Print, FilterList, FileDownload } from '@mui/icons-material';
import {
  BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip,
  ResponsiveContainer, Cell, PieChart, Pie, Legend,
} from 'recharts';
import { getMarksReport } from '../../../api/reports';
import { exportToExcel } from '../../../utils/exportExcel';
import PageWrapper from '../../../components/common/PageWrapper';

const BATCHES = [2014, 2015, 2016, 2017, 2018];
const SEMS    = [1, 2, 3, 4, 5, 6];
const GRADE_COLOR = {S:'#4F46E5',A:'#059669',B:'#0891B2',C:'#D97706',D:'#EA580C',F:'#DC2626','—':'#9CA3AF'};
const GRADE_COLORS_ARR = ['#4F46E5','#059669','#0891B2','#D97706','#EA580C','#DC2626'];

function exportCSV(rows, batch, sem) {
  const hdr  = ['RegNo','Name','Dept','CT1(/25)','CT2(/25)','Model(/50)','Assign(/25)','Total(/125)','%','Grade'];
  const lines = rows.map(r =>
    [r.RegNo,r.Name,r.Department,r.CT1??'—',r.CT2??'—',r.Model??'—',r.Assignment??'—',r.Total,r.Pct,r.Grade].join(',')
  );
  const csv  = [hdr.join(','),...lines].join('\n');
  const blob = new Blob([csv],{type:'text/csv'});
  const url  = URL.createObjectURL(blob);
  const a    = Object.assign(document.createElement('a'),{href:url,download:`marks_${batch}_sem${sem||'all'}.csv`});
  a.click(); URL.revokeObjectURL(url);
}

export default function MarksReport() {
  const [batch,   setBatch]   = useState('');
  const [sem,     setSem]     = useState('');
  const [data,    setData]    = useState(null);
  const [loading, setLoading] = useState(false);
  const [error,   setError]   = useState('');
  const printRef = useRef();

  const load = async () => {
    if (!batch) { setError('Please select a batch year.'); return; }
    setLoading(true); setError(''); setData(null);
    try {
      const { data: d } = await getMarksReport({ batch, sem });
      if (d.success) setData(d);
      else setError(d.message || 'No data found.');
    } catch { setError('Server error.'); }
    finally { setLoading(false); }
  };

  const handlePrint = () => {
    const content = printRef.current?.innerHTML;
    const w = window.open('','_blank');
    w.document.write(`<html><head><title>Marks Report - Batch ${batch}</title>
      <style>body{font-family:Arial;font-size:11px;}
      table{width:100%;border-collapse:collapse;} th,td{border:1px solid #ccc;padding:5px;text-align:left;}
      th{background:#4F46E5;color:white;} h2{color:#4F46E5;}
      @media print{button{display:none;}}</style></head>
      <body><h2>Internal Marks Report — Batch ${batch} ${sem?`Sem ${sem}`:''}</h2>
      ${content}<p style="font-size:10px;color:#888;">Generated: ${new Date().toLocaleString()}</p>
      </body></html>`);
    w.document.close(); w.print();
  };

  const handleExport = () => {
    if (!data?.students?.length) return;
    const flatData = data.students.map(s => ({
      RegNo: s.RegNo, Name: s.Name, Department: s.Department, Batch: s.Batch,
      CT1_avg: s.CT1_avg, CT2_avg: s.CT2_avg, Model_avg: s.Model_avg,
      Overall_avg: s.Overall_avg, Grade: s.Grade
    }));
    exportToExcel(flatData, 'Marks_Report', 'Internal Marks',
      ['RegNo','Name','Department','Batch','CT1_avg','CT2_avg','Model_avg','Overall_avg','Grade'],
      { RegNo:'Register No', Name:'Student Name', Department:'Department', Batch:'Batch',
        CT1_avg:'CT1 Average', CT2_avg:'CT2 Average', Model_avg:'Model Average',
        Overall_avg:'Overall Average', Grade:'Grade' }
    );
  };

  const gradeData = data ? ['S','A','B','C','D','F'].map((g,i)=>({
    grade:g, count:data.summary[g]||0, fill:GRADE_COLORS_ARR[i]
  })).filter(x=>x.count>0) : [];

  const pctChartData = (data?.students||[])
    .filter(s=>s.CT1!==null||s.CT2!==null||s.Model!==null)
    .map(s=>({name:s.RegNo.slice(-4), pct:s.Pct, fill:GRADE_COLOR[s.Grade]}))
    .slice(0,40);

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>Consolidated Marks Report</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>CT1 + CT2 + Model + Assignment marks for any batch</Typography>

      {/* Controls */}
      <Card sx={{ mb:3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs: 12, sm: 4 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Batch Year *</InputLabel>
                <Select id="marks-batch" value={batch} label="Batch Year *" onChange={e=>setBatch(e.target.value)}>
                  {BATCHES.map(b=><MenuItem key={b} value={b}>{b}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 12, sm: 4 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Semester</InputLabel>
                <Select id="marks-sem" value={sem} label="Semester" onChange={e=>setSem(e.target.value)}>
                  <MenuItem value="">All Semesters</MenuItem>
                  {SEMS.map(s=><MenuItem key={s} value={s}>Semester {s}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs: 12, sm: 4 }}>
              <Button id="load-marks-report" fullWidth variant="contained" onClick={load} disabled={loading}
                startIcon={loading?<CircularProgress size={16}/>:<FilterList/>}>
                {loading ? 'Loading…' : 'Generate Report'}
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="warning" sx={{mb:2, borderRadius: 2}}>{error}</Alert>}

      {data && (
        <>
          {/* Summary stat cards */}
          <Grid container spacing={2} mb={3}>
            {[
              {label:'Total Students', value:data.summary.total,         color:'#4F46E5'},
              {label:'Marks Entered',  value:data.summary.entered,       color:'#059669'},
              {label:'Avg %',          value:`${data.summary.avg_pct}%`, color:'#0891B2'},
              ...['S','A','B','C','D','F'].map((g,i)=>({
                label:`Grade ${g}`, value:data.summary[g]||0, color:GRADE_COLORS_ARR[i]
              })),
            ].map(s=>(
              <Grid size={{ xs: 6, sm: 3, md: 1.5 }} key={s.label}>
                <Card sx={{textAlign:'center', borderTop: `3px solid ${s.color}`}}>
                  <CardContent sx={{py:'12px !important'}}>
                    <Typography variant="h4" fontWeight={800} color={s.color}>{s.value}</Typography>
                    <Typography variant="caption" color="text.secondary">{s.label}</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>

          {/* Charts */}
          <Grid container spacing={3} mb={3}>
            <Grid size={{ xs: 12, md: 4 }}>
              <Card>
                <CardContent>
                  <Typography variant="h6" fontWeight={600} mb={2}>Grade Distribution</Typography>
                  <ResponsiveContainer width="100%" height={200}>
                    <PieChart>
                      <Pie data={gradeData} dataKey="count" nameKey="grade" cx="50%" cy="50%"
                        outerRadius={80} label={({grade,count})=>`${grade}:${count}`} fontSize={12}>
                        {gradeData.map((d,i)=><Cell key={i} fill={d.fill}/>)}
                      </Pie>
                      <Tooltip />
                    </PieChart>
                  </ResponsiveContainer>
                </CardContent>
              </Card>
            </Grid>
            <Grid size={{ xs: 12, md: 8 }}>
              <Card>
                <CardContent>
                  <Typography variant="h6" fontWeight={600} mb={2}>
                    Student Marks % (first {pctChartData.length}, color = grade)
                  </Typography>
                  {pctChartData.length > 0 ? (
                    <ResponsiveContainer width="100%" height={200}>
                      <BarChart data={pctChartData} margin={{top:0,right:10,left:-20,bottom:0}}>
                        <CartesianGrid strokeDasharray="3 3" stroke="#E5E7EB"/>
                        <XAxis dataKey="name" tick={{fontSize:9}} interval={Math.floor(pctChartData.length/15)}/>
                        <YAxis tick={{fontSize:11}} domain={[0,100]}/>
                        <Tooltip formatter={v=>[`${v}%`,'Score']}/>
                        <Bar dataKey="pct" radius={[2,2,0,0]}>
                          {pctChartData.map((c,i)=><Cell key={i} fill={c.fill}/>)}
                        </Bar>
                      </BarChart>
                    </ResponsiveContainer>
                  ) : (
                    <Typography color="text.secondary" textAlign="center" py={4}>
                      No marks entered yet for this batch.
                    </Typography>
                  )}
                </CardContent>
              </Card>
            </Grid>
          </Grid>

          {/* Export / Print */}
          <Box display="flex" gap={2} mb={2} justifyContent="flex-end">
            <Button id="export-marks-excel" startIcon={<FileDownload/>} variant="contained"
              onClick={handleExport}>Export Excel</Button>
            <Button id="print-marks-report" startIcon={<Print/>} variant="outlined"
              onClick={handlePrint}>Print Report</Button>
          </Box>

          {/* Table */}
          <Card>
            <CardContent sx={{p:0}}>
              <div ref={printRef}>
                <Table size="small" stickyHeader>
                  <TableHead>
                    <TableRow>
                      {['#','RegNo','Name','Dept','CT1\n/25','CT2\n/25','Model\n/50','Assign\n/25','Total\n/125','%','Grade'].map(h=>(
                        <TableCell key={h} sx={{fontWeight:700,bgcolor:'#4F46E5',color:'white',fontSize:'0.7rem',whiteSpace:'pre'}}>
                          {h}
                        </TableCell>
                      ))}
                    </TableRow>
                  </TableHead>
                  <TableBody>
                    {data.students.map((r,i)=>(
                      <TableRow key={r.RegNo} sx={{'&:hover':{bgcolor:'#F9FAFB'},bgcolor:i%2?'#FAFAFA':'white'}}>
                        <TableCell sx={{fontSize:'0.7rem',color:'#9CA3AF'}}>{i+1}</TableCell>
                        <TableCell sx={{fontSize:'0.7rem',fontWeight:600}}>{r.RegNo}</TableCell>
                        <TableCell sx={{fontSize:'0.7rem'}}>{r.Name}</TableCell>
                        <TableCell sx={{fontSize:'0.7rem'}}>{r.Department}</TableCell>
                        {['CT1','CT2','Model','Assignment'].map(k=>(
                          <TableCell key={k} sx={{fontSize:'0.7rem',textAlign:'center',
                            color: r[k]!==null?'#4F46E5':'#D1D5DB',fontWeight:r[k]!==null?700:400}}>
                            {r[k] ?? '—'}
                          </TableCell>
                        ))}
                        <TableCell sx={{fontSize:'0.7rem',textAlign:'center',fontWeight:700}}>{r.Total}</TableCell>
                        <TableCell sx={{fontSize:'0.7rem',textAlign:'center'}}>
                          <Box>
                            <Typography fontSize="0.7rem" fontWeight={800} color={GRADE_COLOR[r.Grade]}>{r.Pct}%</Typography>
                            <LinearProgress variant="determinate" value={r.Pct}
                              sx={{height:3,borderRadius:2,mt:0.3,'& .MuiLinearProgress-bar':{bgcolor:GRADE_COLOR[r.Grade]}}}/>
                          </Box>
                        </TableCell>
                        <TableCell>
                          <Chip label={r.Grade} size="small"
                            sx={{bgcolor:`${GRADE_COLOR[r.Grade]}22`,color:GRADE_COLOR[r.Grade],fontWeight:800,height:20,fontSize:'0.7rem'}}/>
                        </TableCell>
                      </TableRow>
                    ))}
                  </TableBody>
                </Table>
              </div>
            </CardContent>
          </Card>
          <Typography variant="caption" color="text.secondary" display="block" mt={1} textAlign="right">
            {data.students.length} students · Batch {batch} {sem ? `· Sem ${sem}` : ''}
          </Typography>
        </>
      )}
    </PageWrapper>
  );
}
