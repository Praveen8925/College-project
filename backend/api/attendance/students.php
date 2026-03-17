<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$batch = (int)($_GET['batch'] ?? 0);
$sem   = (int)($_GET['sem']   ?? 0);
$dept  = trim($_GET['dept']   ?? '');

if (!$batch || !$sem) jsonResponse(['success'=>false,'message'=>'Batch and semester required.'], 400);

// Get students for the batch/sem
$sql    = 'SELECT RegNo, Name, Department AS Dept, Gender FROM student WHERE Batch=? AND sem=?';
$params = [$batch, $sem];
if ($dept) { $sql .= ' AND Department=?'; $params[] = $dept; }
$sql .= ' ORDER BY Name';

$stmt = $db->prepare($sql);
$stmt->execute($params);
$students = $stmt->fetchAll();

// Attempt to also fetch their current attendance from the year table
function getAttendanceTable(PDO $db, int $batch): ?string {
    $table  = $batch . 'attendance';
    $exists = $db->query("SHOW TABLES LIKE '$table'")->fetchColumn();
    if (!$exists) {
        $rows = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM);
        return empty($rows) ? null : end($rows)[0];
    }
    return $table;
}

$attendance = [];
$table = getAttendanceTable($db, $batch);
if ($table) {
    $aStmt = $db->prepare("SELECT RegNo, tot_working_days, no_day_present FROM `$table` WHERE Batch=? AND sem=?");
    $aStmt->execute([$batch, $sem]);
    foreach ($aStmt->fetchAll() as $row) {
        $attendance[$row['RegNo']] = $row;
    }
}

// Merge attendance into student records
foreach ($students as &$s) {
    $att = $attendance[$s['RegNo']] ?? null;
    $s['tot_working_days'] = $att ? (int)$att['tot_working_days'] : 0;
    $s['no_day_present']   = $att ? (int)$att['no_day_present']   : 0;
    $s['pct'] = $s['tot_working_days'] > 0
        ? round(($s['no_day_present'] / $s['tot_working_days']) * 100, 1) : 0;
}
unset($s);

// Depts for filter dropdown
$depts = $db->query('SELECT DISTINCT Department FROM student ORDER BY Department')->fetchAll(PDO::FETCH_COLUMN);

jsonResponse(['success'=>true,'data'=>$students,'depts'=>$depts,'table'=>$table]);
