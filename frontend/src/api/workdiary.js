import api from '../utils/axiosInstance';
export const getWorkDiary    = (sid)  => api.get('/workdiary/index.php', { params: { sid } });
export const addWorkDiary    = (data) => api.post('/workdiary/index.php', data);
export const deleteWorkDiary = (id)   => api.delete(`/workdiary/index.php?id=${id}`);
