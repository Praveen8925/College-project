<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $batch = trim($_GET['batch'] ?? '');
    $dept  = trim($_GET['dept']  ?? '');
    $regno = trim($_GET['regno'] ?? '');

    $sql    = 'SELECT * FROM complaint WHERE 1=1';
    $params = [];
    if ($batch) { $sql .= ' AND Batch=?';      $params[] = $batch; }
    if ($dept)  { $sql .= ' AND Department=?'; $params[] = $dept;  }
    // Also show complaints submitted by this student (if regno in Description or Complaint_To field — legacy workaround)
    $sql .= ' ORDER BY Date DESC';

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        jsonResponse(['success'=>true,'data'=>$stmt->fetchAll()]);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

if ($method === 'POST') {
    $body = getRequestBody();
    $required = ['Batch','Department','Type','Description','Date'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"Field '$f' is required."], 400);
    }

    // Generate Complaint_ID
    $year = date('Y');
    try {
        $cnt  = $db->query("SELECT COUNT(*)+1 FROM complaint WHERE YEAR(Date)=YEAR(CURDATE())")->fetchColumn();
        $cid  = 'CMP' . $year . str_pad($cnt, 4, '0', STR_PAD_LEFT);
    } catch (Exception $e) {
        $cid = 'CMP' . $year . rand(1000,9999);
    }

    try {
        $stmt = $db->prepare('INSERT INTO complaint
            (Complaint_ID, Batch, Department, Type, Complaint_To, Description, class_no, Date, Status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, \'Pending\')');
        $stmt->execute([
            $cid,
            $body['Batch'], $body['Department'], $body['Type'],
            $body['Complaint_To']  ?? 'HOD',
            $body['Description'],
            $body['class_no'] ?? '',
            $body['Date'],
        ]);
        jsonResponse(['success'=>true,'message'=>'Complaint submitted successfully.','id'=>$cid], 201);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
