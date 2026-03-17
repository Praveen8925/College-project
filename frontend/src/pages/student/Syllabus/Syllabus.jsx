import { useEffect, useState, useCallback } from 'react';
import {
  Box, Grid, Card, CardContent, Typography, Button,
  Select, MenuItem, FormControl, InputLabel, Alert, CircularProgress,
  List, ListItem, ListItemIcon, ListItemText, ListItemSecondaryAction,
  Divider, TextField, Chip,
} from '@mui/material';
import { PictureAsPdf, Download, Search, AutoStories } from '@mui/icons-material';
import { getSyllabus } from '../../../api/student';
import PageWrapper from '../../../components/common/PageWrapper';

const FILE_BASE = 'http://localhost/College-project/backend/';
const DEPTS = ['CSE','IT','ECE','EEE','MECH','CIVIL','MBA','MCA'];

export default function Syllabus() {
  const [rows,    setRows]    = useState([]);
  const [loading, setLoading] = useState(false);
  const [searched,setSearched]= useState(false);
  const [dept,    setDept]    = useState('');
  const [batch,   setBatch]   = useState('');
  const [error,   setError]   = useState('');

  const load = async () => {
    if (!dept) { setError('Please select a department.'); return; }
    setLoading(true); setError('');
    try {
      const { data } = await getSyllabus({ dept, batch });
      if (data.success) {
        setRows(data.data || []);
        setSearched(true);
      } else { setError(data.message || 'No records found.'); }
    } catch { setError('Failed to load syllabus.'); }
    finally { setLoading(false); }
  };

  const typeLabel = t => t === 'R' ? 'Regulation' : t === 'S' ? 'Semester Plan' : t || 'Syllabus';
  const typeColor = t => t === 'R'
    ? { bgcolor:'#EEF2FF', color:'#4F46E5' }
    : { bgcolor:'#ECFDF5', color:'#059669' };

  return (
    <PageWrapper>
      <Box mb={3}>
        <Typography variant="h4" fontWeight={700}>Syllabus</Typography>
        <Typography variant="body2" color="text.secondary">Download syllabus and regulation documents</Typography>
      </Box>

      {/* Filter */}
      <Card sx={{ mb:3 }}>
        <CardContent>
          <Grid container spacing={2} alignItems="center">
            <Grid size={{ xs:12, sm:5, md:4 }}>
              <FormControl fullWidth size="small">
                <InputLabel>Department *</InputLabel>
                <Select value={dept} label="Department *" onChange={e=>setDept(e.target.value)}>
                  {DEPTS.map(d=><MenuItem key={d} value={d}>{d}</MenuItem>)}
                </Select>
              </FormControl>
            </Grid>
            <Grid size={{ xs:12, sm:4, md:3 }}>
              <TextField fullWidth size="small" label="Batch (optional)" value={batch}
                onChange={e=>setBatch(e.target.value)} placeholder="e.g. 2022" />
            </Grid>
            <Grid>
              <Button variant="contained" startIcon={<Search />} onClick={load} disabled={loading}>
                {loading ? <CircularProgress size={18}/> : 'Search'}
              </Button>
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      {error && <Alert severity="error" sx={{ mb:2 }}>{error}</Alert>}

      {searched && !loading && rows.length === 0 && (
        <Alert severity="info">No syllabus files found for the selected filters.</Alert>
      )}

      {rows.length > 0 && (
        <Card sx={{ borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)' }}>
          <CardContent sx={{ px:0, py:0 }}>
            <Box sx={{ px:2, py:1.5, borderBottom:'1px solid #F3F4F6' }}>
              <Typography variant="subtitle2" color="text.secondary">
                {rows.length} document{rows.length!==1?'s':''} found
              </Typography>
            </Box>
            <List disablePadding>
              {rows.map((r, i) => {
                const fileName = r.file ? r.file.split('/').pop() : 'Document';
                const fileUrl  = r.file ? `${FILE_BASE}${r.file}` : null;

                return (
                  <Box key={i}>
                    {i > 0 && <Divider />}
                    <ListItem
                      sx={{
                        px:2, py:1.5,
                        '&:hover':{ bgcolor:'#F9FAFB' },
                        transition:'background 0.15s',
                      }}
                    >
                      <ListItemIcon sx={{ minWidth:44 }}>
                        <Box sx={{
                          width:38, height:38, borderRadius:1.5,
                          background:'linear-gradient(135deg,#4F46E5,#818CF8)',
                          display:'flex', alignItems:'center', justifyContent:'center',
                        }}>
                          <PictureAsPdf sx={{ color:'white', fontSize:20 }} />
                        </Box>
                      </ListItemIcon>
                      <ListItemText
                        primary={
                          <Box display="flex" alignItems="center" gap={1} flexWrap="wrap">
                            <Typography variant="body2" fontWeight={600}>{fileName}</Typography>
                            <Chip label={typeLabel(r.Type)} size="small" sx={typeColor(r.Type)} />
                            {r.Batch && <Chip label={`Batch ${r.Batch}`} size="small" variant="outlined" />}
                          </Box>
                        }
                        secondary={
                          <Typography variant="caption" color="text.secondary">
                            Department: {r.Department}
                          </Typography>
                        }
                      />
                      <ListItemSecondaryAction>
                        {fileUrl ? (
                          <Button
                            variant="outlined" size="small"
                            startIcon={<Download />}
                            href={fileUrl} target="_blank" rel="noopener noreferrer"
                            sx={{ borderRadius:2 }}
                          >
                            Download
                          </Button>
                        ) : (
                          <Typography variant="caption" color="text.secondary">No file</Typography>
                        )}
                      </ListItemSecondaryAction>
                    </ListItem>
                  </Box>
                );
              })}
            </List>
          </CardContent>
        </Card>
      )}

      {!searched && !loading && (
        <Box display="flex" flexDirection="column" alignItems="center" justifyContent="center"
          sx={{ mt:8, color:'text.secondary' }}>
          <AutoStories sx={{ fontSize:64, color:'#D1D5DB', mb:2 }} />
          <Typography variant="body1" color="text.secondary">Select a department to view syllabus documents</Typography>
        </Box>
      )}
    </PageWrapper>
  );
}
