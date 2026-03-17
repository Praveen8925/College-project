import { motion } from 'framer-motion';
import { Box } from '@mui/material';

/**
 * PageWrapper - Wraps page content with fade-in animation
 * Use this component to wrap all page content for consistent animations
 */
const pageVariants = {
  initial: { opacity: 0, y: 20 },
  animate: { opacity: 1, y: 0 },
  exit: { opacity: 0, y: -10 },
};

const pageTransition = {
  type: 'tween',
  ease: 'easeOut',
  duration: 0.3,
};

export default function PageWrapper({ children, sx = {}, ...props }) {
  return (
    <Box
      component={motion.div}
      initial="initial"
      animate="animate"
      exit="exit"
      variants={pageVariants}
      transition={pageTransition}
      sx={{
        py: { xs: 1.5, sm: 2 },
        px: { xs: 1.5, sm: 2 },
        width: '100%',
        ...sx,
      }}
      {...props}
    >
      {children}
    </Box>
  );
}

/**
 * Staggered container for animating children one by one
 */
export const staggerContainer = {
  animate: {
    transition: {
      staggerChildren: 0.1,
    },
  },
};

/**
 * Fade up animation for cards/items
 */
export const fadeUpItem = {
  initial: { opacity: 0, y: 20 },
  animate: { opacity: 1, y: 0 },
};

/**
 * Scale animation for hover effects
 */
export const scaleOnHover = {
  whileHover: { scale: 1.02 },
  whileTap: { scale: 0.98 },
  transition: { type: 'spring', stiffness: 400, damping: 17 },
};
