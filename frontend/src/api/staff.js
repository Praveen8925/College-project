import api from '../utils/axiosInstance';

export const getStaffDashboard = (sid) => api.get('/staff/dashboard.php', { params: { sid } });
export const getStaffList  = (params) => api.get('/staff/index.php', { params });
export const addStaff      = (data)   => api.post('/staff/index.php', data);
export const getStaff      = (id)     => api.get('/staff/detail.php', { params: { id } });
export const updateStaff   = (id, data) => api.put(`/staff/detail.php?id=${id}`, data);
export const deleteStaff   = (id)     => api.delete(`/staff/detail.php?id=${id}`);

// Allocation
export const getAllocations  = (params) => api.get('/staff/allocation.php', { params });
export const saveAllocation  = (data)   => api.post('/staff/allocation.php', data);
export const deleteAllocation = (params) => api.delete('/staff/allocation.php', { params });

// Transfer
export const getTransfers   = (params) => api.get('/staff/transfer.php', { params });
export const saveTransfer   = (data)   => api.post('/staff/transfer.php', data);

// Class Incharge
export const getClassIncharge  = (params) => api.get('/staff/classincharge.php', { params });
export const saveClassIncharge = (data)   => api.post('/staff/classincharge.php', data);
export const deleteClassIncharge = (params) => api.delete('/staff/classincharge.php', { params });
