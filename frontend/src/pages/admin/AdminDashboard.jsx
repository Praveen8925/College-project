import { useCallback, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Box, Grid, Typography, Alert, Button, Tabs, Tab,
} from '@mui/material';
import {
  People, Group, EventNote, ReportProblem,
  ArrowForward, TrendingUp, Assessment, Timeline,
} from '@mui/icons-material';
import { BarChart, Bar, XAxis, YAxis, Tooltip as RTooltip, ResponsiveContainer, Cell } from 'recharts';
import { motion } from 'framer-motion';
import { getDashboardStats } from '../../api/dashboard';
import { useAuth } from '../../context/AuthContext';
import { useRealTimeData, useRealTimeNotifications } from '../../hooks/useRealTimeData';
import PageWrapper from '../../components/common/PageWrapper';
import StatsCard from '../../components/common/StatsCard';
import SectionCard from '../../components/common/SectionCard';
import RealTimeIndicator, { LiveNotification } from '../../components/common/RealTimeIndicator';
import { 
  DepartmentChart, 
  MarksDistributionChart, 
  AttendanceTrendsChart, 
  ComplaintStatusChart 
} from '../../components/charts/EnhancedCharts';

const STAT_CARDS = [
  { key: 'students',   label: 'Total Students',   icon: <People />,       color: 'primary' },
  { key: 'staff',      label: 'Total Staff',       icon: <Group />,        color: 'info' },
  { key: 'events',     label: 'Active Events',     icon: <EventNote />,    color: 'success' },
  { key: 'complaints', label: 'Open Complaints',   icon: <ReportProblem />,color: 'warning' },
];

const ROUTES = {
  students: '/admin/students',
  staff: '/admin/staff',
  events: '/admin/events',
  complaints: '/admin/complaints',
};

export default function AdminDashboard() {
  const { user } = useAuth();
  const navigate = useNavigate();
  const [currentTab, setCurrentTab] = useState(0);

  // Real-time data hook
  const {
    data: stats,
    loading,
    error,
    lastUpdate,
    isAutoRefreshing,
    refresh,
    toggleAutoRefresh,
  } = useRealTimeData(
    getDashboardStats,
    {
      refreshInterval: 30000, // 30 seconds
      autoRefresh: true,
      onDataUpdate: (newData, oldData) => {
        // Check for new complaints
        if (newData.stats.complaints > (oldData?.stats?.complaints || 0)) {
          addNotification({
            type: 'warning',
            title: 'New Complaint',
            message: 'A new complaint has been submitted',
          });
        }
        // Check for new events
        if (newData.stats.events > (oldData?.stats?.events || 0)) {
          addNotification({
            type: 'info',
            title: 'New Event',
            message: 'A new event has been added',
          });
        }
      },
    }
  );

  // Real-time notifications
  const { notifications, addNotification, removeNotification } = useRealTimeNotifications();

  const chartData = stats ? [
    { name: 'Students',   value: stats.stats.students },
    { name: 'Staff',      value: stats.stats.staff    },
    { name: 'Events',     value: stats.stats.events   },
    { name: 'Complaints', value: stats.stats.complaints },
  ] : [];
  const CHART_COLORS = ['#4F46E5', '#3B82F6', '#10B981', '#F59E0B'];

  return (
    <PageWrapper>
      {/* Live Notifications */}
      <LiveNotification 
        notifications={notifications} 
        onClose={removeNotification} 
      />

      {/* Header with Real-time Indicator */}
      <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', mb: 2, flexWrap: 'wrap', gap: 2 }}>
        <Box>
          <Typography variant="h4" fontWeight={700} color="text.primary">
            Real-time Dashboard
          </Typography>
          <Typography variant="body2" color="text.secondary" sx={{ mt: 0.5 }}>
            Live data updates every 30 seconds • Welcome back, {user?.name}!
          </Typography>
        </Box>
        <RealTimeIndicator
          lastUpdate={lastUpdate}
          isAutoRefreshing={isAutoRefreshing}
          onRefresh={refresh}
          onToggleAutoRefresh={toggleAutoRefresh}
          isLoading={loading}
          error={error}
          refreshInterval={30000}
        />
      </Box>

      {error && <Alert severity="error" sx={{ mb: 3 }}>{error}</Alert>}

      {/* Stat Cards */}
      <Grid container spacing={2} sx={{ mb: 3 }}>
        {STAT_CARDS.map((card, idx) => (
          <Grid size={{ xs: 12, sm: 6, md: 3 }} key={card.key}>
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: idx * 0.1 }}
            >
              <StatsCard
                id={`stat-card-${card.key}`}
                label={card.label}
                value={stats?.stats[card.key] ?? '—'}
                icon={card.icon}
                color={card.color}
                loading={loading}
                onClick={() => navigate(ROUTES[card.key])}
              />
            </motion.div>
          </Grid>
        ))}
      </Grid>

      {/* Analytics Tabs */}
      <Box sx={{ mb: 3 }}>
        <Tabs 
          value={currentTab} 
          onChange={(_, newValue) => setCurrentTab(newValue)}
          sx={{ borderBottom: 1, borderColor: 'divider' }}
        >
          <Tab icon={<Assessment />} label="Overview" />
          <Tab icon={<TrendingUp />} label="Departments" />
          <Tab icon={<Timeline />} label="Performance" />
          <Tab icon={<ReportProblem />} label="Issues" />
        </Tabs>
      </Box>

      {/* Tab Content */}
      {currentTab === 0 && (
        <Grid container spacing={3}>
          {/* Original Overview Chart */}
          <Grid size={{ xs: 12, md: 6 }}>
            <SectionCard title="Quick Overview" subtitle="Live statistics">
              <Box sx={{ height: 300, mt: 2 }}>
                <ResponsiveContainer width="100%" height="100%">
                  <BarChart data={chartData} barCategoryGap="30%">
                    <XAxis 
                      dataKey="name" 
                      tick={{ fontSize: 12, fill: '#6B7280' }} 
                      axisLine={{ stroke: '#E5E7EB' }}
                      tickLine={false}
                    />
                    <YAxis 
                      tick={{ fontSize: 12, fill: '#6B7280' }} 
                      allowDecimals={false}
                      axisLine={false}
                      tickLine={false}
                    />
                    <RTooltip 
                      contentStyle={{ 
                        borderRadius: 8, 
                        border: '1px solid #E5E7EB',
                        boxShadow: '0 4px 6px -1px rgba(0,0,0,0.1)',
                      }}
                    />
                    <Bar dataKey="value" radius={[6, 6, 0, 0]}>
                      {chartData.map((_, i) => <Cell key={i} fill={CHART_COLORS[i]} />)}
                    </Bar>
                  </BarChart>
                </ResponsiveContainer>
              </Box>
            </SectionCard>
          </Grid>

          {/* Attendance Trends */}
          <Grid size={{ xs: 12, md: 6 }}>
            <AttendanceTrendsChart data={stats?.analytics?.attendanceTrends || []} />
          </Grid>
        </Grid>
      )}

      {currentTab === 1 && (
        <Grid container spacing={3}>
          {/* Student Department Distribution */}
          <Grid size={{ xs: 12, md: 6 }}>
            <DepartmentChart 
              data={stats?.analytics?.departmentStats || []} 
              title="Students by Department"
            />
          </Grid>

          {/* Staff Department Distribution */}
          <Grid size={{ xs: 12, md: 6 }}>
            <DepartmentChart 
              data={stats?.analytics?.staffDeptStats || []} 
              title="Staff by Department"
            />
          </Grid>
        </Grid>
      )}

      {currentTab === 2 && (
        <Grid container spacing={3}>
          {/* Marks Distribution */}
          <Grid size={{ xs: 12, lg: 8 }}>
            <MarksDistributionChart data={stats?.analytics?.marksDistribution || {}} />
          </Grid>

          {/* Notes Activity */}
          <Grid size={{ xs: 12, lg: 4 }}>
            <SectionCard title="Notes Activity" subtitle="Subject-wise uploads">
              {stats?.analytics?.notesActivity?.length ? (
                stats.analytics.notesActivity.map((item, idx) => (
                  <Box key={item.Subject} sx={{ display: 'flex', justifyContent: 'space-between', py: 1 }}>
                    <Typography variant="body2">{item.Subject}</Typography>
                    <Typography variant="body2" fontWeight={600}>{item.count}</Typography>
                  </Box>
                ))
              ) : (
                <Typography variant="body2" color="text.secondary">No notes activity</Typography>
              )}
            </SectionCard>
          </Grid>
        </Grid>
      )}

      {currentTab === 3 && (
        <Grid container spacing={3}>
          {/* Complaint Status Chart */}
          <Grid size={{ xs: 12 }}>
            <ComplaintStatusChart data={stats?.analytics?.complaintTrends || []} />
          </Grid>
        </Grid>
      )}
    </PageWrapper>
  );
}
