<?php
if (!defined('ROOT_PATH')) {
    require_once __DIR__ . '/../config/database.php';
}
if (!defined('TABLE_USERS')) {
    require_once __DIR__ . '/../config/constants.php';
}

// Helper Functions

function redirect($url) {
    header('Location: ' . $url);
    exit();
}

function view($viewPath, $data = []) {
    extract($data);
    require_once VIEWS_PATH . $viewPath . '.php';
}

function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(CSRF_TOKEN_LENGTH));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf() {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        http_response_code(403);
        die('Invalid CSRF token');
    }
}

function sanitize($input, $filter = FILTER_SANITIZE_SPECIAL_CHARS) {
    if (is_array($input)) {
        return array_map(function($item) use ($filter) {
            return sanitize($item, $filter);
        }, $input);
    }
    return filter_var($input, $filter);
}

function formatCurrency($amount, $currency = DEFAULT_CURRENCY) {
    $symbols = [
        'USD' => '$', 'EUR' => '€', 'GBP' => '£', 'INR' => '₹',
        'JPY' => '¥', 'CAD' => 'C$', 'AUD' => 'A$'
    ];
    $symbol = $symbols[$currency] ?? $currency;
    return $symbol . number_format($amount, 2);
}

function formatDate($date, $format = DEFAULT_DATE_FORMAT) {
    return date($format, strtotime($date));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function currentUser() {
    return $_SESSION['user_id'] ?? null;
}

function flashMessage($key, $message) {
    $_SESSION[$key] = $message;
}

function getFlashMessage($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}

function generateJwt($userId, $email, $role) {
    require_once ASSETS_PATH . 'vendor/jwt/autoload.php';
    $key = JWT_SECRET;
    $payload = [
        'sub' => $userId,
        'email' => $email,
        'role' => $role,
        'iat' => time(),
        'exp' => time() + JWT_EXPIRATION
    ];
    return \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
}

function validateJwt($token) {
    require_once ASSETS_PATH . 'vendor/jwt/autoload.php';
    try {
        $key = JWT_SECRET;
        $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));
        return (array)$decoded;
    } catch (\Exception $e) {
        return null;
    }
}
