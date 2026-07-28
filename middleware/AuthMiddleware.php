<?php
require_once ROOT_PATH . 'config/database.php';

class AuthMiddleware {
    public static function check() {
        if (!isLoggedIn()) {
            flashMessage('error', 'Please login to access this page');
            redirect(BASE_URL . 'login');
        }
    }

    public static function guest() {
        if (isLoggedIn()) {
            redirect(BASE_URL . 'dashboard');
        }
    }
}

class RoleMiddleware {
    public static function admin() {
        if (!isLoggedIn() || $_SESSION['user_role'] !== ROLE_ADMIN) {
            http_response_code(403);
            die('Access Denied. Admin privileges required.');
        }
    }

    public static function user() {
        if (!isLoggedIn() || $_SESSION['user_role'] !== ROLE_USER) {
            http_response_code(403);
            die('Access Denied. User privileges required.');
        }
    }
}
