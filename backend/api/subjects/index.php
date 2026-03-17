<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $dept  = trim($_GET['dept']  ?? '');
    $batch = trim($_GET['batch'] ?? '');

    $sql    = 'SELECT * FROM subjectdetails WHERE 1=1';
    $params = [];
    if ($dept)  { $sql .= ' AND Department = ?'; $params[] = $dept; }
    if ($batch) { $sql .= ' AND Batch = ?';       $params[] = $batch; }
    $sql .= ' ORDER BY SubjectName ASC';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $subjects = $stmt->fetchAll();

    $depts   = $db->query('SELECT DISTINCT Department FROM subjectdetails ORDER BY Department')->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query('SELECT DISTINCT Batch FROM subjectdetails ORDER BY Batch DESC')->fetchAll(PDO::FETCH_COLUMN);
    jsonResponse(['success'=>true,'data'=>$subjects,'depts'=>$depts,'batches'=>$batches]);
}

if ($method === 'POST') {
    $body     = getRequestBody();
    $required = ['SubjectCode','SubjectName','Department','Batch','sem'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"Field '$f' is required."], 400);
    }
    // Check for existing subject code
    $chk = $db->prepare('SELECT SubjectCode FROM subjectdetails WHERE SubjectCode = ?');
    $chk->execute([$body['SubjectCode']]);
    if ($chk->fetch()) jsonResponse(['success'=>false,'message'=>'Subject code already exists.'], 409);

    $stmt = $db->prepare('INSERT INTO subjectdetails (SubjectCode, SubjectName, Department, Batch, sem, NoOfHours, Type)
                          VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([
        $body['SubjectCode'], $body['SubjectName'], $body['Department'],
        $body['Batch'], $body['sem'], $body['NoOfHours']??5, $body['Type']??'Theory',
    ]);
    jsonResponse(['success'=>true,'message'=>'Subject added successfully.'], 201);
}

if ($method === 'DELETE') {
    $id = trim($_GET['id'] ?? '');
    if (!$id) jsonResponse(['success'=>false,'message'=>'Subject code required.'], 400);
    $stmt = $db->prepare('DELETE FROM subjectdetails WHERE SubjectCode = ?');
    $stmt->execute([$id]);
    jsonResponse(['success'=>true,'message'=>'Subject removed.']);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
