<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];
$id     = trim($_GET['id'] ?? '');

if (!$id) jsonResponse(['success'=>false,'message'=>'Student ID required.'], 400);

// ── GET ─────────────────────────────────────────────────────────────
if ($method === 'GET') {
    $stmt = $db->prepare('SELECT RegNo, Name, Batch, Department, sem, Gender, DOB, Address, Mobileno, `Email-id` AS Emailid, Password, status FROM student WHERE RegNo = ?');
    $stmt->execute([$id]);
    $student = $stmt->fetch();
    if (!$student) jsonResponse(['success'=>false,'message'=>'Student not found.'], 404);
    // Fetch personal details
    $personal = $db->prepare('SELECT * FROM studentpersonal WHERE Regno = ?');
    $personal->execute([$id]);
    $student['personal'] = $personal->fetch() ?: null;
    jsonResponse(['success'=>true,'data'=>$student]);
}

// ── PUT (Update) ─────────────────────────────────────────────────────
if ($method === 'PUT') {
    $body = getRequestBody();
    $stmt = $db->prepare('UPDATE student SET
        Name=?, Department=?, Batch=?, sem=?, Gender=?, DOB=?, Address=?, Mobileno=?, `Email-id`=?
        WHERE RegNo=?');
    $stmt->execute([
        $body['Name'] ?? '', $body['Department'] ?? $body['Dept'] ?? '', $body['Batch'] ?? 0,
        $body['sem']  ?? 0,  $body['Gender'] ?? '', $body['DOB'] ?? null,
        $body['Address'] ?? '', $body['Mobileno'] ?? null,
        $body['Emailid'] ?? '', $id,
    ]);
    jsonResponse(['success'=>true,'message'=>'Student updated successfully.']);
}

// ── DELETE (Discontinue) ─────────────────────────────────────────────
if ($method === 'DELETE') {
    $stmt = $db->prepare('DELETE FROM student WHERE RegNo = ?');
    $stmt->execute([$id]);
    jsonResponse(['success'=>true,'message'=>'Student record removed.']);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
