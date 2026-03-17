import api from '../utils/axiosInstance';

export const getStudentDashboard = (regno)         => api.get('/student/dashboard.php',   { params: { regno } });
export const getStudentAttendance = (params)        => api.get('/student/attendance.php',  { params });
export const getStudentMarks      = (params)        => api.get('/student/marks.php',       { params });
export const getStudentNotes      = (params)        => api.get('/student/notes.php',       { params });
export const getStudentComplaints = (params)        => api.get('/student/complaints.php',  { params });
export const submitComplaint      = (data)          => api.post('/student/complaints.php', data);
export const getStudentEvents     = ()              => api.get('/events/index.php');
