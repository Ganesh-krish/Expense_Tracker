<?php
require_once ROOT_PATH . 'config/database.php';

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

    public static function hasRole($role) {
        if (!isLoggedIn() || $_SESSION['user_role'] !== $role) {
            return false;
        }
        return true;
    }
}
