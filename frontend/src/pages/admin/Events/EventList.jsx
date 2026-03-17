import { useEffect, useState } from 'react';
import {
  Box, Button, TextField, Typography, IconButton, Tooltip,
  Dialog, DialogTitle, DialogContent, DialogActions,
  List, ListItem, ListItemText, ListItemSecondaryAction,
  Alert, Snackbar, CircularProgress, Chip, Avatar, Divider,
} from '@mui/material';
import { Add, Delete, EventNote, Close } from '@mui/icons-material';
import { getEvents, addEvent, deleteEvent } from '../../../api/events';
import PageWrapper from '../../../components/common/PageWrapper';

export default function EventList() {
  const [events,  setEvents]  = useState([]);
  const [loading, setLoading] = useState(true);
  const [addOpen, setAddOpen] = useState(false);
  const [msg,     setMsg]     = useState('');
  const [delId,   setDelId]   = useState(null);
  const [saving,  setSaving]  = useState(false);
  const [error,   setError]   = useState('');
  const [snack,   setSnack]   = useState({ open:false, msg:'', sev:'success' });

  const load = async () => {
    setLoading(true);
    try {
      const { data } = await getEvents();
      if (data.success) setEvents(data.data);
    } catch { setError('Failed to load events.'); }
    finally { setLoading(false); }
  };
  useEffect(() => { load(); }, []);

  const handleAdd = async () => {
    if (!msg.trim()) return;
    setSaving(true);
    try {
      await addEvent({ EventsMsg: msg });
      setSnack({ open:true, msg:'Event added!', sev:'success' });
      setAddOpen(false); setMsg(''); load();
    } catch (err) { setError(err.response?.data?.message || 'Add failed.'); }
    finally { setSaving(false); }
  };

  const handleDelete = async () => {
    try {
      await deleteEvent(delId);
      setSnack({ open:true, msg:'Event deleted.', sev:'info' });
      setDelId(null); load();
    } catch { setSnack({ open:true, msg:'Delete failed.', sev:'error' }); }
  };

  return (
    <PageWrapper>
      <Box display="flex" justifyContent="space-between" alignItems="center" mb={3}>
        <Box>
          <Typography variant="h4" fontWeight={700}>Events Management</Typography>
          <Typography variant="body2" color="text.secondary">{events.length} active event(s) — displayed on login page</Typography>
        </Box>
        <Button id="add-event-btn" variant="contained" startIcon={<Add />} onClick={() => setAddOpen(true)}>Add Event</Button>
      </Box>

      {error && <Alert severity="error" sx={{ mb:2, borderRadius: 2 }}>{error}</Alert>}

      <Box sx={{ bgcolor:'white', borderRadius:2, boxShadow:'0 1px 3px rgba(0,0,0,0.08)', overflow:'hidden' }}>
        {loading ? (
          <Box display="flex" justifyContent="center" py={4}><CircularProgress /></Box>
        ) : events.length === 0 ? (
          <Box py={6} textAlign="center">
            <EventNote sx={{ fontSize:48, color:'#D1D5DB', mb:1 }} />
            <Typography color="text.secondary">No events yet. Add one!</Typography>
          </Box>
        ) : (
          <List disablePadding>
            {events.map((ev, i) => (
              <Box key={ev.EventID}>
                <ListItem sx={{ py:1.8, px:3 }}>
                  <Avatar sx={{ bgcolor:'#EEF2FF', color:'#4F46E5', mr:2, width:36, height:36, fontSize:14, fontWeight:700 }}>
                    {ev.EventID}
                  </Avatar>
                  <ListItemText
                    primary={ev.EventsMsg}
                    primaryTypographyProps={{ fontWeight:500 }}
                  />
                  <ListItemSecondaryAction>
                    <Tooltip title="Delete event">
                      <IconButton id={`delete-event-${ev.EventID}`} color="error" edge="end"
                        onClick={() => setDelId(ev.EventID)}>
                        <Delete />
                      </IconButton>
                    </Tooltip>
                  </ListItemSecondaryAction>
                </ListItem>
                {i < events.length - 1 && <Divider />}
              </Box>
            ))}
          </List>
        )}
      </Box>

      {/* Add Dialog */}
      <Dialog open={addOpen} onClose={() => setAddOpen(false)} maxWidth="sm" fullWidth>
        <DialogTitle sx={{ display:'flex', justifyContent:'space-between', alignItems:'center' }}>
          Add New Event
          <IconButton onClick={() => setAddOpen(false)}><Close /></IconButton>
        </DialogTitle>
        <DialogContent dividers>
          <TextField id="event-message-field" fullWidth multiline rows={3} label="Event Message / Announcement *"
            value={msg} onChange={e => setMsg(e.target.value)}
            placeholder="e.g. College Day Celebration on 25th March 2026..." />
        </DialogContent>
        <DialogActions sx={{ px:3, py:2 }}>
          <Button onClick={() => setAddOpen(false)}>Cancel</Button>
          <Button id="save-event-btn" variant="contained" onClick={handleAdd} disabled={saving || !msg.trim()}>
            {saving ? <CircularProgress size={20} /> : 'Add Event'}
          </Button>
        </DialogActions>
      </Dialog>

      {/* Delete Confirm */}
      <Dialog open={!!delId} onClose={() => setDelId(null)} maxWidth="xs" fullWidth>
        <DialogTitle>Delete Event</DialogTitle>
        <DialogContent><Typography>Are you sure you want to remove this event?</Typography></DialogContent>
        <DialogActions>
          <Button onClick={() => setDelId(null)}>Cancel</Button>
          <Button id="confirm-delete-event" color="error" variant="contained" onClick={handleDelete}>Delete</Button>
        </DialogActions>
      </Dialog>

      <Snackbar open={snack.open} autoHideDuration={3000} onClose={() => setSnack(s=>({...s,open:false}))}>
        <Alert severity={snack.sev} sx={{ width:'100%' }}>{snack.msg}</Alert>
      </Snackbar>
    </PageWrapper>
  );
}
