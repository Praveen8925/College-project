import api from '../utils/axiosInstance';
export const getAssignments  = (params) => api.get('/assignments/index.php', { params });
export const saveAssignment  = (data)   => api.post('/assignments/index.php', data);
