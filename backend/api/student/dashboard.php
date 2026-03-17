<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$regno = trim($_GET['regno'] ?? '');
if (!$regno) jsonResponse(['success'=>false,'message'=>'Register number required.'], 400);

$safe    = fn($q,$d=0)    => (function() use ($db,$q,$d){ try{ return $db->query($q)->fetchColumn(); } catch(Exception $e){ return $d; } })();
$safeRow = fn($q,$p=[])   => (function() use ($db,$q,$p){ try{ $s=$db->prepare($q); $s->execute($p); return $s->fetch(); } catch(Exception $e){ return null; } })();
$safeAll = fn($q,$p=[])   => (function() use ($db,$q,$p){ try{ $s=$db->prepare($q); $s->execute($p); return $s->fetchAll(); } catch(Exception $e){ return []; } })();

// Student basic info
$student = $safeRow('SELECT * FROM student WHERE RegNo=?', [$regno]);
if (!$student) jsonResponse(['success'=>false,'message'=>'Student not found.'], 404);

$batch = (int)$student['Batch'];
$sem   = (int)($student['sem'] ?? 1); // Default to 1 if sem field is missing

// Resolve attendance table
function resolveAttTable(PDO $db, int $batch): ?string {
    $t = $batch.'attendance';
    if ($db->query("SHOW TABLES LIKE '$t'")->fetchColumn()) return $t;
    $rows = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM);
    return empty($rows) ? null : end($rows)[0];
}

$attTable = resolveAttTable($db, $batch);
$attRow   = $attTable ? $safeRow("SELECT * FROM `$attTable` WHERE Batch=? AND sem=? AND RegNo=?", [$batch,$sem,$regno]) : null;

$totDays  = (int)($attRow['tot_working_days'] ?? 0);
$present  = (int)($attRow['no_day_present']   ?? 0);
$attPct   = $totDays > 0 ? round(($present/$totDays)*100, 1) : 0;

// Marks summary from all test tables
function markFrom(PDO $db, string $table, string $regno, int $batch, int $sem): ?string {
    try {
        $cols = $db->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_COLUMN);
        $markCol = in_array('Mark',$cols)?'Mark':(in_array('mark',$cols)?'mark':null);
        if (!$markCol) return null;
        $stmt = $db->prepare("SELECT `$markCol` FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
        $stmt->execute([$batch,$sem,$regno]);
        $r = $stmt->fetch();
        return $r ? $r[$markCol] : null;
    } catch (Exception $e) { return null; }
}

$ct1   = markFrom($db,'cycletest_1', $regno, $batch, $sem);
$ct2   = markFrom($db,'cycletest_2', $regno, $batch, $sem);
$model = markFrom($db,'modelexam',   $regno, $batch, $sem);

// Recent events
$events = $safeAll('SELECT EventID, EventsMsg FROM events ORDER BY EventID DESC LIMIT 5');

// My complaints
$complaints = $safeAll(
    "SELECT Complaint_ID, Type, Description, Status, Date FROM complaint WHERE Batch=? ORDER BY Date DESC LIMIT 5",
    [$batch]
);

// Notes available for batch/sem
$notesCount = (int)$safe("SELECT COUNT(*) FROM notes WHERE Batch='$batch' AND sem='$sem'");

jsonResponse([
    'success'      => true,
    'student'      => $student,
    'attendance'   => ['total'=>$totDays,'present'=>$present,'pct'=>$attPct,'table'=>$attTable],
    'marks'        => ['ct1'=>$ct1,'ct2'=>$ct2,'model'=>$model],
    'events'       => $events,
    'complaints'   => $complaints,
    'notesCount'   => $notesCount,
]);
