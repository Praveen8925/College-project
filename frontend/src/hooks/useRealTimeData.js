import { useState, useEffect, useCallback, useRef } from 'react';

/**
 * Real-time data hook with auto-refresh and live updates
 * @param {Function} fetchFn - API function to call
 * @param {Object} options - Configuration options
 * @returns {Object} - { data, loading, error, lastUpdate, refresh, toggleAutoRefresh }
 */
export function useRealTimeData(fetchFn, options = {}) {
  const {
    refreshInterval = 30000, // 30 seconds default
    autoRefresh = true,
    dependencies = [],
    onDataUpdate = null,
  } = options;

  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [lastUpdate, setLastUpdate] = useState(null);
  const [isAutoRefreshing, setIsAutoRefreshing] = useState(autoRefresh);
  
  const intervalRef = useRef(null);
  const isMountedRef = useRef(true);

  const fetchData = useCallback(async (showLoading = false) => {
    if (showLoading) setLoading(true);
    setError('');
    
    try {
      const result = await fetchFn();
      
      if (isMountedRef.current) {
        if (result.data?.success) {
          const newData = result.data;
          setData(newData);
          setLastUpdate(new Date());
          
          // Call optional data update callback
          if (onDataUpdate && data) {
            onDataUpdate(newData, data);
          }
        } else {
          setError(result.data?.message || 'Failed to load data');
        }
      }
    } catch (err) {
      if (isMountedRef.current) {
        setError('Could not reach server. Check your connection.');
      }
    } finally {
      if (isMountedRef.current && showLoading) {
        setLoading(false);
      }
    }
  }, [fetchFn, onDataUpdate, data]);

  // Manual refresh function
  const refresh = useCallback(() => {
    fetchData(true);
  }, [fetchData]);

  // Toggle auto-refresh
  const toggleAutoRefresh = useCallback(() => {
    setIsAutoRefreshing(prev => !prev);
  }, []);

  // Setup auto-refresh interval
  useEffect(() => {
    if (isAutoRefreshing && refreshInterval > 0) {
      intervalRef.current = setInterval(() => {
        fetchData(false); // Don't show loading for auto-refresh
      }, refreshInterval);
    }

    return () => {
      if (intervalRef.current) {
        clearInterval(intervalRef.current);
        intervalRef.current = null;
      }
    };
  }, [isAutoRefreshing, refreshInterval, fetchData]);

  // Initial data fetch and dependency changes
  useEffect(() => {
    isMountedRef.current = true;
    fetchData(true);

    return () => {
      isMountedRef.current = false;
    };
  }, dependencies);

  // Cleanup on unmount
  useEffect(() => {
    return () => {
      isMountedRef.current = false;
      if (intervalRef.current) {
        clearInterval(intervalRef.current);
      }
    };
  }, []);

  return {
    data,
    loading,
    error,
    lastUpdate,
    isAutoRefreshing,
    refresh,
    toggleAutoRefresh,
  };
}

/**
 * Real-time notification hook for new data alerts
 */
export function useRealTimeNotifications() {
  const [notifications, setNotifications] = useState([]);

  const addNotification = useCallback((notification) => {
    const newNotification = {
      id: Date.now(),
      timestamp: new Date(),
      ...notification,
    };
    
    setNotifications(prev => [newNotification, ...prev.slice(0, 9)]); // Keep last 10
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
      setNotifications(prev => prev.filter(n => n.id !== newNotification.id));
    }, 5000);
  }, []);

  const removeNotification = useCallback((id) => {
    setNotifications(prev => prev.filter(n => n.id !== id));
  }, []);

  const clearNotifications = useCallback(() => {
    setNotifications([]);
  }, []);

  return {
    notifications,
    addNotification,
    removeNotification,
    clearNotifications,
  };
}
