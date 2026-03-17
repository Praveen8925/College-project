<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/db.php';
setCORSHeaders();

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $events = $db->query('SELECT EventID, EventsMsg FROM events ORDER BY EventID DESC')->fetchAll();
    jsonResponse(['success'=>true,'data'=>$events]);
}

if ($method === 'POST') {
    $body = getRequestBody();
    if (empty($body['EventsMsg'])) jsonResponse(['success'=>false,'message'=>'Event message is required.'], 400);
    $stmt = $db->prepare('INSERT INTO events (EventsMsg) VALUES (?)');
    $stmt->execute([$body['EventsMsg']]);
    $id = $db->lastInsertId();
    jsonResponse(['success'=>true,'message'=>'Event added.','id'=>$id], 201);
}

if ($method === 'DELETE') {
    $id = trim($_GET['id'] ?? '');
    if (!$id) jsonResponse(['success'=>false,'message'=>'Event ID required.'], 400);
    $stmt = $db->prepare('DELETE FROM events WHERE EventID = ?');
    $stmt->execute([$id]);
    jsonResponse(['success'=>true,'message'=>'Event deleted.']);
}

jsonResponse(['success'=>false,'message'=>'Method not allowed.'], 405);
