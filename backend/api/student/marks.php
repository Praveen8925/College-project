<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$regno = trim($_GET['regno'] ?? '');
$batch = (int)($_GET['batch'] ?? 0);
$sem   = (int)($_GET['sem']   ?? 0);
if (!$regno || !$batch || !$sem) jsonResponse(['success'=>false,'message'=>'regno, batch and sem required.'], 400);

function getMarkFrom(PDO $db, string $table, string $regno, int $batch, int $sem): array {
    try {
        $cols    = $db->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_COLUMN);
        $markCol = in_array('Mark',$cols)?'Mark':(in_array('mark',$cols)?'mark':null);
        if (!$markCol) return ['mark'=>null,'max'=>null,'found'=>false];

        $stmt = $db->prepare("SELECT `$markCol` FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
        $stmt->execute([$batch, $sem, $regno]);
        $row = $stmt->fetch();
        return ['mark'=> $row ? $row[$markCol] : null, 'found'=> (bool)$row];
    } catch (Exception $e) {
        return ['mark'=>null,'found'=>false,'error'=>$e->getMessage()];
    }
}

$ct1   = getMarkFrom($db, 'cycletest_1', $regno, $batch, $sem);
$ct2   = getMarkFrom($db, 'cycletest_2', $regno, $batch, $sem);
$model = getMarkFrom($db, 'modelexam',   $regno, $batch, $sem);

// Also try assignment mark
$assignTable = $batch.'assignment';
$assignExists = $db->query("SHOW TABLES LIKE '$assignTable'")->fetchColumn();
$assignMark = null;
if ($assignExists) {
    try {
        $aStmt = $db->prepare("SELECT ass_mark FROM `$assignTable` WHERE Batch=? AND sem=? AND RegNo=?");
        $aStmt->execute([$batch,$sem,$regno]);
        $aRow = $aStmt->fetch();
        $assignMark = $aRow ? $aRow['ass_mark'] : null;
    } catch (Exception $e) {}
}

jsonResponse([
    'success'     => true,
    'regno'       => $regno,
    'batch'       => $batch,
    'sem'         => $sem,
    'CT1'         => array_merge($ct1,  ['max'=>25, 'label'=>'Cycle Test 1']),
    'CT2'         => array_merge($ct2,  ['max'=>25, 'label'=>'Cycle Test 2']),
    'Model'       => array_merge($model,['max'=>50, 'label'=>'Model Exam']),
    'Assignment'  => ['mark'=>$assignMark,'max'=>25,'label'=>'Assignment','found'=>$assignMark!==null],
]);
