<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $sid = trim($_GET['sid'] ?? '');
    $sql = 'SELECT * FROM workdiarys WHERE 1=1';
    $params = [];
    if ($sid) { $sql .= ' AND SID=?'; $params[] = $sid; }
    $sql .= ' ORDER BY Date DESC LIMIT 60';
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        jsonResponse(['success'=>true,'data'=>$stmt->fetchAll()]);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

if ($method === 'POST') {
    $body = getRequestBody();
    $required = ['SID','Date','Subject','Topic'];
    foreach ($required as $f) {
        if (empty($body[$f])) jsonResponse(['success'=>false,'message'=>"Field '$f' is required."], 400);
    }
    try {
        // Detect available columns
        $cols    = $db->query('SHOW COLUMNS FROM workdiarys')->fetchAll(PDO::FETCH_COLUMN);
        $hasClass  = in_array('ClassNo', $cols);
        $hasPeriod = in_array('Period', $cols);
        $hasStudents = in_array('StudentsPresent', $cols) || in_array('NoStudents', $cols);
        $studCol = in_array('StudentsPresent', $cols) ? 'StudentsPresent' : (in_array('NoStudents', $cols) ? 'NoStudents' : null);

        $keys   = ['SID','Date','Subject','Topic'];
        $vals   = [$body['SID'], $body['Date'], $body['Subject'], $body['Topic']];
        if ($hasClass)  { $keys[] = 'ClassNo'; $vals[] = $body['ClassNo'] ?? ''; }
        if ($hasPeriod) { $keys[] = 'Period';  $vals[] = $body['Period']  ?? ''; }
        if ($studCol)   { $keys[] = $studCol;  $vals[] = $body['StudentsPresent'] ?? 0; }

        $placeholders = implode(',', array_fill(0, count($keys), '?'));
        $columns      = implode(',', array_map(fn($k)=>"`$k`", $keys));
        $db->prepare("INSERT INTO workdiarys ($columns) VALUES ($placeholders)")->execute($vals);
        jsonResponse(['success'=>true,'message'=>'Work diary entry saved.'], 201);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

if ($method === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    if (!$id) jsonResponse(['success'=>false,'message'=>'ID required.'], 400);
    try {
        // Try to find PK column name
        $pks = $db->query('SHOW KEYS FROM workdiarys WHERE Key_name="PRIMARY"')->fetchAll();
        $pk  = $pks[0]['Column_name'] ?? 'WID';
        $db->prepare("DELETE FROM workdiarys WHERE `$pk`=?")->execute([$id]);
        jsonResponse(['success'=>true,'message'=>'Entry deleted.']);
    } catch (Exception $e) {
        jsonResponse(['success'=>false,'message'=>$e->getMessage()], 500);
    }
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
