import api from '../utils/axiosInstance';

export const getSubjects  = (params) => api.get('/subjects/index.php', { params });
export const addSubject   = (data)   => api.post('/subjects/index.php', data);
export const deleteSubject = (id)    => api.delete(`/subjects/index.php?id=${id}`);
