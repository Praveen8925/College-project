<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();
$db = getDB();
$cols = $db->query('DESCRIBE student')->fetchAll(PDO::FETCH_ASSOC);
$row  = $db->query('SELECT * FROM student LIMIT 1')->fetch(PDO::FETCH_ASSOC);
jsonResponse(['columns'=>array_column($cols,'Field'),'sample'=>$row]);
