<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db    = getDB();
$batch = intval($_GET['batch'] ?? 0);
$sem   = intval($_GET['sem']   ?? 0);
if (!$batch) jsonResponse(['success'=>false,'message'=>'Batch required.'], 400);

// Resolve attendance table
$attTable = null;
$t = $batch.'attendance';
if ($db->query("SHOW TABLES LIKE '$t'")->fetchColumn()) $attTable = $t;
else {
    $all = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM);
    if ($all) $attTable = end($all)[0];
}
if (!$attTable) jsonResponse(['success'=>false,'message'=>'No attendance table found.'], 404);

// Query condition
$where  = "WHERE s.Batch=?";
$params = [$batch];
if ($sem) { $where .= " AND a.sem=?"; $params[] = $sem; }

try {
    $stmt = $db->prepare("
        SELECT s.RegNo, s.Name, s.Department,
               a.sem,
               COALESCE(a.tot_working_days,0) as total_days,
               COALESCE(a.no_day_present,0)   as present_days,
               CASE WHEN COALESCE(a.tot_working_days,0)>0
                    THEN ROUND((a.no_day_present/a.tot_working_days)*100,1)
                    ELSE 0 END as pct
        FROM student s
        LEFT JOIN `$attTable` a ON a.RegNo=s.RegNo AND a.Batch=s.Batch
        $where
        ORDER BY pct ASC, s.Name ASC
    ");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    // Aggregate stats
    $safe = count(array_filter($rows, fn($r) => $r['pct'] >= 75));
    $warn = count(array_filter($rows, fn($r) => $r['pct'] >= 60 && $r['pct'] < 75));
    $risk = count(array_filter($rows, fn($r) => $r['pct'] < 60));
    $avg  = count($rows) > 0 ? round(array_sum(array_column($rows,'pct'))/count($rows),1) : 0;

    jsonResponse([
        'success'   => true,
        'table'     => $attTable,
        'batch'     => $batch,
        'sem'       => $sem,
        'students'  => $rows,
        'summary'   => ['total'=>count($rows),'safe'=>$safe,'warning'=>$warn,'risk'=>$risk,'avg_pct'=>$avg],
    ]);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
}
