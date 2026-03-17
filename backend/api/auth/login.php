<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';

setCORSHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$body = getRequestBody();
$username = trim($body['username'] ?? '');
$password = trim($body['password'] ?? '');
$role     = trim($body['role']     ?? '');

if (!$username || !$password || !$role) {
    jsonResponse(['success' => false, 'message' => 'All fields are required.'], 400);
}

$db = getDB();
$user = null;

switch ($role) {
    // ── ADMIN ──────────────────────────────────────────────────────
    case 'admin':
        $stmt = $db->prepare('SELECT Username, Password FROM admin WHERE Username = ? LIMIT 1');
        $stmt->execute([$username]);
        $row  = $stmt->fetch();
        if ($row && $password === $row['Password']) {
            $user = [
                'id'   => $row['Username'],
                'name' => 'Administrator',
                'role' => 'admin',
                'dept' => 'Administration',
            ];
        }
        break;

    // ── STAFF ──────────────────────────────────────────────────────
    case 'staff':
        $stmt = $db->prepare('SELECT SID, Name, Department, Password FROM addstaff WHERE SID = ? LIMIT 1');
        $stmt->execute([$username]);
        $row  = $stmt->fetch();
        if ($row && $password === $row['Password']) {
            $user = [
                'id'   => $row['SID'],
                'name' => $row['Name'],
                'role' => 'staff',
                'dept' => $row['Department'],
            ];
        }
        break;

    // ── STUDENT ────────────────────────────────────────────────────
    case 'student':
        $stmt = $db->prepare('SELECT RegNo, Name, Department, Batch, Password, status FROM student WHERE RegNo = ? LIMIT 1');
        $stmt->execute([$username]);
        $row  = $stmt->fetch();
        if ($row && $password === $row['Password']) {
            $user = [
                'id'    => $row['RegNo'],
                'name'  => $row['Name'],
                'role'  => 'student',
                'dept'  => $row['Department'],
                'batch' => $row['Batch'],
                'sem'   => 1, // Default; actual sem can be set in profile if needed
            ];
        }
        break;

    default:
        jsonResponse(['success' => false, 'message' => 'Invalid role.'], 400);
}

if (!$user) {
    jsonResponse(['success' => false, 'message' => 'Invalid credentials. Please check your ID and password.'], 401);
}

// Simple token: base64(role:id:timestamp) — replace with JWT for production
$tokenPayload = base64_encode($user['role'] . ':' . $user['id'] . ':' . time());
$token = hash_hmac('sha256', $tokenPayload, 'stc_cms_secret_2026') . '.' . $tokenPayload;

session_start();
$_SESSION['cms_user']  = $user;
$_SESSION['cms_token'] = $token;

jsonResponse([
    'success' => true,
    'token'   => $token,
    'user'    => $user,
    'message' => 'Login successful.',
]);
