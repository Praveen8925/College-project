<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
try {
    $db = getDB();
    $r = $db->query('SELECT * FROM student LIMIT 2')->fetchAll();
    jsonResponse(['ok'=>true,'data'=>$r]);
} catch (Exception $e) {
    jsonResponse(['ok'=>false,'error'=>$e->getMessage()]);
}
