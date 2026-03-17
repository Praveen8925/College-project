import {
  Box, Typography, Card, CardContent, Grid,
  useTheme, Chip,
} from '@mui/material';
import {
  PieChart, Pie, Cell, BarChart, Bar, XAxis, YAxis,
  CartesianGrid, Tooltip, ResponsiveContainer,
  LineChart, Line, Area, AreaChart,
} from 'recharts';
import { motion } from 'framer-motion';

const COLORS = ['#4F46E5', '#06B6D4', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'];

// Department Distribution Pie Chart
export function DepartmentChart({ data = [], title = "Students by Department" }) {
  const theme = useTheme();
  
  if (!data || data.length === 0) {
    return (
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <Typography color="text.secondary">No data available</Typography>
        </CardContent>
      </Card>
    );
  }

  const chartData = data.map((item, index) => ({
    name: item.Department || item.name,
    value: parseInt(item.count || item.value),
    fill: COLORS[index % COLORS.length],
  }));

  const renderLabel = ({ cx, cy, midAngle, innerRadius, outerRadius, value, name }) => {
    const RADIAN = Math.PI / 180;
    const radius = innerRadius + (outerRadius - innerRadius) * 0.5;
    const x = cx + radius * Math.cos(-midAngle * RADIAN);
    const y = cy + radius * Math.sin(-midAngle * RADIAN);
    
    return (
      <text 
        x={x} 
        y={y} 
        fill="white" 
        textAnchor={x > cx ? 'start' : 'end'} 
        dominantBaseline="central"
        fontSize={12}
        fontWeight={600}
      >
        {value}
      </text>
    );
  };

  return (
    <motion.div
      initial={{ opacity: 0, scale: 0.9 }}
      animate={{ opacity: 1, scale: 1 }}
      transition={{ duration: 0.5 }}
    >
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <ResponsiveContainer width="100%" height={240}>
            <PieChart>
              <Pie
                data={chartData}
                cx="50%"
                cy="50%"
                labelLine={false}
                label={renderLabel}
                outerRadius={80}
                dataKey="value"
              >
                {chartData.map((entry, index) => (
                  <Cell key={`cell-${index}`} fill={entry.fill} />
                ))}
              </Pie>
              <Tooltip formatter={(value, name) => [value, name]} />
            </PieChart>
          </ResponsiveContainer>
          <Box sx={{ mt: 2, display: 'flex', flexWrap: 'wrap', gap: 1 }}>
            {chartData.map((item, index) => (
              <Chip
                key={item.name}
                label={`${item.name}: ${item.value}`}
                size="small"
                sx={{ 
                  bgcolor: item.fill,
                  color: 'white',
                  fontWeight: 600,
                }}
              />
            ))}
          </Box>
        </CardContent>
      </Card>
    </motion.div>
  );
}

// Marks Distribution Bar Chart
export function MarksDistributionChart({ data = {}, title = "Marks Distribution" }) {
  if (!data || Object.keys(data).length === 0) {
    return (
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <Typography color="text.secondary">No marks data available</Typography>
        </CardContent>
      </Card>
    );
  }

  // Transform data for chart
  const chartData = Object.entries(data).map(([examType, distribution]) => {
    const total = Object.values(distribution).reduce((sum, count) => sum + count, 0);
    return {
      exam: examType.replace('cycletest_', 'CT').replace('modelexam', 'Model'),
      total,
      ...distribution,
    };
  });

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.6 }}
    >
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <ResponsiveContainer width="100%" height={240}>
            <BarChart data={chartData} margin={{ top: 20, right: 30, left: 20, bottom: 5 }}>
              <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
              <XAxis 
                dataKey="exam" 
                tick={{ fontSize: 12 }}
                axisLine={{ stroke: '#e0e0e0' }}
              />
              <YAxis 
                tick={{ fontSize: 12 }}
                axisLine={{ stroke: '#e0e0e0' }}
              />
              <Tooltip 
                formatter={(value, name) => [value, name]}
                labelStyle={{ color: '#666' }}
                contentStyle={{ 
                  backgroundColor: 'white',
                  border: '1px solid #e0e0e0',
                  borderRadius: 8,
                }}
              />
              <Bar dataKey="0-40" stackId="a" fill="#EF4444" />
              <Bar dataKey="41-50" stackId="a" fill="#F59E0B" />
              <Bar dataKey="51-60" stackId="a" fill="#84CC16" />
              <Bar dataKey="61-75" stackId="a" fill="#10B981" />
              <Bar dataKey="76-100" stackId="a" fill="#059669" />
            </BarChart>
          </ResponsiveContainer>
          <Box sx={{ mt: 2, display: 'flex', flexWrap: 'wrap', gap: 1 }}>
            {[
              { range: '0-40', color: '#EF4444', label: 'Poor' },
              { range: '41-50', color: '#F59E0B', label: 'Fair' },
              { range: '51-60', color: '#84CC16', label: 'Average' },
              { range: '61-75', color: '#10B981', label: 'Good' },
              { range: '76-100', color: '#059669', label: 'Excellent' },
            ].map((item) => (
              <Chip
                key={item.range}
                label={`${item.range} (${item.label})`}
                size="small"
                sx={{ 
                  bgcolor: item.color,
                  color: 'white',
                  fontWeight: 600,
                }}
              />
            ))}
          </Box>
        </CardContent>
      </Card>
    </motion.div>
  );
}

// Attendance Trends Line Chart
export function AttendanceTrendsChart({ data = [], title = "Attendance Trends" }) {
  if (!data || data.length === 0) {
    return (
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <Typography color="text.secondary">No attendance data available</Typography>
        </CardContent>
      </Card>
    );
  }

  const chartData = data.map(item => ({
    batch: `Batch ${item.batch}`,
    records: item.records,
    percentage: Math.min(100, (item.records / 100) * 75), // Estimated attendance %
  }));

  return (
    <motion.div
      initial={{ opacity: 0, x: -20 }}
      animate={{ opacity: 1, x: 0 }}
      transition={{ duration: 0.7 }}
    >
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <ResponsiveContainer width="100%" height={240}>
            <AreaChart data={chartData} margin={{ top: 20, right: 30, left: 20, bottom: 5 }}>
              <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
              <XAxis 
                dataKey="batch" 
                tick={{ fontSize: 12 }}
                axisLine={{ stroke: '#e0e0e0' }}
              />
              <YAxis 
                tick={{ fontSize: 12 }}
                axisLine={{ stroke: '#e0e0e0' }}
              />
              <Tooltip 
                formatter={(value, name) => [
                  name === 'records' ? `${value} records` : `${value.toFixed(1)}%`,
                  name === 'records' ? 'Total Records' : 'Est. Attendance %'
                ]}
                labelStyle={{ color: '#666' }}
                contentStyle={{ 
                  backgroundColor: 'white',
                  border: '1px solid #e0e0e0',
                  borderRadius: 8,
                }}
              />
              <Area 
                type="monotone" 
                dataKey="percentage" 
                stroke="#4F46E5" 
                fill="url(#attendanceGradient)"
                strokeWidth={2}
              />
              <defs>
                <linearGradient id="attendanceGradient" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="5%" stopColor="#4F46E5" stopOpacity={0.8} />
                  <stop offset="95%" stopColor="#4F46E5" stopOpacity={0.1} />
                </linearGradient>
              </defs>
            </AreaChart>
          </ResponsiveContainer>
        </CardContent>
      </Card>
    </motion.div>
  );
}

// Complaint Status Chart
export function ComplaintStatusChart({ data = [], title = "Complaint Status Overview" }) {
  if (!data || data.length === 0) {
    return (
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <Typography color="text.secondary">No complaint data available</Typography>
        </CardContent>
      </Card>
    );
  }

  // Group by type and status
  const processedData = data.reduce((acc, item) => {
    const type = item.Type;
    if (!acc[type]) acc[type] = { type, Pending: 0, Resolved: 0, total: 0 };
    acc[type][item.Status] = parseInt(item.count);
    acc[type].total += parseInt(item.count);
    return acc;
  }, {});

  const chartData = Object.values(processedData);

  return (
    <motion.div
      initial={{ opacity: 0, y: 30 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.8 }}
    >
      <Card sx={{ height: 320 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>{title}</Typography>
          <ResponsiveContainer width="100%" height={240}>
            <BarChart data={chartData} margin={{ top: 20, right: 30, left: 20, bottom: 5 }}>
              <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
              <XAxis 
                dataKey="type" 
                tick={{ fontSize: 11 }}
                axisLine={{ stroke: '#e0e0e0' }}
                angle={-45}
                textAnchor="end"
                height={60}
              />
              <YAxis 
                tick={{ fontSize: 12 }}
                axisLine={{ stroke: '#e0e0e0' }}
              />
              <Tooltip 
                formatter={(value, name) => [value, name]}
                labelStyle={{ color: '#666' }}
                contentStyle={{ 
                  backgroundColor: 'white',
                  border: '1px solid #e0e0e0',
                  borderRadius: 8,
                }}
              />
              <Bar dataKey="Resolved" fill="#10B981" />
              <Bar dataKey="Pending" fill="#F59E0B" />
            </BarChart>
          </ResponsiveContainer>
          <Box sx={{ mt: 2, display: 'flex', gap: 2, justifyContent: 'center' }}>
            <Chip label="Resolved" sx={{ bgcolor: '#10B981', color: 'white' }} size="small" />
            <Chip label="Pending" sx={{ bgcolor: '#F59E0B', color: 'white' }} size="small" />
          </Box>
        </CardContent>
      </Card>
    </motion.div>
  );
}
