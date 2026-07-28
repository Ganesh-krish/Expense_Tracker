<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class SettingController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        $this->view('users/settings');
    }
    
    public function update() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Update settings
        jsonResponse(['success' => true, 'message' => 'Settings updated successfully']);
    }
    
    public function export() {
        AuthMiddleware::check();
        // TODO: Export data
    }
    
    public function clearData() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Clear all data
        jsonResponse(['success' => true, 'message' => 'All data cleared']);
    }
    
    public function get() {
        AuthMiddleware::check();
        // TODO: Return settings
        jsonResponse(['settings' => []]);
    }
}
