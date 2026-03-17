import api from '../utils/axiosInstance';
export const getAttendanceStudents = (params)  => api.get('/attendance/students.php', { params });
export const getAttendance         = (params)  => api.get('/attendance/index.php', { params });
export const saveAttendance        = (data)    => api.post('/attendance/index.php', data);
