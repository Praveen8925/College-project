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

$students   = (int)$safe('SELECT COUNT(*) FROM student');
$staff      = (int)$safe('SELECT COUNT(*) FROM addstaff');
$events     = (int)$safe('SELECT COUNT(*) FROM events');
$complaints = (int)$safe("SELECT COUNT(*) FROM complaint WHERE Status != 'Resolved'");

$eventsData     = $safeAll('SELECT EventID, EventsMsg FROM events ORDER BY EventID DESC LIMIT 5');
$complaintsData = $safeAll("SELECT Complaint_ID, Type, Description, Status, Date FROM complaint ORDER BY Date DESC LIMIT 5");

jsonResponse([
    'success' => true,
    'stats'   => [
        'students'   => $students,
        'staff'      => $staff,
        'events'     => $events,
        'complaints' => $complaints,
    ],
    'recentEvents'     => $eventsData,
    'recentComplaints' => $complaintsData,
]);
