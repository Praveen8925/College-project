<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $status = trim($_GET['status'] ?? '');
    $dept   = trim($_GET['dept']   ?? '');

    $sql    = 'SELECT * FROM complaint WHERE 1=1';
    $params = [];
    if ($status) { $sql .= ' AND Status = ?';     $params[] = $status; }
    if ($dept)   { $sql .= ' AND Department = ?'; $params[] = $dept;   }
    $sql .= ' ORDER BY Date DESC';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $complaints = $stmt->fetchAll();
    jsonResponse(['success'=>true,'data'=>$complaints]);
}

if ($method === 'POST') {
    $body = getRequestBody();
    $required = ['Complaint_ID','Batch','Department','Type','Description','Date'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"Field '$f' is required."], 400);
    }
    $stmt = $db->prepare('INSERT INTO complaint
        (Complaint_ID, Batch, Department, Type, Complaint_To, Description, class_no, Date, Status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, \'Pending\')');
    $stmt->execute([
        $body['Complaint_ID'], $body['Batch'], $body['Department'], $body['Type'],
        $body['Complaint_To']??'', $body['Description'], $body['class_no']??'', $body['Date'],
    ]);
    jsonResponse(['success'=>true,'message'=>'Complaint submitted.'], 201);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
