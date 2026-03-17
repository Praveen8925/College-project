import api from '../utils/axiosInstance';

export const getStudentDashboard   = (regno)  => api.get('/student/dashboard.php', { params: { regno } });
export const getStudentAttendance  = (params) => api.get('/student/attendance.php',  { params });
export const getStudentMarks       = (params) => api.get('/student/marks.php',       { params });
export const getStudentNotes       = (params) => api.get('/student/notes.php',       { params });
export const getStudentAssignments = (params) => api.get('/student/assignments.php', { params });
export const getStudentComplaints  = (params) => api.get('/student/complaints.php',  { params });
export const submitComplaint       = (data)   => api.post('/student/complaints.php', data);
export const getStudentEvents      = ()       => api.get('/events/index.php');
export const getStudentTimetable   = (params) => api.get('/student/timetable.php',   { params });
export const changePassword        = (data)   => api.post('/student/password.php',   data);
export const getSyllabus           = (params) => api.get('/student/syllabus.php',    { params });
