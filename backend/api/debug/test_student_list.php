<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
try {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM student WHERE 1=1 ORDER BY Name ASC');
    $stmt->execute([]);
    $r = $stmt->fetchAll();
    $depts = $db->query('SELECT DISTINCT Department FROM student ORDER BY Department')->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query('SELECT DISTINCT Batch FROM student ORDER BY Batch DESC')->fetchAll(PDO::FETCH_COLUMN);
    jsonResponse(['ok'=>true,'students'=>count($r),'depts'=>$depts,'batches'=>$batches]);
} catch (Exception $e) {
    jsonResponse(['ok'=>false,'error'=>$e->getMessage()]);
}
