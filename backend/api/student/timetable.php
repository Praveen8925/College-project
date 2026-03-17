<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db    = getDB();
$dept  = trim($_GET['dept']  ?? '');
$sem   = (int)($_GET['sem']  ?? 0);
$batch = (int)($_GET['batch'] ?? 0);
if (!$dept || !$sem)
    jsonResponse(['success'=>false,'message'=>'dept and sem required.'], 400);

try {
    // subjectdetails columns: Batch, sem, Programme_Name, CourseID, Course_Name, Type, Total_Mark, Credit, Part, decided
    // Match on Programme_Name = dept and sem
    $params = [$dept, $sem];
    $batchClause = '';
    if ($batch) {
        $batchClause = ' AND Batch=?';
        $params[] = $batch;
    }

    $stmt = $db->prepare(
        "SELECT CourseID, Course_Name, Credit, Type, Total_Mark, Batch
         FROM subjectdetails
         WHERE Programme_Name=? AND sem=?$batchClause
         ORDER BY Course_Name"
    );
    $stmt->execute($params);
    $subjects = $stmt->fetchAll();

    // Fetch staff allocations
    // staffallocation columns: Batch, Academic_year, Type, Department, Staff_Department, Sem, CourseID, StaffID
    $allocations = [];
    if (!empty($subjects)) {
        $codes = array_column($subjects, 'CourseID');
        $in    = implode(',', array_fill(0, count($codes), '?'));
        $aParams = $codes;
        if ($batch) {
            $aParams[] = $batch;
            $batchFilter = ' AND sa.Batch=?';
        } else {
            $batchFilter = '';
        }
        try {
            $aStmt = $db->prepare(
                "SELECT sa.CourseID, a.Name AS StaffName
                 FROM staffallocation sa
                 LEFT JOIN addstaff a ON sa.StaffID = a.SID
                 WHERE sa.CourseID IN ($in)$batchFilter"
            );
            $aStmt->execute($aParams);
            foreach ($aStmt->fetchAll() as $row) {
                $allocations[$row['CourseID']] = $row['StaffName'];
            }
        } catch (Exception $e) {}
    }

    // Merge staff name into subjects
    foreach ($subjects as &$s) {
        $s['StaffName'] = $allocations[$s['CourseID']] ?? 'Not Assigned';
    }
    unset($s);

    // Check for syllabus PDF file for this batch/dept
    $syllabusFile = null;
    if ($batch) {
        try {
            $sylStmt = $db->prepare(
                "SELECT file FROM syllabus WHERE Batch=? AND Department=? LIMIT 1"
            );
            $sylStmt->execute([$batch, $dept]);
            $sylRow = $sylStmt->fetch();
            if ($sylRow) {
                $syllabusFile = '/College-project/backend/uploads/' . $sylRow['file'];
            }
        } catch (Exception $e) {}
    }

    jsonResponse([
        'success'     => true,
        'dept'        => $dept,
        'sem'         => $sem,
        'subjects'    => $subjects,
        'syllabus'    => $syllabusFile,
    ]);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
}
