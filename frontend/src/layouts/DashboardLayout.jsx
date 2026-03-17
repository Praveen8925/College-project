import { Box, Toolbar } from '@mui/material';
import Sidebar, { DRAWER_WIDTH } from '../components/common/Sidebar';
import Navbar from '../components/common/Navbar';

/**
 * Shared layout for all authenticated dashboards.
 * Wraps page content with Sidebar + Navbar.
 */
export default function DashboardLayout({ children }) {
  return (
    <Box sx={{ display: 'flex', minHeight: '100vh', bgcolor: 'background.default' }}>
      <Sidebar />
      <Box
        component="main"
        sx={{
          flexGrow: 1,
          ml: `${DRAWER_WIDTH}px`,
          minHeight: '100vh',
          display: 'flex',
          flexDirection: 'column',
        }}
      >
        <Navbar />
        <Toolbar /> {/* Spacer to push content below AppBar */}
        <Box sx={{ flex: 1, p: 0 }}>
          {children}
        </Box>
      </Box>
    </Box>
  );
}
