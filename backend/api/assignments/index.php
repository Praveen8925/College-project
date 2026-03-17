<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

function assignmentTable(PDO $db, int $batch): string {
    $table  = $batch . 'assignment';
    $exists = $db->query("SHOW TABLES LIKE '$table'")->fetchColumn();
    if (!$exists) {
        $rows = $db->query("SHOW TABLES LIKE '%assignment'")->fetchAll(PDO::FETCH_NUM);
        if (empty($rows)) throw new Exception('No assignment table found.');
        $table = end($rows)[0];
    }
    return $table;
}

if ($method === 'GET') {
    $batch = (int)($_GET['batch'] ?? 0);
    $sem   = (int)($_GET['sem']   ?? 0);
    if (!$batch || !$sem) jsonResponse(['success'=>false,'message'=>'Batch and sem required.'], 400);
    try {
        $table = assignmentTable($db, $batch);
        $stmt  = $db->prepare("SELECT a.*, s.Name FROM `$table` a
                               LEFT JOIN student s ON a.RegNo=s.Regno
                               WHERE a.Batch=? AND a.sem=?
                               ORDER BY s.Name");
        $stmt->execute([$batch, $sem]);
        jsonResponse(['success'=>true,'data'=>$stmt->fetchAll(),'table'=>$table]);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

// POST — set assignment mark for a student
if ($method === 'POST') {
    $body   = getRequestBody();
    $batch  = (int)($body['batch']   ?? 0);
    $sem    = (int)($body['sem']     ?? 0);
    $regno  = trim($body['RegNo']    ?? '');
    $mark   = trim($body['ass_mark'] ?? '');
    if (!$batch || !$sem || !$regno)
        jsonResponse(['success'=>false,'message'=>'batch, sem and RegNo required.'], 400);
    try {
        $table = assignmentTable($db, $batch);
        $chk   = $db->prepare("SELECT RegNo FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
        $chk->execute([$batch, $sem, $regno]);
        if ($chk->fetch()) {
            $db->prepare("UPDATE `$table` SET ass_mark=?, decided='Y' WHERE Batch=? AND sem=? AND RegNo=?")
               ->execute([$mark, $batch, $sem, $regno]);
        } else {
            $db->prepare("INSERT INTO `$table` (Batch,sem,RegNo,ass_mark,decided) VALUES (?,?,?,?,'Y')")
               ->execute([$batch, $sem, $regno, $mark]);
        }
        jsonResponse(['success'=>true,'message'=>'Assignment mark saved.']);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
