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

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember_me']);

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }

        if (!$password) {
            $errors[] = 'Password is required';
        }

        $userModel = new User();

        if (empty($errors)) {
            $user = $userModel->findByEmail($email);
            if (!$user || !$userModel->verifyPassword($password, $user['password'])) {
                $errors[] = 'Invalid email or password';
            }
        }

        if (!empty($errors)) {
            $this->view('auth/login', [
                'errors' => $errors,
                'email' => $email
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        if ($remember) {
            $token = $userModel->generateRememberToken();
            $userModel->updateUser($user['id'], ['remember_token' => $token]);
            setcookie('remember_token', $token, time() + (86400 * 30), '/', '', false, true);
        }

        flashMessage('flash_success', 'Login successful!');
        redirect(BASE_URL . 'dashboard');
    }

    public function showRegister() {
        AuthMiddleware::guest();
        $this->view('auth/register');
    }

    public function register() {
        AuthMiddleware::guest();
        verifyCsrf();

        $username = trim($_POST['username'] ?? '');
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $errors = [];

        if (empty($username) || strlen($username) < 3 || strlen($username) > 50) {
            $errors[] = 'Username must be between 3 and 50 characters';
        } elseif (!ctype_alnum($username)) {
            $errors[] = 'Username must be alphanumeric';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }

        if (empty($password) || strlen($password) < PASSWORD_MIN_LENGTH) {
            $errors[] = 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters';
        }

        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match';
        }

        $userModel = new User();

        if (empty($errors)) {
            if ($userModel->findByEmail($email)) {
                $errors[] = 'Email already registered';
            }
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM " . TABLE_USERS . " WHERE username = :username");
            $stmt->execute(['username' => $username]);
            if ($stmt->fetchColumn() > 0) {
                $errors[] = 'Username already taken';
            }
        }

        if (!empty($errors)) {
            $this->view('auth/register', [
                'errors' => $errors,
                'username' => $username,
                'email' => $email
            ]);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $userId = $userModel->createUser([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => ROLE_USER,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $username;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = ROLE_USER;

        flashMessage('flash_success', 'Registration successful!');
        redirect(BASE_URL . 'register-success');
    }

    public function registerSuccess() {
        AuthMiddleware::check();
        $this->view('auth/register_success');
    }

    public function logout() {
        $_SESSION = [];
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
        session_destroy();
        session_write_close();
        redirect(BASE_URL . 'login');
    }

    public function showForgotPassword() {
        AuthMiddleware::guest();
        $this->view('auth/forgot_password');
    }

    public function forgotPassword() {
        logInfo('AuthController.forgotPassword called');
        AuthMiddleware::guest();
        verifyCsrf();

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        logInfo('AuthController.forgotPassword email input', ['email' => $email]);

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            logInfo('AuthController.forgotPassword validation failed', ['reason' => 'invalid_email']);
            $this->view('auth/forgot_password', ['error' => 'Valid email is required']);
            return;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);
        logInfo('AuthController.forgotPassword user lookup', ['email' => $email, 'found' => (bool)$user]);

        if (!$user) {
            logInfo('AuthController.forgotPassword user not found', ['email' => $email]);
            flashMessage('flash_success', 'If an account with that email exists, a reset link has been sent.');
            redirect(BASE_URL . 'login');
        }

        $cooldownSeconds = 60;
        $last = $userModel->getLastPasswordResetAt($email);
        logInfo('AuthController.forgotPassword cooldown check', ['email' => $email, 'last' => $last]);

        if ($last) {
            $diff = time() - strtotime($last);
            if ($diff < $cooldownSeconds) {
                $wait = $cooldownSeconds - $diff;
                logInfo('AuthController.forgotPassword cooldown active', ['wait' => $wait]);
                $this->view('auth/forgot_password', [
                    'error' => "Please wait {$wait} seconds before requesting another reset link."
                ]);
                return;
            }
        }

        $token = bin2hex(random_bytes(32));
        $passwordReset = new PasswordReset();
        $passwordReset->createToken($email, $token);
        logInfo('AuthController.forgotPassword token created', ['email' => $email, 'token_length' => strlen($token)]);

        $resetLink = BASE_URL . 'reset-password/' . $token;
        $subject = 'Password Reset Request - ' . APP_NAME;

        $body = "Hello,\n\n";
        $body .= "We received a request to reset the password for your account associated with this email address.\n\n";
        $body .= "If you made this request, click the link below to set a new password:\n\n";
        $body .= $resetLink . "\n\n";
        $body .= "This link will expire in 1 hour.\n\n";
        $body .= "If you did not request a password reset, please ignore this email. Your account remains secure and no changes have been made.\n\n";
        $body .= "Thanks,\n";
        $body .= APP_NAME . " Team\n";

        logInfo('AuthController.forgotPassword sending mail', ['to' => $email, 'subject' => $subject, 'resetLink' => $resetLink]);
        $sent = sendAppMail($email, $subject, $body);
        logInfo('AuthController.forgotPassword send result', ['sent' => $sent]);

        if ($sent === true) {
            flashMessage('flash_success', 'Email sent.');
            redirect(BASE_URL . 'login');
        }

        $this->view('auth/forgot_password', [
            'error' => 'Email failed to send: ' . $sent
        ]);
    }

    public function showResetPassword($token = null) {
        AuthMiddleware::guest();

        if (!$token) {
            flashMessage('flash_error', 'Invalid reset token');
            redirect(BASE_URL . 'login');
        }

        $this->view('auth/reset_password', ['token' => $token]);
    }

    public function resetPassword() {
        AuthMiddleware::guest();
        verifyCsrf();

        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $errors = [];

        if (empty($token)) {
            $errors[] = 'Invalid or expired reset token';
        }

        if (empty($password) || strlen($password) < PASSWORD_MIN_LENGTH) {
            $errors[] = 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters';
        }

        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match';
        }

        if (empty($errors)) {
            $userModel = new User();
            $email = $userModel->validateResetToken($token);

            if (!$email) {
                $errors[] = 'Invalid or expired reset token';
            }
        }

        if (!empty($errors)) {
            $this->view('auth/reset_password', [
                'errors' => $errors,
                'token' => $token
            ]);
            return;
        }

        $user = $userModel->findByEmail($email);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $userModel->updateUser($user['id'], ['password' => $hashedPassword]);

        flashMessage('flash_success', 'Password reset successful! Please login.');
        redirect(BASE_URL . 'login');
    }

    public function checkEmail() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $userModel = new User();
        jsonResponse(['exists' => (bool)$userModel->findByEmail($email)]);
    }

    public function checkUsername() {
        $username = trim($_POST['username'] ?? '');
        $stmt = (new User())->pdo->prepare("SELECT COUNT(*) FROM " . TABLE_USERS . " WHERE username = :username");
        $stmt->execute(['username' => $username]);
        jsonResponse(['exists' => $stmt->fetchColumn() > 0]);
    }
}
