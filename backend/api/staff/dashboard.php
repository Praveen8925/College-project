<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db  = getDB();
$sid = trim($_GET['sid'] ?? '');
if (!$sid) jsonResponse(['success'=>false,'message'=>'Staff ID required.'], 400);

$safe    = fn($q,$d=0)    => (function() use ($db,$q,$d){ try{ return $db->query($q)->fetchColumn(); } catch(Exception $e){ return $d; } })();
$safeAll = fn($q)         => (function() use ($db,$q){ try{ return $db->query($q)->fetchAll(); } catch(Exception $e){ return []; } })();

// Staff basic info
$stmt = $db->prepare('SELECT a.*, d.Qualification, d.Domain FROM addstaff a LEFT JOIN staffdetail d ON a.SID=d.SID WHERE a.SID=?');
$stmt->execute([$sid]);
$staff = $stmt->fetch();

// Allocated classes
$alloc = $safeAll("SELECT * FROM staffallocation WHERE SID='$sid' ORDER BY Batch DESC LIMIT 10");

// Attendance tables available
$attendanceTables = array_map(fn($r) => $r[0],
    $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM));

// Notes uploaded
$notes = $safeAll("SELECT COUNT(*) AS cnt FROM notes WHERE SID='$sid'");
$notesCount = $notes[0]['cnt'] ?? 0;

// Work diary entries this month
$wdCount = $safe("SELECT COUNT(*) FROM workdiarys WHERE SID='$sid' AND MONTH(Date)=MONTH(CURDATE()) AND YEAR(Date)=YEAR(CURDATE())", 0);

jsonResponse([
    'success'          => true,
    'staff'            => $staff,
    'allocations'      => $alloc,
    'attendanceTables' => $attendanceTables,
    'notesCount'       => (int)$notesCount,
    'workDiaryThisMonth'=> (int)$wdCount,
]);
