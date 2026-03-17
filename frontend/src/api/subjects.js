import api from '../utils/axiosInstance';

export const getSubjects      = (params) => api.get('/subjects/index.php', { params });
export const addSubject       = (data)   => api.post('/subjects/index.php', data);
export const deleteSubject    = (id)     => api.delete(`/subjects/index.php?id=${id}`);
export const getFinalizeList  = (params) => api.get('/subjects/finalize.php', { params });
export const finalizeSubjects = (data)   => api.post('/subjects/finalize.php', data);
