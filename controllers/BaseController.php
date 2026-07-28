<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class BaseController {
    protected $pdo;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    protected function view($viewPath, $data = []) {
        extract($data);
        require_once VIEWS_PATH . $viewPath . '.php';
    }
    
    protected function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    protected function validateCsrf() {
        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            http_response_code(403);
            die('Invalid CSRF token');
        }
    }
    
    protected function isAuthorized($userId) {
        return (int)$userId === (int)($_SESSION['user_id'] ?? 0);
    }
}
