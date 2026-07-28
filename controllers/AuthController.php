<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class AuthController extends BaseController {
    public function showLogin() {
        AuthMiddleware::guest();
        $this->view('auth/login');
    }
    
    public function login() {
        AuthMiddleware::guest();
        verifyCsrf();
        // TODO: Validate login
        jsonResponse(['success' => true, 'message' => 'Login successful']);
    }
    
    public function showRegister() {
        AuthMiddleware::guest();
        $this->view('auth/register');
    }
    
    public function register() {
        AuthMiddleware::guest();
        verifyCsrf();
        // TODO: Validate registration
        jsonResponse(['success' => true, 'message' => 'Registration successful']);
    }
    
    public function logout() {
        AuthMiddleware::check();
        session_destroy();
        redirect(BASE_URL . 'login');
    }
    
    public function showForgotPassword() {
        AuthMiddleware::guest();
        $this->view('auth/forgot_password');
    }
    
    public function forgotPassword() {
        AuthMiddleware::guest();
        verifyCsrf();
        // TODO: Handle forgot password
        jsonResponse(['success' => true, 'message' => 'Reset link sent if email exists']);
    }
    
    public function showResetPassword() {
        AuthMiddleware::guest();
        $this->view('auth/reset_password');
    }
    
    public function resetPassword() {
        AuthMiddleware::guest();
        verifyCsrf();
        // TODO: Handle reset password
        jsonResponse(['success' => true, 'message' => 'Password reset successful']);
    }
}
