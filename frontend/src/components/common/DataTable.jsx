import { 
  Box, Table, TableBody, TableCell, TableContainer, 
  TableHead, TableRow, Paper, Typography 
} from '@mui/material';
import { motion } from 'framer-motion';

/**
 * Modern data table wrapper with consistent styling
 */
export default function DataTable({ 
  columns, 
  data, 
  emptyMessage = 'No data available',
  stickyHeader = false,
  maxHeight,
}) {
  return (
    <TableContainer 
      component={Paper}
      elevation={0}
      sx={{ 
        border: '1px solid',
        borderColor: 'divider',
        borderRadius: 3,
        maxHeight: maxHeight,
        '& .MuiTableCell-root': {
          borderColor: '#F3F4F6',
        },
      }}
    >
      <Table stickyHeader={stickyHeader} size="medium">
        <TableHead>
          <TableRow>
            {columns.map((col, idx) => (
              <TableCell 
                key={idx}
                align={col.align || 'left'}
                sx={{ 
                  bgcolor: '#F9FAFB',
                  fontWeight: 600,
                  color: '#374151',
                  fontSize: '0.75rem',
                  textTransform: 'uppercase',
                  letterSpacing: '0.05em',
                  py: 1.5,
                  whiteSpace: 'nowrap',
                  ...(col.width && { width: col.width }),
                }}
              >
                {col.label}
              </TableCell>
            ))}
          </TableRow>
        </TableHead>
        <TableBody>
          {data.length === 0 ? (
            <TableRow>
              <TableCell colSpan={columns.length} align="center" sx={{ py: 4 }}>
                <Typography variant="body2" color="text.secondary">
                  {emptyMessage}
                </Typography>
              </TableCell>
            </TableRow>
          ) : (
            data.map((row, rowIdx) => (
              <TableRow
                key={rowIdx}
                component={motion.tr}
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                transition={{ delay: rowIdx * 0.03, duration: 0.2 }}
                sx={{
                  '&:hover': { bgcolor: '#F9FAFB' },
                  '&:last-child td': { borderBottom: 0 },
                }}
              >
                {columns.map((col, colIdx) => (
                  <TableCell 
                    key={colIdx} 
                    align={col.align || 'left'}
                    sx={{ 
                      py: 2,
                      fontSize: '0.875rem',
                    }}
                  >
                    {col.render ? col.render(row) : row[col.field]}
                  </TableCell>
                ))}
              </TableRow>
            ))
          )}
        </TableBody>
      </Table>
    </TableContainer>
  );
}
