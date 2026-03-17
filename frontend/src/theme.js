import { createTheme } from '@mui/material/styles';

const theme = createTheme({
  palette: {
    primary: {
      main: '#4F46E5',       // Modern indigo
      light: '#818CF8',
      dark: '#3730A3',
      contrastText: '#FFFFFF',
    },
    secondary: {
      main: '#6B7280',       // Neutral gray
      light: '#9CA3AF',
      dark: '#4B5563',
      contrastText: '#FFFFFF',
    },
    background: {
      default: '#F9FAFB',
      paper: '#FFFFFF',
    },
    success: { main: '#10B981', light: '#D1FAE5', dark: '#059669' },
    warning: { main: '#F59E0B', light: '#FEF3C7', dark: '#D97706' },
    error:   { main: '#EF4444', light: '#FEE2E2', dark: '#DC2626' },
    info:    { main: '#3B82F6', light: '#DBEAFE', dark: '#2563EB' },
    text: {
      primary: '#111827',
      secondary: '#6B7280',
    },
    divider: '#E5E7EB',
  },
  typography: {
    fontFamily: '"Inter", "Roboto", "Helvetica", "Arial", sans-serif',
    h1: { fontWeight: 700, fontSize: '2rem', color: '#111827' },
    h2: { fontWeight: 700, fontSize: '1.75rem', color: '#111827' },
    h3: { fontWeight: 600, fontSize: '1.5rem', color: '#111827' },
    h4: { fontWeight: 600, fontSize: '1.5rem', color: '#111827' },
    h5: { fontWeight: 600, fontSize: '1.125rem', color: '#111827' },
    h6: { fontWeight: 600, fontSize: '1rem', color: '#111827' },
    body1: { fontSize: '0.875rem', color: '#374151' },
    body2: { fontSize: '0.8125rem', color: '#6B7280' },
    button: { textTransform: 'none', fontWeight: 500 },
  },
  shape: { borderRadius: 12 },
  shadows: [
    'none',
    '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
    '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)',
    '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)',
    '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1)',
    '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)',
    ...Array(19).fill('0 25px 50px -12px rgba(0, 0, 0, 0.25)'),
  ],
  components: {
    MuiButton: {
      styleOverrides: {
        root: {
          borderRadius: 10,
          padding: '10px 20px',
          fontWeight: 500,
          boxShadow: 'none',
          '&:hover': { boxShadow: 'none' },
        },
        contained: {
          '&:hover': { 
            transform: 'translateY(-1px)',
            boxShadow: '0 4px 12px rgba(79, 70, 229, 0.25)',
          },
        },
        outlined: {
          borderColor: '#E5E7EB',
          '&:hover': { 
            borderColor: '#4F46E5',
            backgroundColor: 'rgba(79, 70, 229, 0.04)',
          },
        },
      },
    },
    MuiCard: {
      styleOverrides: {
        root: {
          borderRadius: 12,
          boxShadow: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)',
          border: '1px solid #E5E7EB',
          transition: 'all 0.2s ease-in-out',
          '&:hover': {
            boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)',
          },
        },
      },
    },
    MuiPaper: {
      styleOverrides: {
        root: {
          backgroundImage: 'none',
        },
        elevation1: {
          boxShadow: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)',
        },
      },
    },
    MuiTextField: {
      styleOverrides: {
        root: {
          '& .MuiOutlinedInput-root': {
            borderRadius: 8,
            backgroundColor: '#FFFFFF',
            '& fieldset': { borderColor: '#E5E7EB' },
            '&:hover fieldset': { borderColor: '#D1D5DB' },
            '&.Mui-focused fieldset': { borderColor: '#4F46E5', borderWidth: '1.5px' },
          },
        },
      },
    },
    MuiOutlinedInput: {
      styleOverrides: {
        root: {
          borderRadius: 8,
          '& fieldset': { borderColor: '#E5E7EB' },
          '&:hover fieldset': { borderColor: '#D1D5DB' },
          '&.Mui-focused fieldset': { borderColor: '#4F46E5' },
        },
      },
    },
    MuiSelect: {
      styleOverrides: {
        root: { borderRadius: 8 },
      },
    },
    MuiDrawer: {
      styleOverrides: {
        paper: {
          backgroundColor: '#111827',
          color: '#fff',
          borderRight: 'none',
        },
      },
    },
    MuiChip: {
      styleOverrides: {
        root: { 
          borderRadius: 999, 
          fontWeight: 500,
          fontSize: '0.75rem',
        },
      },
    },
    MuiTableCell: {
      styleOverrides: {
        root: {
          borderBottom: '1px solid #F3F4F6',
          padding: '16px',
        },
        head: {
          backgroundColor: '#F9FAFB',
          fontWeight: 600,
          color: '#374151',
          fontSize: '0.75rem',
          textTransform: 'uppercase',
          letterSpacing: '0.05em',
        },
      },
    },
    MuiTableRow: {
      styleOverrides: {
        root: {
          '&:hover': { backgroundColor: '#F9FAFB' },
          '&:last-child td': { borderBottom: 0 },
        },
      },
    },
    MuiAlert: {
      styleOverrides: {
        root: { borderRadius: 10 },
        standardSuccess: { backgroundColor: '#D1FAE5', color: '#065F46' },
        standardError: { backgroundColor: '#FEE2E2', color: '#991B1B' },
        standardWarning: { backgroundColor: '#FEF3C7', color: '#92400E' },
        standardInfo: { backgroundColor: '#DBEAFE', color: '#1E40AF' },
      },
    },
    MuiDialog: {
      styleOverrides: {
        paper: { borderRadius: 16 },
      },
    },
    MuiTooltip: {
      styleOverrides: {
        tooltip: {
          backgroundColor: '#1F2937',
          fontSize: '0.75rem',
          borderRadius: 6,
        },
      },
    },
    MuiTab: {
      styleOverrides: {
        root: {
          textTransform: 'none',
          fontWeight: 500,
          minHeight: 48,
        },
      },
    },
    MuiTabs: {
      styleOverrides: {
        indicator: {
          height: 3,
          borderRadius: '3px 3px 0 0',
        },
      },
    },
  },
});

export default theme;
