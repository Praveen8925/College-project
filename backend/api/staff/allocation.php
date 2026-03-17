<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB(); $method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $dept  = trim($_GET['dept']  ?? '');
    $batch = trim($_GET['batch'] ?? '');
    $sem   = (int)($_GET['sem']  ?? 0);
    $where = []; $params = [];
    if ($dept)  { $where[] = 'sa.Department=?';  $params[] = $dept; }
    if ($batch) { $where[] = 'sa.Batch=?';        $params[] = $batch; }
    if ($sem)   { $where[] = 'sa.Sem=?';          $params[] = $sem; }
    $clause = $where ? 'WHERE '.implode(' AND ',$where) : '';
    $stmt = $db->prepare("SELECT sa.*, a.Name AS StaffName, sd.Course_Name
        FROM staffallocation sa
        LEFT JOIN addstaff a ON sa.StaffID=a.SID
        LEFT JOIN subjectdetails sd ON sa.CourseID=sd.CourseID AND sa.Batch=sd.Batch AND sa.Sem=sd.sem
        $clause ORDER BY sa.Batch DESC,sa.Sem,sa.CourseID");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    $staffList = $db->query("SELECT SID,Name,Department FROM addstaff ORDER BY Name")->fetchAll();
    $sp = []; $subWhere = '';
    if ($batch) { $subWhere .= ' AND Batch=?'; $sp[] = $batch; }
    if ($sem)   { $subWhere .= ' AND sem=?';   $sp[] = $sem; }
    $subStmt = $db->prepare("SELECT CourseID,Course_Name,Programme_Name,Batch,sem FROM subjectdetails WHERE 1=1 $subWhere ORDER BY Course_Name");
    $subStmt->execute($sp);
    $depts   = $db->query("SELECT DISTINCT Department FROM staffallocation ORDER BY Department")->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query("SELECT DISTINCT Batch FROM staffallocation ORDER BY Batch DESC")->fetchAll(PDO::FETCH_COLUMN);
    jsonResponse(['success'=>true,'data'=>$rows,'staff'=>$staffList,'subjects'=>$subStmt->fetchAll(),'depts'=>$depts,'batches'=>$batches]);
}
if ($method === 'POST') {
    $b = getRequestBody();
    foreach(['Batch','Sem','Department','CourseID','StaffID'] as $f)
        if (empty($b[$f])) jsonResponse(['success'=>false,'message'=>"$f required."],400);
    $chk = $db->prepare("SELECT COUNT(*) FROM staffallocation WHERE Batch=? AND Sem=? AND CourseID=?");
    $chk->execute([$b['Batch'],$b['Sem'],$b['CourseID']]);
    if ($chk->fetchColumn()>0) {
        $db->prepare("UPDATE staffallocation SET StaffID=?,Staff_Department=?,Type=?,Academic_year=? WHERE Batch=? AND Sem=? AND CourseID=?")
           ->execute([$b['StaffID'],$b['Staff_Department']??$b['Department'],$b['Type']??'odd',date('Y'),$b['Batch'],$b['Sem'],$b['CourseID']]);
        jsonResponse(['success'=>true,'message'=>'Allocation updated.']);
    }
    $db->prepare("INSERT INTO staffallocation(Batch,Academic_year,Type,Department,Staff_Department,Sem,CourseID,StaffID) VALUES(?,?,?,?,?,?,?,?)")
       ->execute([$b['Batch'],date('Y'),$b['Type']??'odd',$b['Department'],$b['Staff_Department']??$b['Department'],$b['Sem'],$b['CourseID'],$b['StaffID']]);
    jsonResponse(['success'=>true,'message'=>'Staff allocated.']);
}
if ($method === 'DELETE') {
    $batch=$_GET['batch']??''; $sem=$_GET['sem']??''; $code=$_GET['code']??'';
    if (!$batch||!$sem||!$code) jsonResponse(['success'=>false,'message'=>'batch,sem,code required.'],400);
    $db->prepare("DELETE FROM staffallocation WHERE Batch=? AND Sem=? AND CourseID=?")->execute([$batch,$sem,$code]);
    jsonResponse(['success'=>true,'message'=>'Allocation removed.']);
}
jsonResponse(['success'=>false,'message'=>'Method not allowed.'],405);

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// ── GET — list allocations ───────────────────────────────────────────
if ($method === 'GET') {
    $dept  = trim($_GET['dept']  ?? '');
    $batch = trim($_GET['batch'] ?? '');
    $sem   = trim($_GET['sem']   ?? '');

    $where = [];
    $params = [];
    if ($dept)  { $where[] = 'sa.Department=?';  $params[] = $dept; }
    if ($batch) { $where[] = 'sa.Batch=?';       $params[] = $batch; }
    if ($sem)   { $where[] = 'sa.Sem=?';         $params[] = $sem; }

    $clause = $where ? ' WHERE ' . implode(' AND ', $where) : '';

    $stmt = $db->prepare("
        SELECT sa.*, a.Name AS StaffName, sd.Course_Name
        FROM staffallocation sa
        LEFT JOIN addstaff a ON sa.StaffID = a.SID
        LEFT JOIN subjectdetails sd ON sa.CourseID = sd.CourseID AND sa.Batch = sd.Batch AND sa.Sem = sd.sem
        $clause
        ORDER BY sa.Batch DESC, sa.Sem, sa.CourseID
    ");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    // Get distinct departments and batches for filters
    $depts   = $db->query("SELECT DISTINCT Department FROM staffallocation ORDER BY Department")->fetchAll(PDO::FETCH_COLUMN);
    $batches = $db->query("SELECT DISTINCT Batch FROM staffallocation ORDER BY Batch DESC")->fetchAll(PDO::FETCH_COLUMN);

    // Get staff list for dropdown
    $staffList = $db->query("SELECT SID, Name, Department FROM addstaff ORDER BY Name")->fetchAll();

    // Get subjects for dropdown
    $subjectParams = [];
    $subjectWhere = '';
    if ($batch && $sem) {
        $subjectWhere = ' WHERE Batch=? AND sem=?';
        $subjectParams = [$batch, $sem];
    }
    $subStmt = $db->prepare("SELECT CourseID, Course_Name, Programme_Name, Batch, sem FROM subjectdetails $subjectWhere ORDER BY Course_Name");
    $subStmt->execute($subjectParams);
    $subjects = $subStmt->fetchAll();

    jsonResponse([
        'success' => true,
        'data'    => $rows,
        'depts'   => $depts,
        'batches' => $batches,
        'staff'   => $staffList,
        'subjects'=> $subjects,
    ]);
}

// ── POST — add allocation ────────────────────────────────────────────
if ($method === 'POST') {
    $body = getRequestBody();
    $required = ['Batch','Sem','Department','CourseID','StaffID'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"$f is required."], 400);
    }

    // Check if allocation already exists
    $check = $db->prepare("SELECT COUNT(*) FROM staffallocation WHERE Batch=? AND Sem=? AND CourseID=?");
    $check->execute([$body['Batch'], $body['Sem'], $body['CourseID']]);
    if ($check->fetchColumn() > 0) {
        // Update existing
        $stmt = $db->prepare("UPDATE staffallocation SET StaffID=?, Staff_Department=?, Type=?, Academic_year=? WHERE Batch=? AND Sem=? AND CourseID=?");
        $stmt->execute([
            $body['StaffID'],
            $body['Staff_Department'] ?? $body['Department'],
            $body['Type'] ?? 'odd',
            $body['Academic_year'] ?? date('Y'),
            $body['Batch'], $body['Sem'], $body['CourseID'],
        ]);
        jsonResponse(['success'=>true,'message'=>'Allocation updated.']);
    }

    $stmt = $db->prepare("INSERT INTO staffallocation (Batch, Academic_year, Type, Department, Staff_Department, Sem, CourseID, StaffID)
        VALUES (?,?,?,?,?,?,?,?)");
    $stmt->execute([
        $body['Batch'],
        $body['Academic_year'] ?? date('Y'),
        $body['Type'] ?? 'odd',
        $body['Department'],
        $body['Staff_Department'] ?? $body['Department'],
        $body['Sem'],
        $body['CourseID'],
        $body['StaffID'],
    ]);
    jsonResponse(['success'=>true,'message'=>'Staff allocated successfully.']);
}

// ── DELETE — remove allocation ───────────────────────────────────────
if ($method === 'DELETE') {
    $batch = $_GET['batch'] ?? '';
    $sem   = $_GET['sem']   ?? '';
    $code  = $_GET['code']  ?? '';
    if (!$batch || !$sem || !$code) jsonResponse(['success'=>false,'message'=>'batch, sem, code required.'], 400);

    $stmt = $db->prepare("DELETE FROM staffallocation WHERE Batch=? AND Sem=? AND CourseID=?");
    $stmt->execute([$batch, $sem, $code]);
    jsonResponse(['success'=>true,'message'=>'Allocation removed.']);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
