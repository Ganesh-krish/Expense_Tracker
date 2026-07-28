<?php require_once VIEWS_PATH . 'auth/header.php'; ?>

<div class="auth-body">
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i>
            <?php echo htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-1"></i>
            <?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <h5 class="mb-3">Login to your account</h5>
    <form method="POST" action="<?php echo BASE_URL; ?>login" id="login-form" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope label-icon"></i> Email
            </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required autofocus
                   value="<?php echo htmlspecialchars($email ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-lock label-icon"></i> Password
            </label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="mt-3 text-center">
        <a href="<?php echo BASE_URL; ?>forgot-password">Forgot Password?</a>
        <p class="mt-2">Don't have an account? <a href="<?php echo BASE_URL; ?>register">Register</a></p>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
