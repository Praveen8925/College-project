import api from '../utils/axiosInstance';

export const getEvents   = ()     => api.get('/events/index.php');
export const addEvent    = (data) => api.post('/events/index.php', data);
export const deleteEvent = (id)   => api.delete(`/events/index.php?id=${id}`);
