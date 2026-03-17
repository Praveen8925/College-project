<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// GET — fetch consolidated marks for a batch/dept/sem (all subjects, all students)
if ($method === 'GET') {
    $batch = (int)($_GET['batch'] ?? 0);
    $dept  = trim($_GET['dept']   ?? '');
    $sem   = (int)($_GET['sem']   ?? 0);

    if (!$batch || !$dept || !$sem) {
        echo json_encode(['success'=>false,'message'=>'batch, dept and sem required.']); exit;
    }

    // Get subjects for this batch/dept/sem
    $subjects = $db->prepare(
        "SELECT CourseID, Course_Name, Type, Total_Mark
         FROM subjectdetails
         WHERE Batch=? AND Programme_Name=? AND sem=?
         ORDER BY CourseID"
    );
    $subjects->execute([$batch, $dept, $sem]);
    $subjectList = $subjects->fetchAll(PDO::FETCH_ASSOC);

    // Get all students for this batch/dept
    $stmtS = $db->prepare(
        "SELECT Regno, Name FROM student
         WHERE Batch=? AND Department=? AND status<>'discontinue'
         ORDER BY Regno"
    );
    $stmtS->execute([$batch, $dept]);
    $students = $stmtS->fetchAll(PDO::FETCH_ASSOC);

    // For each student, fetch CT1, CT2, Model marks per subject
    $tableMap = ['CT1'=>'cycletest_1','CT2'=>'cycletest_2','Model'=>'modelexam'];
    $markData = [];

    foreach ($students as $st) {
        $regno = $st['Regno'];
        $markData[$regno] = ['Regno'=>$regno, 'Name'=>$st['Name'], 'marks'=>[]];
    }

    foreach ($subjectList as $sub) {
        $cid = $sub['CourseID'];
        foreach ($tableMap as $label => $table) {
            $stmt = $db->prepare(
                "SELECT Regno, mark FROM `$table`
                 WHERE Batch=? AND sem=? AND CourseID=?"
            );
            $stmt->execute([$batch, $sem, $cid]);
            $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            foreach ($rows as $regno => $mark) {
                if (isset($markData[$regno])) {
                    $markData[$regno]['marks']["{$cid}_{$label}"] = $mark;
                }
            }
        }
    }

    echo json_encode([
        'success'   => true,
        'subjects'  => $subjectList,
        'students'  => array_values($markData),
    ]);
    exit;
}

echo json_encode(['success'=>false,'message'=>'Method not allowed.']);
