<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db    = getDB();
$batch = intval($_GET['batch'] ?? 0);
$sem   = intval($_GET['sem']   ?? 0);
if (!$batch) jsonResponse(['success'=>false,'message'=>'Batch required.'], 400);

function getMarkCol(PDO $db, string $table): ?string {
    $cols = $db->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_COLUMN);
    return in_array('Mark',$cols)?'Mark':(in_array('mark',$cols)?'mark':null);
}

function fetchMarks(PDO $db, string $table, int $batch, int $sem): array {
    try {
        $mc = getMarkCol($db, $table);
        if (!$mc) return [];
        $w = $sem ? "AND sem=?" : "";
        $p = $sem ? [$batch,$sem] : [$batch];
        $stmt = $db->prepare("SELECT RegNo, sem, `$mc` as mark FROM `$table` WHERE Batch=? $w");
        $stmt->execute($p);
        return $stmt->fetchAll();
    } catch (Exception $e) { return []; }
}

// Fetch all mark tables
$ct1   = fetchMarks($db, 'cycletest_1', $batch, $sem);
$ct2   = fetchMarks($db, 'cycletest_2', $batch, $sem);
$model = fetchMarks($db, 'modelexam',   $batch, $sem);

// Assignment table
$assignTable = $batch.'assignment';
$assign = [];
try {
    if ($db->query("SHOW TABLES LIKE '$assignTable'")->fetchColumn()) {
        $stmt = $db->prepare("SELECT RegNo, sem, ass_mark as mark FROM `$assignTable` WHERE Batch=?".($sem?" AND sem=?":''));
        $stmt->execute($sem ? [$batch,$sem] : [$batch]);
        $assign = $stmt->fetchAll();
    }
} catch (Exception $e) {}

// Merge by RegNo
$students = $db->prepare('SELECT RegNo, Name, Department FROM student WHERE Batch=? ORDER BY Name');
$students->execute([$batch]);
$studs = $students->fetchAll();

$idx = fn($arr) => array_column($arr, null, 'RegNo');
$c1  = $idx($ct1);
$c2  = $idx($ct2);
$mdl = $idx($model);
$ass = $idx($assign);

$merged = array_map(function($s) use ($c1,$c2,$mdl,$ass) {
    $rn = $s['RegNo'];
    $ct1mark  = $c1[$rn]['mark']  ?? null;
    $ct2mark  = $c2[$rn]['mark']  ?? null;
    $mdlmark  = $mdl[$rn]['mark'] ?? null;
    $assMark  = $ass[$rn]['mark'] ?? null;
    $total    = ($ct1mark!==null?floatval($ct1mark):0)
              + ($ct2mark!==null?floatval($ct2mark):0)
              + ($mdlmark!==null?floatval($mdlmark):0)
              + ($assMark!==null?floatval($assMark):0);
    $max      = 25+25+50+25; // 125
    $pct      = round(($total/$max)*100,1);
    return [
        'RegNo'      => $rn,
        'Name'       => $s['Name'],
        'Department' => $s['Department'],
        'CT1'        => $ct1mark,
        'CT2'        => $ct2mark,
        'Model'      => $mdlmark,
        'Assignment' => $assMark,
        'Total'      => $total,
        'Max'        => $max,
        'Pct'        => $pct,
        'Grade'      => $pct>=90?'S':($pct>=80?'A':($pct>=70?'B':($pct>=60?'C':($pct>=50?'D':'F')))),
    ];
}, $studs);

$entered = array_filter($merged, fn($s) => $s['CT1']!==null || $s['CT2']!==null || $s['Model']!==null);
$avgPct  = count($entered)>0 ? round(array_sum(array_column(array_values($entered),'Pct'))/count($entered),1) : 0;

jsonResponse([
    'success'  => true,
    'batch'    => $batch,
    'sem'      => $sem,
    'students' => $merged,
    'summary'  => [
        'total'    => count($merged),
        'entered'  => count($entered),
        'avg_pct'  => $avgPct,
        'S' => count(array_filter($merged,fn($s)=>$s['Grade']==='S')),
        'A' => count(array_filter($merged,fn($s)=>$s['Grade']==='A')),
        'B' => count(array_filter($merged,fn($s)=>$s['Grade']==='B')),
        'C' => count(array_filter($merged,fn($s)=>$s['Grade']==='C')),
        'D' => count(array_filter($merged,fn($s)=>$s['Grade']==='D')),
        'F' => count(array_filter($merged,fn($s)=>$s['Grade']==='F')),
    ],
]);
