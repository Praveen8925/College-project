<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB(); $method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $dept  = trim($_GET['dept']  ?? '');
    $batch = trim($_GET['batch'] ?? '');
    $where = []; $params = [];
    if ($dept)  { $where[] = 'Department=?'; $params[] = $dept; }
    if ($batch) { $where[] = 'Batch=?';       $params[] = $batch; }
    $clause = $where ? 'WHERE '.implode(' AND ',$where) : '';
    $stmt = $db->prepare("SELECT * FROM syllabus $clause ORDER BY Batch DESC, Department");
    $stmt->execute($params);
    $depts   = $db->query("SELECT DISTINCT Department FROM syllabus ORDER BY Department")->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query("SELECT DISTINCT Batch FROM syllabus ORDER BY Batch DESC")->fetchAll(PDO::FETCH_COLUMN);
    jsonResponse(['success'=>true,'data'=>$stmt->fetchAll(),'depts'=>$depts,'batches'=>$batches]);
}
jsonResponse(['success'=>false,'message'=>'Method not allowed.'],405);
