import api from '../utils/axiosInstance';
export const getNotes    = (params) => api.get('/notes/index.php', { params });
export const uploadNote  = (formData) => api.post('/notes/index.php', formData, {
  headers: { 'Content-Type': 'multipart/form-data' },
});
export const deleteNote  = (id) => api.delete(`/notes/index.php?id=${id}`);
