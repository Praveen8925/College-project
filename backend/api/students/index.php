<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// ── GET ─────────────────────────────────────────────────────────────
if ($method === 'GET') {
    $search = trim($_GET['search'] ?? '');
    $dept   = trim($_GET['dept']   ?? '');
    $batch  = trim($_GET['batch']  ?? '');

    $sql    = 'SELECT RegNo, Name, Batch, Department, sem, Gender, DOB, Address, Mobileno, `Email-id` AS Emailid, Password, status FROM student WHERE 1=1';
    $params = [];

    if ($search) {
        $sql .= ' AND (RegNo LIKE ? OR Name LIKE ? OR `Email-id` LIKE ?)';
        $like = "%$search%";
        $params = array_merge($params, [$like, $like, $like]);
    }
    if ($dept)  { $sql .= ' AND Department = ?'; $params[] = $dept;  }
    if ($batch) { $sql .= ' AND Batch = ?';       $params[] = $batch; }
    $sql .= ' ORDER BY Name ASC';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $students = $stmt->fetchAll();

    // Departments list for filter
    $depts   = $db->query('SELECT DISTINCT Department FROM student ORDER BY Department')->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query('SELECT DISTINCT Batch FROM student ORDER BY Batch DESC')->fetchAll(PDO::FETCH_COLUMN);

    jsonResponse(['success' => true, 'data' => $students, 'depts' => $depts, 'batches' => $batches]);
}

// ── POST (Add Student) ───────────────────────────────────────────────
if ($method === 'POST') {
    $body = getRequestBody();
    $required = ['RegNo','Name','Department','Batch','sem','Gender','Password'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"Field '$f' is required."], 400);
    }

    // Check duplicate RegNo
    $chk = $db->prepare('SELECT RegNo FROM student WHERE RegNo = ?');
    $chk->execute([$body['RegNo']]);
    if ($chk->fetch()) jsonResponse(['success'=>false,'message'=>'Register number already exists.'], 409);

    $stmt = $db->prepare('INSERT INTO student
        (RegNo, Name, Batch, Department, sem, Gender, DOB, Address, Mobileno, `Email-id`, Password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([
        $body['RegNo'], $body['Name'],    $body['Batch'],   $body['Department'],
        $body['sem'],   $body['Gender'],  $body['DOB']   ?? null,
        $body['Address']  ?? '',          $body['Mobileno'] ?? null,
        $body['Emailid']  ?? '',          $body['Password'],
    ]);
    jsonResponse(['success'=>true,'message'=>'Student added successfully.'], 201);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
