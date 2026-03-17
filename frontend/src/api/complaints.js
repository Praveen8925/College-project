import api from '../utils/axiosInstance';

export const getComplaints   = (params) => api.get('/complaints/index.php', { params });
export const addComplaint    = (data)   => api.post('/complaints/index.php', data);
export const resolveComplaint = (data)  => api.put('/complaints/resolve.php', data);
