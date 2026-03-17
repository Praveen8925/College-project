<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB();

$dept   = trim($_GET['dept']   ?? '');
$search = trim($_GET['search'] ?? '');

$where = []; $params = [];
if ($dept)   { $where[] = 'a.Department=?'; $params[] = $dept; }
if ($search) { $where[] = '(a.Name LIKE ? OR a.SID LIKE ? OR a.Emailid LIKE ?)'; $params = array_merge($params, ["%$search%","%$search%","%$search%"]); }
$clause = $where ? 'WHERE '.implode(' AND ',$where) : '';

$stmt = $db->prepare("SELECT a.SID, a.Name, a.Department, a.Designation, a.Emailid,
    d.Qualification, d.Mobileno, d.DOJ, d.UGExp, d.PGExp, d.Industryexp, d.Domain,
    (SELECT COUNT(*) FROM staffallocation sa WHERE sa.StaffID=a.SID) AS subjects_allocated,
    (SELECT COUNT(*) FROM workdiarys w WHERE w.SID=a.SID) AS diary_entries
    FROM addstaff a
    LEFT JOIN staffdetail d ON a.SID=d.SID
    $clause ORDER BY a.Department, a.Name");
$stmt->execute($params);
$staff = $stmt->fetchAll();

// Department summary
$deptSummary = $db->query("SELECT Department, COUNT(*) AS total,
    SUM(CASE WHEN Designation LIKE '%HOD%' OR Designation LIKE '%HoD%' THEN 1 ELSE 0 END) AS hod
    FROM addstaff GROUP BY Department ORDER BY Department")->fetchAll();

$depts = $db->query("SELECT DISTINCT Department FROM addstaff ORDER BY Department")->fetchAll(PDO::FETCH_COLUMN);

jsonResponse(['success'=>true,'data'=>$staff,'deptSummary'=>$deptSummary,'depts'=>$depts,'total'=>count($staff)]);
