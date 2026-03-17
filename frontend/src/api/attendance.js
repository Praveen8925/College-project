import api from '../utils/axiosInstance';

export const getAttendance         = (params) => api.get('/attendance/index.php',   { params });
export const markAttendance        = (data)   => api.post('/attendance/index.php',   data);
export const saveAttendance        = (data)   => api.post('/attendance/index.php',   data);
export const getStudentsForAtt     = (params) => api.get('/attendance/students.php', { params });
export const getAttendanceStudents = (params) => api.get('/attendance/students.php', { params });
export const getAttendanceReport   = (params) => api.get('/attendance/report.php',   { params });
