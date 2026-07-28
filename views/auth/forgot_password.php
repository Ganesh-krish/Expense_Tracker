<?php require_once VIEWS_PATH . 'auth/header.php'; ?>

<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="auth-body">
    <h5 class="mb-3">Forgot Password</h5>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <p class="text-muted mb-3">Enter your email and we'll send you a reset link.</p>
    <form method="POST" action="<?php echo BASE_URL; ?>forgot-password" id="forgot-password-form">
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope label-icon"></i> Email
            </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
    </form>
    <div class="mt-3 text-center">
        <p>Remember your password? <a href="<?php echo BASE_URL; ?>login">Login</a></p>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
