import api from '../utils/axiosInstance';

export const getReportsSummary    = ()       => api.get('/reports/index.php');
export const getAttendanceReport  = (params) => api.get('/reports/attendance.php', { params });
export const getMarksReport       = (params) => api.get('/reports/marks.php',      { params });
export const getStudentReport     = (regno)  => api.get('/reports/student.php',    { params: { regno } });
export const getStaffReport       = (params) => api.get('/reports/staff.php',      { params });
