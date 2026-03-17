<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$regno = trim($_GET['regno'] ?? '');
$batch = (int)($_GET['batch'] ?? 0);
$sem   = (int)($_GET['sem']   ?? 0);
if (!$regno || !$batch || !$sem) jsonResponse(['success'=>false,'message'=>'regno, batch and sem required.'], 400);

function resolveAttTable2(PDO $db, int $batch): ?string {
    $t = $batch.'attendance';
    if ($db->query("SHOW TABLES LIKE '$t'")->fetchColumn()) return $t;
    $rows = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM);
    return empty($rows) ? null : end($rows)[0];
}

$table = resolveAttTable2($db, $batch);
if (!$table) jsonResponse(['success'=>false,'message'=>'No attendance data found for your batch.'], 404);

try {
    $stmt = $db->prepare("SELECT tot_working_days, no_day_present FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
    $stmt->execute([$batch, $sem, $regno]);
    $row = $stmt->fetch();

    $total   = (int)($row['tot_working_days'] ?? 0);
    $present = (int)($row['no_day_present']   ?? 0);
    $absent  = max(0, $total - $present);
    $pct     = $total > 0 ? round(($present/$total)*100, 1) : 0;

    jsonResponse([
        'success'   => true,
        'table'     => $table,
        'total'     => $total,
        'present'   => $present,
        'absent'    => $absent,
        'pct'       => $pct,
        'status'    => $pct >= 75 ? 'safe' : ($pct >= 60 ? 'warning' : 'danger'),
    ]);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
}
