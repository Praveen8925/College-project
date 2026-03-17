import { useEffect, useState } from 'react';
import {
  Box, Typography, CircularProgress, Alert, List, ListItem,
  ListItemText, Avatar, Divider, Chip, TextField, InputAdornment,
  Card, CardContent,
} from '@mui/material';
import { EventNote, Search } from '@mui/icons-material';
import { getStudentEvents } from '../../../api/student';

export default function ViewEvents() {
  const [events,  setEvents]  = useState([]);
  const [filtered,setFiltered]= useState([]);
  const [loading, setLoading] = useState(true);
  const [error,   setError]   = useState('');
  const [search,  setSearch]  = useState('');

  useEffect(() => {
    (async () => {
      setLoading(true);
      try {
        const { data } = await getStudentEvents();
        if (data.success) { setEvents(data.data); setFiltered(data.data); }
        else setError(data.message || 'No events found.');
      } catch { setError('Could not load events.'); }
      finally { setLoading(false); }
    })();
  }, []);

  useEffect(() => {
    const q = search.toLowerCase();
    setFiltered(q ? events.filter(e => (e.EventsMsg||'').toLowerCase().includes(q)) : events);
  }, [search, events]);

  return (
    <Box sx={{ p:3 }}>
      <Typography variant="h5" fontWeight={700} mb={0.5}>College Events</Typography>
      <Typography variant="body2" color="text.secondary" mb={3}>Stay updated with all college announcements and events</Typography>

      {error && <Alert severity="info" sx={{ mb:2 }}>{error}</Alert>}

      <TextField id="events-search" fullWidth size="small" placeholder="Search events…"
        value={search} onChange={e => setSearch(e.target.value)} sx={{ mb:2 }}
        InputProps={{ startAdornment:<InputAdornment position="start"><Search fontSize="small"/></InputAdornment> }} />

      {loading ? (
        <Box display="flex" justifyContent="center" py={8}><CircularProgress size={48}/></Box>
      ) : filtered.length === 0 ? (
        <Box py={8} textAlign="center">
          <EventNote sx={{ fontSize:56, color:'#ccc', mb:2 }} />
          <Typography color="text.secondary">No events found.</Typography>
        </Box>
      ) : (
        <Card>
          <CardContent sx={{ p:0 }}>
            <List disablePadding>
              {filtered.map((ev, i) => (
                <Box key={ev.EventID}>
                  <ListItem sx={{ py:2, px:3 }}>
                    <Avatar sx={{
                      bgcolor:'#E8EAF6', color:'#1A237E', mr:2, width:42, height:42,
                      fontSize:14, fontWeight:700, flexShrink:0,
                    }}>
                      {ev.EventID}
                    </Avatar>
                    <ListItemText
                      primary={ev.EventsMsg}
                      primaryTypographyProps={{ fontWeight:600, fontSize:'0.95rem' }}
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
        {filtered.length} event(s) · STC Online Portal
      </Typography>
    </Box>
  );
}
