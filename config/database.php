<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'expense_tracker');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Base URL
define('BASE_URL', 'http://localhost/Expense_Tracker/');

// App
define('APP_NAME', 'Expense Tracker');
define('JWT_SECRET', getenv('JWT_SECRET') ?: 'change-this-secret-key-in-production');
define('JWT_EXPIRATION', 3600);
define('REFRESH_TOKEN_EXPIRATION', 604800);

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
