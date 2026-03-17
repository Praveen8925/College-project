<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$regno = trim($_GET['regno'] ?? '');
$batch = (int)($_GET['batch'] ?? 0);
$sem   = (int)($_GET['sem']   ?? 0);
if (!$regno || !$batch || !$sem)
    jsonResponse(['success'=>false,'message'=>'regno, batch and sem required.'], 400);

// Resolve assignment table dynamically
$table = $batch . 'assignment';
if (!$db->query("SHOW TABLES LIKE '$table'")->fetchColumn()) {
    $rows  = $db->query("SHOW TABLES LIKE '%assignment'")->fetchAll(PDO::FETCH_NUM);
    $table = !empty($rows) ? end($rows)[0] : null;
}
if (!$table) jsonResponse(['success'=>false,'message'=>'No assignment table found for your batch.'], 404);

try {
    $stmt = $db->prepare("SELECT * FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
    $stmt->execute([$batch, $sem, $regno]);
    $row = $stmt->fetch();

    // Parse ass_mark: "04-04-03-02" → array of individual marks + total
    $markData = null;
    if ($row && isset($row['ass_mark']) && $row['ass_mark'] !== '') {
        $parts = array_map('trim', explode('-', $row['ass_mark']));
        $parts = array_filter($parts, fn($v) => $v !== '');
        $total = array_sum(array_map('floatval', $parts));
        $markData = [
            'parts'   => array_values($parts),
            'total'   => $total,
            'decided' => $row['decided'] ?? 'n',
        ];
    }

    // Also fetch all assignment questions / descriptions for this sem if table has them
    $qTable = $batch . 'assignmentquestion';
    $questions = [];
    if ($db->query("SHOW TABLES LIKE '$qTable'")->fetchColumn()) {
        try {
            $qStmt = $db->prepare("SELECT * FROM `$qTable` WHERE Batch=? AND sem=?");
            $qStmt->execute([$batch, $sem]);
            $questions = $qStmt->fetchAll();
        } catch (Exception $e) {}
    }

    jsonResponse([
        'success'    => true,
        'batch'      => $batch,
        'sem'        => $sem,
        'regno'      => $regno,
        'data'       => $row ?: null,
        'markData'   => $markData,
        'questions'  => $questions,
        'ass_mark'   => $row ? ($row['ass_mark'] ?? null) : null,
        'decided'    => $row ? ($row['decided']   ?? 'n') : 'n',
    ]);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
}
