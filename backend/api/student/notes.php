<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$batch = trim($_GET['batch'] ?? '');
$sem   = trim($_GET['sem']   ?? '');
$dept  = trim($_GET['dept']  ?? '');
if (!$batch || !$sem) jsonResponse(['success'=>false,'message'=>'Batch and sem required.'], 400);

try {
    $sql    = 'SELECT n.*, a.Name as StaffName FROM notes n LEFT JOIN addstaff a ON n.SID=a.SID WHERE n.Batch=? AND n.sem=?';
    $params = [$batch, $sem];
    if ($dept) { $sql .= ' AND (n.Department=? OR n.Department IS NULL OR n.Department="")'; $params[] = $dept; }
    $sql .= ' ORDER BY n.NID DESC';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $notes = $stmt->fetchAll();

    // Build download URL for each note
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ? 'https' : 'http') .
               '://' . $_SERVER['HTTP_HOST'] .
               '/camu dupli/backend/uploads/notes/';

    foreach ($notes as &$n) {
        $n['downloadUrl'] = $n['FileName'] ? $baseUrl . rawurlencode($n['FileName']) : null;
    }
    unset($n);

    jsonResponse(['success'=>true,'data'=>$notes]);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
}
