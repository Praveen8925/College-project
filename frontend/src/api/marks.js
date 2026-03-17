import api from '../utils/axiosInstance';
export const getInternalMarks = (params) => api.get('/marks/internal.php', { params });
export const saveInternalMark = (data)   => api.post('/marks/internal.php', data);
export const getCOEMarks      = (params) => api.get('/marks/coe.php', { params });
