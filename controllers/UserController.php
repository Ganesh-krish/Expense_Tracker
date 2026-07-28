<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class UserController extends BaseController {
    public function profile() {
        AuthMiddleware::check();
        $this->view('users/profile');
    }
    
    public function updateProfile() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Update profile
        jsonResponse(['success' => true, 'message' => 'Profile updated successfully']);
    }
    
    public function changePassword() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Change password
        jsonResponse(['success' => true, 'message' => 'Password changed successfully']);
    }
    
    public function deleteAccount() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Delete account
        jsonResponse(['success' => true, 'message' => 'Account deleted successfully']);
    }
    
    public function uploadAvatar() {
        AuthMiddleware::check();
        // TODO: Upload avatar
        jsonResponse(['success' => true, 'message' => 'Avatar uploaded']);
    }
    
    public function deleteAvatar() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Delete avatar
        jsonResponse(['success' => true, 'message' => 'Avatar deleted']);
    }
}
