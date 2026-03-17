import { useEffect, useState } from 'react';
import {
  Box, Card, CardContent, Typography, CircularProgress, Alert,
  List, ListItem, ListItemIcon, ListItemText, Divider,
  Chip, IconButton, Tooltip, TextField, InputAdornment,
} from '@mui/material';
import { PictureAsPdf, Article, MenuBook, Download, Search } from '@mui/icons-material';
import { getStudentNotes } from '../../../api/student';
import { useAuth } from '../../../context/AuthContext';
import PageWrapper from '../../../components/common/PageWrapper';

const EXT_ICON = {
  pdf: <PictureAsPdf sx={{ color:'#DC2626' }} />,
  doc:  <Article sx={{ color:'#2563EB' }} />,
  docx: <Article sx={{ color:'#2563EB' }} />,
  ppt:  <Article sx={{ color:'#EA580C' }} />,
  pptx: <Article sx={{ color:'#EA580C' }} />,
};

export default function ViewNotes() {
  const { user }  = useAuth();
  const [notes,   setNotes]   = useState([]);
  const [filtered,setFiltered]= useState([]);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');
  const [search,  setSearch]  = useState('');

  useEffect(() => {
    if (!user?.id) return;
    (async () => {
      setLoading(true);
      try {
        const { data } = await getStudentNotes({ batch:user.batch, sem:user.sem, dept:user.dept });
        if (data.success) { setNotes(data.data); setFiltered(data.data); }
        else setError(data.message || 'No notes found.');
      } catch { setError('Could not load notes.'); }
      finally { setLoading(false); }
    })();
  }, [user]);

  useEffect(() => {
    const q = search.toLowerCase();
    setFiltered(q ? notes.filter(n =>
      (n.Description||'').toLowerCase().includes(q) ||
      (n.SubjectCode||'').toLowerCase().includes(q) ||
      (n.StaffName||'').toLowerCase().includes(q)
    ) : notes);
  }, [search, notes]);

  const extIcon = (fn='') => {
    const ext = fn.split('.').pop()?.toLowerCase();
    return EXT_ICON[ext] || <MenuBook color="action" />;
  };

  return (
    <PageWrapper>
      <Typography variant="h4" fontWeight={700} mb={0.5}>Study Notes</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>
        Materials for Batch {user?.batch} · Semester {user?.sem} · {user?.dept}
      </Typography>

      {error && <Alert severity="info" sx={{ mb:2, borderRadius: 2 }}>{error}</Alert>}

      <TextField id="notes-search" fullWidth size="small" placeholder="Search by subject, description or staff name…"
        value={search} onChange={e => setSearch(e.target.value)} sx={{ mb:2 }}
        InputProps={{ startAdornment:<InputAdornment position="start"><Search fontSize="small"/></InputAdornment> }} />

      {loading ? (
        <Box display="flex" justifyContent="center" py={8}><CircularProgress size={48}/></Box>
      ) : filtered.length === 0 ? (
        <Box py={8} textAlign="center">
          <MenuBook sx={{ fontSize:56, color:'#D1D5DB', mb:2 }} />
          <Typography color="text.secondary">
            {notes.length === 0 ? 'No study materials have been uploaded for your class yet.' : 'No results match your search.'}
          </Typography>
        </Box>
      ) : (
        <Card>
          <CardContent sx={{ p:0 }}>
            <List disablePadding>
              {filtered.map((n, i) => (
                <Box key={n.NID ?? i}>
                  <ListItem
                    sx={{ py:2, px:3 }}
                    secondaryAction={
                      n.downloadUrl ? (
                        <Tooltip title="Download file">
                          <IconButton id={`dl-note-${n.NID}`} component="a"
                            href={n.downloadUrl} target="_blank" rel="noopener noreferrer"
                            color="primary" edge="end">
                            <Download />
                          </IconButton>
                        </Tooltip>
                      ) : null
                    }
                  >
                    <ListItemIcon sx={{ minWidth:48 }}>
                      {extIcon(n.FileName || '')}
                    </ListItemIcon>
                    <ListItemText
                      primary={
                        <Box display="flex" alignItems="center" gap={1} flexWrap="wrap">
                          <Typography variant="body1" fontWeight={600}>
                            {n.Description || 'Study Material'}
                          </Typography>
                          {n.SubjectCode && (
                            <Chip label={n.SubjectCode} size="small" color="primary" variant="outlined" />
                          )}
                          {!n.FileName && (
                            <Chip label="No File" size="small" variant="outlined" color="default" />
                          )}
                        </Box>
                      }
                      secondary={
                        <Typography variant="caption" color="text.secondary">
                          Uploaded by: <b>{n.StaffName || 'Staff'}</b>
                          {n.UploadDate && ` · ${new Date(n.UploadDate).toLocaleDateString('en-IN')}`}
                          {n.FileName && ` · ${n.FileName.split('.').pop()?.toUpperCase()}`}
                        </Typography>
                      }
                    />
                  </ListItem>
                  {i < filtered.length - 1 && <Divider />}
                </Box>
              ))}
            </List>
          </CardContent>
        </Card>
      )}

      <Typography variant="caption" color="text.secondary" display="block" mt={2} textAlign="center">
        {filtered.length} material(s) shown · Batch {user?.batch} · Sem {user?.sem}
      </Typography>
    </PageWrapper>
  );
}
