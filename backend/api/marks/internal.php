<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// Map test type to table
$tableMap = ['CT1'=>'cycletest_1', 'CT2'=>'cycletest_2', 'Model'=>'modelexam'];

if ($method === 'GET') {
    $batch    = (int)($_GET['batch']    ?? 0);
    $sem      = (int)($_GET['sem']      ?? 0);
    $testType = trim($_GET['testType']  ?? 'CT1');
    if (!$batch || !$sem) jsonResponse(['success'=>false,'message'=>'Batch and sem required.'], 400);

    $table = $tableMap[$testType] ?? 'cycletest_1';
    try {
        // Get students
        $sStmt = $db->prepare('SELECT Regno, Name FROM student WHERE Batch=? AND sem=? ORDER BY Name');
        $sStmt->execute([$batch, $sem]);
        $students = $sStmt->fetchAll();

        // Get existing marks
        $mStmt = $db->prepare("SELECT * FROM `$table` WHERE Batch=? AND sem=?");
        $mStmt->execute([$batch, $sem]);
        $marksRaw = $mStmt->fetchAll();

        // Index marks by RegNo+SubjectCode
        $marks = [];
        foreach ($marksRaw as $m) {
            $marks[$m['RegNo'] ?? ''] = $m;
        }

        jsonResponse(['success'=>true,'students'=>$students,'marks'=>$marks,'table'=>$table]);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

// POST — save marks for a student
if ($method === 'POST') {
    $body     = getRequestBody();
    $batch    = (int)($body['batch']    ?? 0);
    $sem      = (int)($body['sem']      ?? 0);
    $regno    = trim($body['RegNo']     ?? '');
    $testType = trim($body['testType']  ?? 'CT1');
    $mark     = trim($body['mark']      ?? '0');

    if (!$batch || !$sem || !$regno)
        jsonResponse(['success'=>false,'message'=>'batch, sem, RegNo required.'], 400);

    $table = $tableMap[$testType] ?? 'cycletest_1';
    try {
        $chk = $db->prepare("SELECT RegNo FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
        $chk->execute([$batch, $sem, $regno]);
        if ($chk->fetch()) {
            // Update — set mark column generically; cycletest_1 stores mark in 'Mark' or similar column
            // We try common column patterns
            $cols  = $db->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_COLUMN);
            $markCol = in_array('Mark', $cols) ? 'Mark' : (in_array('mark', $cols) ? 'mark' : 'decided');
            $db->prepare("UPDATE `$table` SET `$markCol`=? WHERE Batch=? AND sem=? AND RegNo=?")
               ->execute([$mark, $batch, $sem, $regno]);
        } else {
            $cols    = $db->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_COLUMN);
            $markCol = in_array('Mark', $cols) ? 'Mark' : (in_array('mark', $cols) ? 'mark' : 'decided');
            $db->prepare("INSERT INTO `$table` (Batch,sem,RegNo,`$markCol`) VALUES (?,?,?,?)")
               ->execute([$batch, $sem, $regno, $mark]);
        }
        jsonResponse(['success'=>true,'message'=>'Mark saved.']);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
