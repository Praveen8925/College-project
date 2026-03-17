import api from '../utils/axiosInstance';

export const getStaffList  = (params) => api.get('/staff/index.php', { params });
export const addStaff      = (data)   => api.post('/staff/index.php', data);
export const getStaff      = (id)     => api.get('/staff/detail.php', { params: { id } });
export const updateStaff   = (id, data) => api.put(`/staff/detail.php?id=${id}`, data);
export const deleteStaff   = (id)     => api.delete(`/staff/detail.php?id=${id}`);
