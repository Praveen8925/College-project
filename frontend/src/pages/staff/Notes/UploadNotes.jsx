import { useEffect, useState, useRef } from 'react';
import {
  Box, Card, CardContent, Typography, TextField, Select, MenuItem,
  FormControl, InputLabel, Button, Grid, CircularProgress, Alert,
  List, ListItem, ListItemText, ListItemIcon, IconButton, Divider,
  Snackbar, Chip, Tooltip,
} from '@mui/material';
import { CloudUpload, PictureAsPdf, Article, Delete, MenuBook } from '@mui/icons-material';
import { getNotes, uploadNote, deleteNote } from '../../../api/notes';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

const SEMS = [1,2,3,4,5,6];
const FILE_ICONS = { pdf: <PictureAsPdf color="error" />, docx: <Article color="primary" />, doc: <Article color="primary" /> };

export default function UploadNotes() {
  const { user } = useAuth();
  const fileRef  = useRef(null);

  const [notes,   setNotes]   = useState([]);
  const [loading, setLoading] = useState(false);
  const [saving,  setSaving]  = useState(false);
  const [error,   setError]   = useState('');
  const [snack,   setSnack]   = useState({ open:false, msg:'', sev:'success' });
  const [selFile, setSelFile] = useState(null);
  const [form,    setForm]    = useState({ Batch:'', sem:'', SubjectCode:'', Department: user?.dept||'', Description:'' });
  const [delId,   setDelId]   = useState(null);

  const loadNotes = async () => {
    setLoading(true);
    try {
      const { data } = await getNotes({ sid: user?.id });
      if (data.success) setNotes(data.data);
    } catch { setError('Failed to load notes.'); }
    finally { setLoading(false); }
  };
  useEffect(() => { if (user?.id) loadNotes(); }, [user]);

  const set = (k) => (e) => setForm(f => ({ ...f, [k]: e.target.value }));

  const handleUpload = async () => {
    if (!form.Batch || !form.sem) { setError('Batch and semester are required.'); return; }
    setSaving(true); setError('');
    try {
      const fd = new FormData();
      fd.append('SID', user?.id || '');
      Object.entries(form).forEach(([k,v]) => fd.append(k, v));
      if (selFile) fd.append('file', selFile);
      const { data } = await uploadNote(fd);
      if (data.success) {
        setSnack({ open:true, msg:'Notes uploaded successfully!', sev:'success' });
        setForm(f => ({ ...f, SubjectCode:'', Description:'' }));
        setSelFile(null); if(fileRef.current) fileRef.current.value='';
        loadNotes();
      } else { setError(data.message || 'Upload failed.'); }
    } catch (err) { setError(err.response?.data?.message || 'Upload failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async (id) => {
    try {
      await deleteNote(id);
      setSnack({ open:true, msg:'Note deleted.', sev:'info' });
      loadNotes();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  const extIcon = (fn='') => {
    const ext = fn.split('.').pop()?.toLowerCase();
    return FILE_ICONS[ext] || <MenuBook color="action" />;
  };

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>Upload Notes</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>Share study materials with students</Typography>

      {error && <Alert severity="error" sx={{ mb:2, borderRadius: 2 }}>{error}</Alert>}

      <Grid container spacing={3}>
        {/* Upload Form */}
        <Grid size={{ xs: 12, md: 5 }}>
          <Card sx={{ borderLeft: '4px solid #059669' }}>
            <CardContent>
              <Typography variant="h6" fontWeight={600} mb={2}>Upload New Note</Typography>
              <Grid container spacing={2}>
                <Grid size={{ xs: 6 }}>
                  <TextField id="notes-batch" fullWidth label="Batch Year *" type="number" value={form.Batch} onChange={set('Batch')} />
                </Grid>
                <Grid size={{ xs: 6 }}>
                  <FormControl fullWidth>
                    <InputLabel>Semester *</InputLabel>
                    <Select value={form.sem} label="Semester *" id="notes-sem" onChange={set('sem')}>
                      {SEMS.map(s => <MenuItem key={s} value={s}>Sem {s}</MenuItem>)}
                    </Select>
                  </FormControl>
                </Grid>
                <Grid size={{ xs: 12 }}>
                  <TextField id="notes-subcode" fullWidth label="Subject Code" value={form.SubjectCode} onChange={set('SubjectCode')} />
                </Grid>
                <Grid size={{ xs: 12 }}>
                  <TextField id="notes-desc" fullWidth label="Description / Topic" multiline rows={2} value={form.Description} onChange={set('Description')} />
                </Grid>
                <Grid size={{ xs: 12 }}>
                  {/* File picker */}
                  <Box
                    sx={{
                      border:'2px dashed', borderColor: selFile ? '#4F46E5' : '#E5E7EB',
                      borderRadius:2, p:3, textAlign:'center', cursor:'pointer',
                      bgcolor: selFile ? '#EEF2FF' : 'transparent',
                      transition:'all 0.2s',
                      '&:hover':{ borderColor:'#4F46E5', bgcolor:'#EEF2FF' },
                    }}
                    onClick={() => fileRef.current?.click()}
                  >
                    <CloudUpload sx={{ fontSize:36, color: selFile ? '#4F46E5' : '#9CA3AF', mb:1 }} />
                    <Typography variant="body2" color={selFile ? '#4F46E5' : 'text.secondary'}>
                      {selFile ? selFile.name : 'Click to select file (PDF, DOCX, PPT)'}
                    </Typography>
                    {selFile && (
                      <Chip label={`${(selFile.size/1024).toFixed(1)} KB`} size="small" sx={{ mt:1 }} />
                    )}
                    <input ref={fileRef} type="file" hidden accept=".pdf,.doc,.docx,.ppt,.pptx"
                      onChange={e => setSelFile(e.target.files?.[0] || null)} />
                  </Box>
                </Grid>
                <Grid size={{ xs: 12 }}>
                  <Button id="upload-notes-btn" fullWidth variant="contained" size="large"
                    onClick={handleUpload} disabled={saving}
                    startIcon={saving ? <CircularProgress size={18}/> : <CloudUpload />}>
                    {saving ? 'Uploading...' : 'Upload Notes'}
                  </Button>
                </Grid>
              </Grid>
            </CardContent>
          </Card>
        </Grid>

        {/* Uploaded Notes List */}
        <Grid size={{ xs: 12, md: 7 }}>
          <Card sx={{ height:'100%' }}>
            <CardContent>
              <Typography variant="h6" fontWeight={600} mb={2}>My Uploaded Notes ({notes.length})</Typography>
              {loading ? (
                <Box display="flex" justifyContent="center" py={4}><CircularProgress /></Box>
              ) : notes.length === 0 ? (
                <Box py={6} textAlign="center">
                  <MenuBook sx={{ fontSize:48, color:'#D1D5DB', mb:1 }} />
                  <Typography color="text.secondary">No notes uploaded yet.</Typography>
                </Box>
              ) : (
                <List disablePadding>
                  {notes.map((n, i) => (
                    <Box key={n.NID ?? i}>
                      <ListItem
                        secondaryAction={
                          <Tooltip title="Delete">
                            <IconButton id={`del-note-${n.NID}`} color="error" edge="end" onClick={() => handleDelete(n.NID)}>
                              <Delete fontSize="small" />
                            </IconButton>
                          </Tooltip>
                        }
                        sx={{ py:1.5 }}
                      >
                        <ListItemIcon sx={{ minWidth:42 }}>{extIcon(n.FileName)}</ListItemIcon>
                        <ListItemText
                          primary={n.Description || n.SubjectCode || 'Note'}
                          secondary={`Batch ${n.Batch} · Sem ${n.sem} · ${n.SubjectCode || '—'} · ${n.UploadDate || ''}`}
                          primaryTypographyProps={{ fontWeight:600, fontSize:'0.9rem' }}
                          secondaryTypographyProps={{ fontSize:'0.75rem' }}
                        />
                      </ListItem>
                      {i < notes.length-1 && <Divider />}
                    </Box>
                  ))}
                </List>
              )}
            </CardContent>
          </Card>
        </Grid>
      </Grid>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
