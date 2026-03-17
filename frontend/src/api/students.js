import api from '../utils/axiosInstance';

export const getStudents   = (params) => api.get('/students/index.php', { params });
export const addStudent    = (data)   => api.post('/students/index.php', data);
export const getStudent    = (id)     => api.get('/students/detail.php', { params: { id } });
export const updateStudent = (id, data) => api.put(`/students/detail.php?id=${id}`, data);
export const deleteStudent = (id)     => api.delete(`/students/detail.php?id=${id}`);
