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

    $sql    = 'SELECT a.*, d.Qualification, d.DOB, d.Address, d.Mobileno, d.DOJ,
                      d.UGExp, d.PGExp, d.Industryexp, d.Domain
               FROM addstaff a LEFT JOIN staffdetail d ON a.SID = d.SID WHERE 1=1';
    $params = [];

    if ($search) {
        $sql .= ' AND (a.SID LIKE ? OR a.Name LIKE ? OR a.Emailid LIKE ?)';
        $like = "%$search%";
        $params = array_merge($params, [$like, $like, $like]);
    }
    if ($dept) { $sql .= ' AND a.Department = ?'; $params[] = $dept; }
    $sql .= ' ORDER BY a.Name ASC';

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $staff = $stmt->fetchAll();

    $depts = $db->query('SELECT DISTINCT Department FROM addstaff ORDER BY Department')->fetchAll(PDO::FETCH_COLUMN);
    jsonResponse(['success'=>true,'data'=>$staff,'depts'=>$depts]);
}

// ── POST (Add Staff) ─────────────────────────────────────────────────
if ($method === 'POST') {
    $body = getRequestBody();
    $required = ['SID','Name','Department','Designation','Emailid','Password'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"Field '$f' is required."], 400);
    }

    $chk = $db->prepare('SELECT SID FROM addstaff WHERE SID = ?');
    $chk->execute([$body['SID']]);
    if ($chk->fetch()) jsonResponse(['success'=>false,'message'=>'Staff ID already exists.'], 409);

    $db->beginTransaction();
    try {
        $stmt = $db->prepare('INSERT INTO addstaff (SID, Name, Department, Designation, Emailid, Password)
                              VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$body['SID'],$body['Name'],$body['Department'],$body['Designation'],$body['Emailid'],$body['Password']]);

        // Insert into staffdetail
        $stmt2 = $db->prepare('INSERT INTO staffdetail (SID, Qualification, DOB, Address, Mobileno, DOJ, UGExp, PGExp, Industryexp, Domain)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt2->execute([
            $body['SID'], $body['Qualification']??'', $body['DOB']??null,
            $body['Address']??'', $body['Mobileno']??null, $body['DOJ']??null,
            $body['UGExp']??0, $body['PGExp']??0, $body['Industryexp']??0, $body['Domain']??'',
        ]);
        $db->commit();
        jsonResponse(['success'=>true,'message'=>'Staff added successfully.'], 201);
    } catch (Exception $e) {
        $db->rollBack();
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
