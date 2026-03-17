<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB(); $method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $dept = trim($_GET['dept'] ?? '');
    $where = $dept ? 'WHERE ci.Department=?' : '';
    $params = $dept ? [$dept] : [];
    $stmt = $db->prepare("SELECT ci.*, a.Name AS StaffName
        FROM classincharge ci LEFT JOIN addstaff a ON ci.SID=a.SID
        $where ORDER BY ci.Batch DESC,ci.sem");
    $stmt->execute($params);
    $depts = $db->query("SELECT DISTINCT Department FROM addstaff ORDER BY Department")->fetchAll(PDO::FETCH_COLUMN);
    $staff = $db->query("SELECT SID,Name,Department FROM addstaff ORDER BY Name")->fetchAll();
    jsonResponse(['success'=>true,'data'=>$stmt->fetchAll(),'depts'=>$depts,'staff'=>$staff]);
}
if ($method === 'POST') {
    $b = getRequestBody();
    foreach(['Batch','Department','sem','SID'] as $f)
        if (empty($b[$f])) jsonResponse(['success'=>false,'message'=>"$f required."],400);
    $chk = $db->prepare("SELECT COUNT(*) FROM classincharge WHERE Batch=? AND Department=? AND sem=?");
    $chk->execute([$b['Batch'],$b['Department'],$b['sem']]);
    if ($chk->fetchColumn()>0) {
        $db->prepare("UPDATE classincharge SET SID=? WHERE Batch=? AND Department=? AND sem=?")
           ->execute([$b['SID'],$b['Batch'],$b['Department'],$b['sem']]);
        jsonResponse(['success'=>true,'message'=>'Class incharge updated.']);
    }
    $db->prepare("INSERT INTO classincharge(Batch,Department,sem,SID) VALUES(?,?,?,?)")
       ->execute([$b['Batch'],$b['Department'],$b['sem'],$b['SID']]);
    jsonResponse(['success'=>true,'message'=>'Class incharge assigned.']);
}
if ($method === 'DELETE') {
    $batch=$_GET['batch']??''; $dept=$_GET['dept']??''; $sem=$_GET['sem']??'';
    if (!$batch||!$dept||!$sem) jsonResponse(['success'=>false,'message'=>'batch,dept,sem required.'],400);
    $db->prepare("DELETE FROM classincharge WHERE Batch=? AND Department=? AND sem=?")->execute([$batch,$dept,$sem]);
    jsonResponse(['success'=>true,'message'=>'Removed.']);
}
jsonResponse(['success'=>false,'message'=>'Method not allowed.'],405);
