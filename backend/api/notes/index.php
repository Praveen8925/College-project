<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $sid   = trim($_GET['sid']   ?? '');
    $batch = trim($_GET['batch'] ?? '');
    $sem   = trim($_GET['sem']   ?? '');

    $sql    = 'SELECT * FROM notes WHERE 1=1';
    $params = [];
    if ($sid)   { $sql .= ' AND SID=?';   $params[] = $sid;   }
    if ($batch) { $sql .= ' AND Batch=?'; $params[] = $batch; }
    if ($sem)   { $sql .= ' AND sem=?';   $params[] = $sem;   }
    $sql .= ' ORDER BY NID DESC';

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        jsonResponse(['success'=>true,'data'=>$stmt->fetchAll()]);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

if ($method === 'POST') {
    // Handle multipart form data (file upload)
    $sid     = trim($_POST['SID']         ?? '');
    $batch   = trim($_POST['Batch']       ?? '');
    $sem     = trim($_POST['sem']         ?? '');
    $dept    = trim($_POST['Department']  ?? '');
    $subCode = trim($_POST['SubjectCode'] ?? '');
    $desc    = trim($_POST['Description'] ?? '');
    $date    = date('Y-m-d');

    if (!$sid || !$batch || !$sem)
        jsonResponse(['success'=>false,'message'=>'SID, Batch and sem required.'], 400);

    $fileName = '';
    if (!empty($_FILES['file']['name'])) {
        $uploadDir = __DIR__ . '/../../../uploads/notes/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext      = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $fileName = $sid . '_' . time() . '.' . $ext;
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName)) {
            jsonResponse(['success'=>false,'message'=>'File upload failed.'], 500);
        }
    }

    try {
        $stmt = $db->prepare('INSERT INTO notes (SID, Batch, sem, Department, SubjectCode, Description, FileName, UploadDate)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$sid, $batch, $sem, $dept, $subCode, $desc, $fileName, $date]);
        jsonResponse(['success'=>true,'message'=>'Notes uploaded successfully.'], 201);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

if ($method === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success'=>false,'message'=>'Note ID required.'], 400);
    try {
        // Get filename to delete file
        $note = $db->prepare('SELECT FileName FROM notes WHERE NID=?');
        $note->execute([$id]);
        $row = $note->fetch();
        if ($row && $row['FileName']) {
            $path = __DIR__ . '/../../../uploads/notes/' . $row['FileName'];
            if (file_exists($path)) unlink($path);
        }
        $db->prepare('DELETE FROM notes WHERE NID=?')->execute([$id]);
        jsonResponse(['success'=>true,'message'=>'Note deleted.']);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
