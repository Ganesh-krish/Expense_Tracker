<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'expense_tracker');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Base URL
define('BASE_URL', 'http://localhost/expense_tracker/');

// Paths
define('ROOT_PATH', __DIR__ . '/../');
define('CONTROLLERS_PATH', ROOT_PATH . 'controllers/');
define('MODELS_PATH', ROOT_PATH . 'models/');
define('VIEWS_PATH', ROOT_PATH . 'views/');
define('ASSETS_PATH', ROOT_PATH . 'assets/');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
define('UPLOADS_PATH', ROOT_PATH . 'uploads/');

// Application Environment
define('APP_ENV', 'development');
define('APP_DEBUG', true);

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    if (APP_DEBUG) {
        die("Database Connection Failed: " . $e->getMessage());
    } else {
        die("Database Connection Failed. Please try again later.");
    }
}
