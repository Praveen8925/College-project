<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $batch = (int)trim($_GET['batch'] ?? 0);
    $dept  = trim($_GET['dept']  ?? '');
    $sem   = (int)trim($_GET['sem']   ?? 0);

    $sql    = 'SELECT * FROM subjectdetails WHERE 1=1';
    $params = [];
    if ($batch) { $sql .= ' AND Batch=?';         $params[] = $batch; }
    if ($dept)  { $sql .= ' AND Programme_Name=?'; $params[] = $dept;  }
    if ($sem)   { $sql .= ' AND sem=?';            $params[] = $sem;   }
    $sql .= ' ORDER BY sem, CourseID';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Also return distinct dept/batch lists for filters
    $depts   = $db->query("SELECT DISTINCT Programme_Name FROM subjectdetails ORDER BY Programme_Name")->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query("SELECT DISTINCT Batch FROM subjectdetails ORDER BY Batch DESC")->fetchAll(PDO::FETCH_COLUMN);

    jsonResponse(['success'=>true,'data'=>$rows,'depts'=>$depts,'batches'=>$batches]);
}

if ($method === 'POST') {
    $body = getRequestBody();

    // Finalize: set decided='y' for all subjects of a batch/dept/sem
    if (!empty($body['action']) && $body['action'] === 'finalize') {
        $batch = (int)($body['batch'] ?? 0);
        $dept  = trim($body['dept']  ?? '');
        $sem   = (int)($body['sem']  ?? 0);
        if (!$batch || !$dept || !$sem) {
            jsonResponse(['success'=>false,'message'=>'batch, dept and sem required.'], 400);
        }
        $stmt = $db->prepare(
            "UPDATE subjectdetails SET decided='y'
             WHERE Batch=? AND Programme_Name=? AND sem=?"
        );
        $stmt->execute([$batch, $dept, $sem]);
        jsonResponse(['success'=>true,'message'=>'Subjects finalized successfully.']);
    }

    // Unfinalize (reset)
    if (!empty($body['action']) && $body['action'] === 'unfinalize') {
        $batch = (int)($body['batch'] ?? 0);
        $dept  = trim($body['dept']  ?? '');
        $sem   = (int)($body['sem']  ?? 0);
        $stmt = $db->prepare(
            "UPDATE subjectdetails SET decided='n'
             WHERE Batch=? AND Programme_Name=? AND sem=?"
        );
        $stmt->execute([$batch, $dept, $sem]);
        jsonResponse(['success'=>true,'message'=>'Finalization reversed.']);
    }

    jsonResponse(['success'=>false,'message'=>'Unknown action.'], 400);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
