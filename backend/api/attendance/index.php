<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

/* Helper: resolve year-based attendance table */
function attendanceTable(PDO $db, int $batch): string {
    $table = $batch . 'attendance';
    $exists = $db->query("SHOW TABLES LIKE '$table'")->fetchColumn();
    if (!$exists) {
        // Fallback to latest available
        $rows = $db->query("SHOW TABLES LIKE '%attendance'")->fetchAll(PDO::FETCH_NUM);
        if (empty($rows)) throw new Exception("No attendance table found in database.");
        $table = end($rows)[0];
    }
    return $table;
}

// ── GET — Fetch attendance for a batch/sem ───────────────────────────
if ($method === 'GET') {
    $batch = (int)($_GET['batch'] ?? 0);
    $sem   = (int)($_GET['sem']   ?? 0);
    if (!$batch || !$sem) jsonResponse(['success'=>false,'message'=>'Batch and semester required.'], 400);

    try {
        $table   = attendanceTable($db, $batch);
        $stmt    = $db->prepare("SELECT * FROM `$table` WHERE Batch=? AND sem=?");
        $stmt->execute([$batch, $sem]);
        $records = $stmt->fetchAll();
        jsonResponse(['success'=>true,'data'=>$records,'table'=>$table]);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

// ── POST — Save / update attendance ─────────────────────────────────
if ($method === 'POST') {
    $body  = getRequestBody();
    $batch = (int)($body['batch'] ?? 0);
    $sem   = (int)($body['sem']   ?? 0);
    $records = $body['records'] ?? []; // [{RegNo, status:'P'/'A'}]

    if (!$batch || !$sem || empty($records))
        jsonResponse(['success'=>false,'message'=>'batch, sem and records required.'], 400);

    try {
        $table = attendanceTable($db, $batch);
        $db->beginTransaction();
        foreach ($records as $r) {
            $regno  = $r['RegNo'];
            $status = $r['status'] === 'P' ? 1 : 0;

            // Upsert: update if exists, insert if not
            $check = $db->prepare("SELECT RegNo FROM `$table` WHERE Batch=? AND sem=? AND RegNo=?");
            $check->execute([$batch, $sem, $regno]);
            if ($check->fetch()) {
                $upd = $db->prepare("UPDATE `$table` SET
                    tot_working_days = tot_working_days + 1,
                    no_day_present   = no_day_present + ?,
                    decided = 'Yes'
                    WHERE Batch=? AND sem=? AND RegNo=?");
                $upd->execute([$status, $batch, $sem, $regno]);
            } else {
                $ins = $db->prepare("INSERT INTO `$table`
                    (Batch, sem, RegNo, tot_working_days, no_day_present, decided)
                    VALUES (?, ?, ?, 1, ?, 'Yes')");
                $ins->execute([$batch, $sem, $regno, $status]);
            }
        }
        $db->commit();
        jsonResponse(['success'=>true,'message'=>'Attendance saved successfully.']);
    } catch (Exception $e) {
        $db->rollBack();
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
