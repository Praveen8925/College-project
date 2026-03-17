<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB();

$dept   = trim($_GET['dept']   ?? '');
$batch  = (int)($_GET['batch'] ?? 0);
$sem    = (int)($_GET['sem']   ?? 0);
$type   = trim($_GET['type']   ?? ''); // subject/all
$regno  = trim($_GET['regno']  ?? '');

if (!$dept || !$batch || !$sem)
    jsonResponse(['success'=>false,'message'=>'dept, batch, sem required.'], 400);

// Determine the attendance table name based on batch
$attTable = "{$batch}attendance";
// Check table exists
try {
    $db->query("SELECT 1 FROM `$attTable` LIMIT 1");
} catch(Exception $e) {
    jsonResponse(['success'=>false,'message'=>"No attendance data for batch $batch."], 404);
}

// Get students
$stuStmt = $db->prepare("SELECT RegNo, Name FROM student WHERE Department=? AND Batch=? ORDER BY Name");
$stuStmt->execute([$dept, $batch]);
$students = $stuStmt->fetchAll();

if (empty($students)) jsonResponse(['success'=>false,'message'=>'No students found.'], 404);

$regnos = array_column($students, 'RegNo');
$in     = implode(',', array_fill(0, count($regnos), '?'));

// Describe attendance table to get subject columns
$cols     = $db->query("DESCRIBE `$attTable`")->fetchAll(PDO::FETCH_COLUMN);
$skipCols = ['Batch','Sem','Regno','Name'];
$subjectCols = array_filter($cols, fn($c) => !in_array($c, $skipCols));

// Get attendance data for all students in this dept/batch/sem
$params = array_merge([$dept, $batch, $sem], $regnos);
$attStmt = $db->prepare("SELECT * FROM `$attTable` WHERE Department=? AND Batch=? AND sem=? AND Regno IN ($in)");
// Not all tables have Department — try without it
try {
    $attStmt = $db->prepare("SELECT * FROM `$attTable` WHERE Batch=? AND sem=? AND Regno IN ($in)");
    $attStmt->execute(array_merge([$batch, $sem], $regnos));
} catch(Exception $e) {
    jsonResponse(['success'=>false,'message'=>'Attendance query failed.'], 500);
}
$attRows = $attStmt->fetchAll();

// Build report: per student, per subject
$report = [];
foreach ($students as $stu) {
    $row = array_filter($attRows, fn($r) => $r['Regno'] === $stu['RegNo']);
    $row = array_values($row)[0] ?? null;
    $subjects = [];
    foreach ($subjectCols as $col) {
        if ($row) {
            $val = $row[$col] ?? '-';
            $subjects[$col] = $val;
        } else {
            $subjects[$col] = '-';
        }
    }
    $report[] = [
        'regno'    => $stu['RegNo'],
        'name'     => $stu['Name'],
        'subjects' => $subjects,
    ];
}

jsonResponse([
    'success'     => true,
    'report'      => $report,
    'subjectCols' => array_values($subjectCols),
    'students'    => $students,
]);
