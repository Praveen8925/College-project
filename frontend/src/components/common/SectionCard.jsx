import { Box, Card, CardContent, Typography, Divider } from '@mui/material';
import { motion } from 'framer-motion';

/**
 * Section card with optional title and actions
 * Used to wrap tables, charts, or any content section
 */
export default function SectionCard({ 
  title, 
  subtitle,
  actions, 
  children, 
  noPadding = false,
  sx = {},
  ...props 
}) {
  return (
    <Card
      component={motion.div}
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.3 }}
      sx={{ 
        height: '100%',
        ...sx,
      }}
      {...props}
    >
      {(title || actions) && (
        <>
          <Box sx={{ 
            px: 3, 
            py: 2, 
            display: 'flex', 
            alignItems: 'center', 
            justifyContent: 'space-between',
            flexWrap: 'wrap',
            gap: 1,
          }}>
            <Box>
              {title && (
                <Typography variant="h6" fontWeight={600} color="text.primary">
                  {title}
                </Typography>
              )}
              {subtitle && (
                <Typography variant="body2" color="text.secondary" sx={{ mt: 0.25 }}>
                  {subtitle}
                </Typography>
              )}
            </Box>
            {actions && <Box sx={{ display: 'flex', gap: 1 }}>{actions}</Box>}
          </Box>
          <Divider />
        </>
      )}
      {noPadding ? children : (
        <CardContent sx={{ p: 3, '&:last-child': { pb: 3 } }}>
          {children}
        </CardContent>
      )}
    </Card>
  );
}
