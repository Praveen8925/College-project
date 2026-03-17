<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db = getDB();

$safe = function($query, $default = 0) use ($db) {
    try { return $db->query($query)->fetchColumn(); }
    catch (Exception $e) { return $default; }
};
$safeAll = function($query) use ($db) {
    try { return $db->query($query)->fetchAll(); }
    catch (Exception $e) { return []; }
};

// Basic stats
$students   = (int)$safe('SELECT COUNT(*) FROM student');
$staff      = (int)$safe('SELECT COUNT(*) FROM addstaff');
$events     = (int)$safe('SELECT COUNT(*) FROM events');
$complaints = (int)$safe("SELECT COUNT(*) FROM complaint WHERE Status != 'Resolved'");

// Enhanced analytics data
$departmentStats = $safeAll("SELECT Department, COUNT(*) as count FROM student GROUP BY Department ORDER BY count DESC");
$batchStats = $safeAll("SELECT Batch, COUNT(*) as count FROM student GROUP BY Batch ORDER BY Batch DESC");
$staffDeptStats = $safeAll("SELECT Department, COUNT(*) as count FROM addstaff GROUP BY Department ORDER BY count DESC");

// Attendance trend data (last 30 days for active batches)
$attendanceTrends = [];
try {
    $attendanceTables = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($attendanceTables as $table) {
        if (strpos($table, 'year') === false) { // Skip yearattendance tables
            $year = preg_replace('/[^0-9]/', '', $table);
            if ($year && $year >= 2020) { // Only recent years
                $records = (int)$safe("SELECT COUNT(*) FROM $table");
                if ($records > 0) {
                    $attendanceTrends[] = ['batch' => $year, 'records' => $records];
                }
            }
        }
    }
} catch (Exception $e) {}

// Marks distribution
$marksStats = [];
try {
    foreach (['cycletest_1', 'cycletest_2', 'modelexam'] as $examType) {
        $examData = $safeAll("SELECT Mark FROM $examType WHERE Mark IS NOT NULL AND Mark != ''");
        $distribution = ['0-40' => 0, '41-50' => 0, '51-60' => 0, '61-75' => 0, '76-100' => 0];
        
        foreach ($examData as $row) {
            $mark = (float)$row['Mark'];
            if ($mark <= 40) $distribution['0-40']++;
            elseif ($mark <= 50) $distribution['41-50']++;
            elseif ($mark <= 60) $distribution['51-60']++;
            elseif ($mark <= 75) $distribution['61-75']++;
            else $distribution['76-100']++;
        }
        
        $marksStats[$examType] = $distribution;
    }
} catch (Exception $e) {}

// Complaint trends by type
$complaintTrends = $safeAll("SELECT Type, Status, COUNT(*) as count FROM complaint GROUP BY Type, Status ORDER BY Type");

// Recent activity
$eventsData     = $safeAll('SELECT EventID, EventsMsg, Date FROM events ORDER BY EventID DESC LIMIT 5');
$complaintsData = $safeAll("SELECT Complaint_ID, Type, Description, Status, Date FROM complaint ORDER BY Date DESC LIMIT 5");

// Notes activity
$notesActivity = $safeAll("SELECT Subject, COUNT(*) as count FROM notes GROUP BY Subject ORDER BY count DESC LIMIT 5");

// Last update timestamp for real-time features
$lastUpdate = date('Y-m-d H:i:s');

jsonResponse([
    'success' => true,
    'lastUpdate' => $lastUpdate,
    'stats'   => [
        'students'   => $students,
        'staff'      => $staff,
        'events'     => $events,
        'complaints' => $complaints,
    ],
    'analytics' => [
        'departmentStats' => $departmentStats,
        'batchStats' => $batchStats,
        'staffDeptStats' => $staffDeptStats,
        'attendanceTrends' => $attendanceTrends,
        'marksDistribution' => $marksStats,
        'complaintTrends' => $complaintTrends,
        'notesActivity' => $notesActivity,
    ],
    'recentEvents'     => $eventsData,
    'recentComplaints' => $complaintsData,
]);
