<?php
require_once __DIR__ . '/../../config/helpers.php';
setCORSHeaders();

session_start();
session_unset();
session_destroy();

jsonResponse(['success' => true, 'message' => 'Logged out successfully.']);
