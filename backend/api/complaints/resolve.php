<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db   = getDB();
$body = getRequestBody();
$id   = trim($body['Complaint_ID'] ?? $_GET['id'] ?? '');

if ($_SERVER['REQUEST_METHOD'] !== 'PUT')
    jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
if (!$id)
    jsonResponse(['success'=>false,'message'=>'Complaint ID required.'], 400);

$stmt = $db->prepare("UPDATE complaint SET Status='Resolved', solved_description=?, rdate=CURDATE() WHERE Complaint_ID=?");
$stmt->execute([$body['solved_description'] ?? 'Resolved by admin.', $id]);
jsonResponse(['success'=>true,'message'=>'Complaint resolved successfully.']);
