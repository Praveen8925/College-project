<?php
// Auto-detect environment and use appropriate database configuration

// Check if running in Docker (environment variables are set)
if (isset($_ENV['DB_HOST']) || getenv('DB_HOST')) {
    // Docker environment
    define('DB_HOST', $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'mysql');
    define('DB_NAME', $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'collegedetails');
    define('DB_USER', $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'college_user');
    define('DB_PASS', $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?? 'college_pass');
} else {
    // Local WAMP/XAMPP environment
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'collegedetails');
    define('DB_USER', 'root');
    define('DB_PASS', '');  // WAMP default — change if you set a password
}

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
            exit;
        }
    }
    return $pdo;
}
