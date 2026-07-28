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

    <h5 class="mb-3">Forgot Password</h5>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><i class="bi bi-x-circle-fill me-1"></i><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <p class="text-muted mb-3">Enter your email and we'll send you a reset link.</p>
    <form method="POST" action="<?php echo BASE_URL; ?>forgot-password" id="forgot-password-form" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope label-icon"></i> Email
            </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="forgot-submit">Send Reset Link</button>
    </form>
    <div id="forgot-loader" class="text-center mt-3" style="display:none;">
        <div class="spinner-border text-danger" role="status" style="width:1.2rem;height:1.2rem;"></div>
        <div class="mt-2 text-muted">Sending reset link...</div>
    </div>
    <div class="mt-3 text-center">
        <p>Remember your password? <a href="<?php echo BASE_URL; ?>login">Login</a></p>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
<script>
    document.getElementById('forgot-password-form').addEventListener('submit', function() {
        var btn = document.getElementById('forgot-submit');
        var loader = document.getElementById('forgot-loader');
        if (btn) btn.disabled = true;
        if (loader) loader.style.display = 'block';
    });
</script>
