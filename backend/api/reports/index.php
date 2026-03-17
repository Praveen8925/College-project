<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB();

// ── helpers ──────────────────────────────────────────────────────────────────
$safe = fn($q, $d = 0) => (function() use ($db,$q,$d) {
    try { return $db->query($q)->fetchColumn(); } catch (Exception $e) { return $d; }
})();
$rows = fn($q, $p = []) => (function() use ($db,$q,$p) {
    try { $s=$db->prepare($q); $s->execute($p); return $s->fetchAll(); } catch (Exception $e) { return []; }
})();

// ── 1. Student stats by batch ─────────────────────────────────────────────────
$byBatch = $rows('SELECT Batch, COUNT(*) as total, Department FROM student GROUP BY Batch, Department ORDER BY Batch DESC');

// ── 2. Attendance summary across all year tables ──────────────────────────────
$attTables = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM);
$attSummary = [];
foreach ($attTables as $t) {
    $tbl = $t[0];
    // skip yearattendance
    if (str_contains($tbl,'year')) continue;
    try {
        $aRows = $db->query("
            SELECT Batch, sem,
                   COUNT(*) as students,
                   ROUND(AVG(CASE WHEN tot_working_days > 0 THEN (no_day_present/tot_working_days)*100 ELSE 0 END),1) as avg_pct,
                   SUM(CASE WHEN tot_working_days > 0 AND (no_day_present/tot_working_days) < 0.75 THEN 1 ELSE 0 END) as defaulters
            FROM `$tbl`
            GROUP BY Batch, sem
            ORDER BY Batch DESC, sem
        ")->fetchAll();
        foreach ($aRows as $r) {
            $attSummary[] = array_merge($r, ['table' => $tbl]);
        }
    } catch (Exception $e) {}
}

// ── 3. Marks distribution per test ───────────────────────────────────────────
function marksStats(PDO $db, string $table): array {
    try {
        $cols = $db->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_COLUMN);
        $mc = in_array('Mark',$cols)?'Mark':(in_array('mark',$cols)?'mark':null);
        if (!$mc) return [];
        return $db->query("
            SELECT Batch, sem,
                   COUNT(*) as students,
                   ROUND(AVG(`$mc`),1) as avg_mark,
                   MAX(`$mc`) as max_mark,
                   MIN(`$mc`) as min_mark,
                   SUM(CASE WHEN `$mc` IS NOT NULL THEN 1 ELSE 0 END) as entered
            FROM `$table`
            WHERE `$mc` IS NOT NULL
            GROUP BY Batch, sem
            ORDER BY Batch DESC, sem
        ")->fetchAll();
    } catch (Exception $e) { return []; }
}
$ct1Stats   = marksStats($db, 'cycletest_1');
$ct2Stats   = marksStats($db, 'cycletest_2');
$modelStats = marksStats($db, 'modelexam');

// ── 4. Complaints summary ─────────────────────────────────────────────────────
$complaintStats = $rows('
    SELECT
        Type,
        COUNT(*) as total,
        SUM(CASE WHEN Status="Resolved" THEN 1 ELSE 0 END) as resolved,
        SUM(CASE WHEN Status="Pending"  THEN 1 ELSE 0 END) as pending
    FROM complaint
    GROUP BY Type
    ORDER BY total DESC
');

// ── 5. Staff report ───────────────────────────────────────────────────────────
$staffStats = $rows('SELECT Department, Designation, COUNT(*) as total FROM addstaff GROUP BY Department, Designation ORDER BY Department');

// ── 6. Work diary activity ────────────────────────────────────────────────────
$diaryStats = [];
try {
    $cols = $db->query("SHOW COLUMNS FROM workdiarys")->fetchAll(PDO::FETCH_COLUMN);
    if (in_array('SID',$cols)) {
        $diaryStats = $rows('SELECT SID, COUNT(*) as entries FROM workdiarys GROUP BY SID ORDER BY entries DESC LIMIT 10');
    }
} catch (Exception $e) {}

// ── TOP counters ──────────────────────────────────────────────────────────────
$totals = [
    'students'        => (int)$safe('SELECT COUNT(*) FROM student'),
    'staff'           => (int)$safe('SELECT COUNT(*) FROM addstaff'),
    'activeStudents'  => (int)$safe("SELECT COUNT(*) FROM student WHERE status='Student'"),
    'alumniStudents'  => (int)$safe("SELECT COUNT(*) FROM student WHERE status='Alumni'"),
    'notes'           => (int)$safe('SELECT COUNT(*) FROM notes'),
    'complaints'      => (int)$safe('SELECT COUNT(*) FROM complaint'),
    'complaintsPending'=> (int)$safe("SELECT COUNT(*) FROM complaint WHERE Status='Pending'"),
    'events'          => (int)$safe('SELECT COUNT(*) FROM events'),
    'batches'         => (int)$safe('SELECT COUNT(DISTINCT Batch) FROM student'),
    'depts'           => (int)$safe('SELECT COUNT(DISTINCT Department) FROM addstaff'),
];

jsonResponse([
    'success'        => true,
    'totals'         => $totals,
    'byBatch'        => $byBatch,
    'attendance'     => $attSummary,
    'marks'          => ['ct1'=>$ct1Stats,'ct2'=>$ct2Stats,'model'=>$modelStats],
    'complaints'     => $complaintStats,
    'staff'          => $staffStats,
    'diary'          => $diaryStats,
]);
