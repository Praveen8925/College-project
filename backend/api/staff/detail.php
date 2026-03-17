<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];
$id     = trim($_GET['id'] ?? '');
if (!$id) jsonResponse(['success'=>false,'message'=>'Staff ID required.'], 400);

if ($method === 'GET') {
    $stmt = $db->prepare('SELECT a.*, d.Qualification, d.DOB, d.Address, d.Mobileno, d.DOJ,
                                d.UGExp, d.PGExp, d.Industryexp, d.Domain
                         FROM addstaff a LEFT JOIN staffdetail d ON a.SID = d.SID WHERE a.SID = ?');
    $stmt->execute([$id]);
    $staff = $stmt->fetch();
    if (!$staff) jsonResponse(['success'=>false,'message'=>'Staff not found.'], 404);
    jsonResponse(['success'=>true,'data'=>$staff]);
}

if ($method === 'PUT') {
    $body = getRequestBody();
    $db->beginTransaction();
    try {
        $s1 = $db->prepare('UPDATE addstaff SET Name=?, Department=?, Designation=?, Emailid=? WHERE SID=?');
        $s1->execute([$body['Name']??'',$body['Department']??'',$body['Designation']??'',$body['Emailid']??'',$id]);

        $s2 = $db->prepare('UPDATE staffdetail SET Qualification=?,DOB=?,Address=?,Mobileno=?,DOJ=?,UGExp=?,PGExp=?,Industryexp=?,Domain=? WHERE SID=?');
        $s2->execute([$body['Qualification']??'',$body['DOB']??null,$body['Address']??'',$body['Mobileno']??null,
                      $body['DOJ']??null,$body['UGExp']??0,$body['PGExp']??0,$body['Industryexp']??0,$body['Domain']??'',$id]);
        $db->commit();
        jsonResponse(['success'=>true,'message'=>'Staff updated successfully.']);
    } catch (Exception $e) {
        $db->rollBack();
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

if ($method === 'DELETE') {
    $stmt = $db->prepare('DELETE FROM addstaff WHERE SID = ?');
    $stmt->execute([$id]);
    jsonResponse(['success'=>true,'message'=>'Staff record removed.']);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
