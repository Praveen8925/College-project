import api from '../utils/axiosInstance';

export const getReportsSummary    = ()       => api.get('/reports/index.php');
export const getAttendanceReport  = (params) => api.get('/reports/attendance.php', { params });
export const getMarksReport       = (params) => api.get('/reports/marks.php',      { params });
