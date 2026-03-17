<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$regno = trim($_GET['regno'] ?? '');
if (!$regno) jsonResponse(['success'=>false,'message'=>'regno required.'], 400);

try {
    // Get student info
    $stmt = $db->prepare("SELECT RegNo, Name, Batch, Department, status, `Email-id` AS Emailid FROM student WHERE RegNo=?");
    $stmt->execute([$regno]);
    $student = $stmt->fetch();
    if (!$student) jsonResponse(['success'=>false,'message'=>'Student not found.'], 404);

    $batch = (int)$student['Batch'];

    // Get attendance across all semesters from {batch}attendance table
    $attTable = $batch . 'attendance';
    $attendance = [];
    if ($db->query("SHOW TABLES LIKE '$attTable'")->fetchColumn()) {
        $aStmt = $db->prepare("SELECT sem, tot_working_days, no_day_present, decided FROM `$attTable` WHERE RegNo=? ORDER BY sem");
        $aStmt->execute([$regno]);
        $attendance = $aStmt->fetchAll();
    }

    // Get marks from {batch} table - all exam types stored in one table with exam_type column
    // exam_type values: 'cycletest1', 'cycletest2', 'modelexam'
    // mark is hyphen-separated values per subject
    $marksTable = (string)$batch;
    $ct1 = [];
    $ct2 = [];
    $model = [];
    
    if ($db->query("SHOW TABLES LIKE '$marksTable'")->fetchColumn()) {
        // CT1 marks
        $ct1Stmt = $db->prepare("SELECT sem, mark FROM `$marksTable` WHERE RegNo=? AND exam_type='cycletest1' ORDER BY sem");
        $ct1Stmt->execute([$regno]);
        $ct1 = $ct1Stmt->fetchAll();

        // CT2 marks
        $ct2Stmt = $db->prepare("SELECT sem, mark FROM `$marksTable` WHERE RegNo=? AND exam_type='cycletest2' ORDER BY sem");
        $ct2Stmt->execute([$regno]);
        $ct2 = $ct2Stmt->fetchAll();

        // Model exam marks
        $modelStmt = $db->prepare("SELECT sem, mark FROM `$marksTable` WHERE RegNo=? AND exam_type='modelexam' ORDER BY sem");
        $modelStmt->execute([$regno]);
        $model = $modelStmt->fetchAll();
    }

    // Get Assignment marks from {batch}studassignmentmark table
    $assTable = $batch . 'studassignmentmark';
    $assignments = [];
    if ($db->query("SHOW TABLES LIKE '$assTable'")->fetchColumn()) {
        $assStmt = $db->prepare("SELECT semester AS sem, Course, number, mark FROM `$assTable` WHERE Regno=? ORDER BY semester, Course, number");
        $assStmt->execute([$regno]);
        $assignments = $assStmt->fetchAll();
    }

    // Parse marks - they're stored as hyphen-separated values per subject
    // e.g., "23-25-20-24" means 4 subjects with those marks
    $parseMarks = function($row) {
        if (!$row || !isset($row['mark']) || !$row['mark']) return null;
        $parts = array_map('trim', explode('-', $row['mark']));
        $parts = array_filter($parts, fn($v) => $v !== '' && $v !== 'AB'); // Exclude absent marks
        $numericParts = array_filter($parts, 'is_numeric');
        $total = array_sum(array_map('floatval', $numericParts));
        return [
            'parts' => array_values($parts),
            'total' => $total,
            'avg'   => count($numericParts) > 0 ? round($total / count($numericParts), 1) : 0,
        ];
    };

    // Organize marks by semester
    $semesters = [];
    for ($s = 1; $s <= 8; $s++) {
        $attRow = array_values(array_filter($attendance, fn($r) => (int)$r['sem'] === $s));
        $ct1Row = array_values(array_filter($ct1, fn($r) => (int)$r['sem'] === $s));
        $ct2Row = array_values(array_filter($ct2, fn($r) => (int)$r['sem'] === $s));
        $modRow = array_values(array_filter($model, fn($r) => (int)$r['sem'] === $s));
        $assRows = array_values(array_filter($assignments, fn($r) => (int)$r['sem'] === $s));

        $hasData = !empty($attRow) || !empty($ct1Row) || !empty($ct2Row) || !empty($modRow) || !empty($assRows);
        if (!$hasData) continue;

        $att = $attRow[0] ?? null;
        $attPct = ($att && (int)$att['tot_working_days'] > 0)
            ? round(((int)$att['no_day_present'] / (int)$att['tot_working_days']) * 100, 1)
            : null;

        // Group assignment marks by course
        $assMarks = null;
        if (!empty($assRows)) {
            $totalAssMark = 0;
            $assCount = 0;
            foreach ($assRows as $ass) {
                $totalAssMark += (int)($ass['mark'] ?? 0);
                $assCount++;
            }
            $assMarks = [
                'total' => $totalAssMark,
                'count' => $assCount,
                'avg'   => $assCount > 0 ? round($totalAssMark / $assCount, 1) : 0,
            ];
        }

        $semesters[] = [
            'sem'        => $s,
            'attendance' => $att ? [
                'total'   => (int)$att['tot_working_days'],
                'present' => (int)$att['no_day_present'],
                'pct'     => $attPct,
            ] : null,
            'ct1'        => $parseMarks($ct1Row[0] ?? null),
            'ct2'        => $parseMarks($ct2Row[0] ?? null),
            'model'      => $parseMarks($modRow[0] ?? null),
            'assignment' => $assMarks,
        ];
    }

    // Calculate overall stats
    $totalPresent = array_sum(array_map(fn($a) => (int)($a['no_day_present'] ?? 0), $attendance));
    $totalDays    = array_sum(array_map(fn($a) => (int)($a['tot_working_days'] ?? 0), $attendance));
    $overallAtt   = $totalDays > 0 ? round(($totalPresent / $totalDays) * 100, 1) : null;

    jsonResponse([
        'success'   => true,
        'student'   => $student,
        'semesters' => $semesters,
        'overall'   => [
            'attendance' => [
                'total'   => $totalDays,
                'present' => $totalPresent,
                'pct'     => $overallAtt,
            ],
        ],
    ]);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
}
