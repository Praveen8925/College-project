import api from '../utils/axiosInstance';
export const getDashboardStats = () => api.get('/dashboard/stats.php');
