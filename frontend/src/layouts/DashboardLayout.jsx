import { Box, Toolbar } from '@mui/material';
import Sidebar, { DRAWER_WIDTH } from '../components/common/Sidebar';
import Navbar from '../components/common/Navbar';

/**
 * Shared layout for all authenticated dashboards.
 * Wraps page content with Sidebar + Navbar.
 * Responsive: sidebar hidden on mobile, full width content.
 */
export default function DashboardLayout({ children }) {
  return (
    <Box sx={{ display: 'flex', minHeight: '100vh', bgcolor: 'background.default' }}>
      <Sidebar />
      <Box
        component="main"
        sx={{
          flexGrow: 1,
          minWidth: 0,
          ml: { xs: 0, md: `${DRAWER_WIDTH}px` },
          minHeight: '100vh',
          display: 'flex',
          flexDirection: 'column',
        }}
      >
        <Navbar />
        <Toolbar /> {/* Spacer to push content below AppBar */}
        <Box sx={{ flex: 1, overflow: 'auto' }}>
          {children}
        </Box>
      </Box>
    </Box>
  );
}
