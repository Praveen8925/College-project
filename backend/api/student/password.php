<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$db = getDB();
$body = getRequestBody();
$regno       = trim($body['regno']       ?? '');
$oldPassword = trim($body['oldPassword'] ?? '');
$newPassword = trim($body['newPassword'] ?? '');

if (!$regno || !$oldPassword || !$newPassword) {
    jsonResponse(['success' => false, 'message' => 'All fields are required.'], 400);
}

if (strlen($newPassword) < 4) {
    jsonResponse(['success' => false, 'message' => 'Password must be at least 4 characters.'], 400);
}

try {
    // Verify current password
    $stmt = $db->prepare("SELECT Password FROM student WHERE RegNo=?");
    $stmt->execute([$regno]);
    $row = $stmt->fetch();

    if (!$row) {
        jsonResponse(['success' => false, 'message' => 'Student not found.'], 404);
    }

    if ($row['Password'] !== $oldPassword) {
        jsonResponse(['success' => false, 'message' => 'Current password is incorrect.'], 401);
    }

    // Update password
    $updateStmt = $db->prepare("UPDATE student SET Password=? WHERE RegNo=?");
    $updateStmt->execute([$newPassword, $regno]);

    jsonResponse([
        'success' => true,
        'message' => 'Password updated successfully.',
    ]);
} catch (Exception $e) {
    jsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
}
