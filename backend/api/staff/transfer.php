<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB(); $method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $sid  = trim($_GET['sid']  ?? '');
    $dept = trim($_GET['dept'] ?? '');
    $where = []; $params = [];
    if ($sid)  { $where[] = 'st.Staffid=?';    $params[] = $sid; }
    if ($dept) { $where[] = 'st.Department=?'; $params[] = $dept; }
    $clause = $where ? 'WHERE '.implode(' AND ',$where) : '';
    $stmt = $db->prepare("SELECT st.*, a.Name AS StaffName
        FROM stafftransfer st LEFT JOIN addstaff a ON st.Staffid=a.SID
        $clause ORDER BY st.Date DESC");
    $stmt->execute($params);
    $depts = $db->query("SELECT DISTINCT Department FROM addstaff ORDER BY Department")->fetchAll(PDO::FETCH_COLUMN);
    $staff = $db->query("SELECT SID,Name,Department FROM addstaff ORDER BY Name")->fetchAll();
    jsonResponse(['success'=>true,'data'=>$stmt->fetchAll(),'depts'=>$depts,'staff'=>$staff]);
}
if ($method === 'POST') {
    $b = getRequestBody();
    foreach(['Staffid','Department','Transferedto','Date'] as $f)
        if (empty($b[$f])) jsonResponse(['success'=>false,'message'=>"$f required."],400);
    $db->prepare("INSERT INTO stafftransfer(Staffid,Department,Transferedto,Date) VALUES(?,?,?,?)")
       ->execute([$b['Staffid'],$b['Department'],$b['Transferedto'],$b['Date']]);
    // Update the staff's department in addstaff
    $db->prepare("UPDATE addstaff SET Department=? WHERE SID=?")->execute([$b['Transferedto'],$b['Staffid']]);
    jsonResponse(['success'=>true,'message'=>'Staff transferred successfully.']);
}
if ($method === 'DELETE') {
    $id  = $_GET['id']  ?? '';
    $sid = $_GET['sid'] ?? '';
    if (!$sid) jsonResponse(['success'=>false,'message'=>'sid required.'],400);
    $db->prepare("DELETE FROM stafftransfer WHERE Staffid=? AND Date=?")->execute([$sid,$_GET['date']??'']);
    jsonResponse(['success'=>true,'message'=>'Transfer record removed.']);
}
jsonResponse(['success'=>false,'message'=>'Method not allowed.'],405);
