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

    <h5 class="mb-3">Reset Password</h5>
    <?php if (isset($errors) && !empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><i class="bi bi-x-circle-fill me-1"></i><?php echo htmlspecialchars($error); ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    <form method="POST" action="<?php echo BASE_URL; ?>reset-password" id="reset-password-form" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token ?? ''); ?>">
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-lock label-icon"></i> New Password
            </label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Min 6 characters" required minlength="<?php echo PASSWORD_MIN_LENGTH; ?>">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">
                <i class="bi bi-check2-circle label-icon"></i> Confirm Password
            </label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
    </form>
    <div class="mt-3 text-center">
        <p>Remember your password? <a href="<?php echo BASE_URL; ?>login">Login</a></p>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
