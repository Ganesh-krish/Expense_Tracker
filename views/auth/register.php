<?php $layout = 'form-brand'; ?>
<?php require_once VIEWS_PATH . 'auth/header.php'; ?>

<div class="auth-body">
    <?php if (isset($errors) && !empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><i class="bi bi-x-circle-fill me-1"></i><?php echo htmlspecialchars($error); ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    <h5 class="mb-3">Create an account</h5>
    <form method="POST" action="<?php echo BASE_URL; ?>register" id="register-form" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <div class="mb-3">
            <label for="username" class="form-label">
                <i class="bi bi-person label-icon"></i> Username
            </label>
            <input type="text" class="form-control" id="username" name="username" placeholder="johndoe" required
                   value="<?php echo htmlspecialchars($username ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope label-icon"></i> Email
            </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required
                   value="<?php echo htmlspecialchars($email ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-lock label-icon"></i> Password
            </label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Min 6 characters" required minlength="<?php echo PASSWORD_MIN_LENGTH; ?>">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">
                <i class="bi bi-check2-circle label-icon"></i> Confirm Password
            </label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="register-submit">Register</button>
    </form>
    <div id="register-loader" class="text-center mt-3" style="display:none;">
        <div class="spinner-border text-danger" role="status" style="width:1.2rem;height:1.2rem;"></div>
        <div class="mt-2 text-muted">Creating your account...</div>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
<script>
    document.getElementById('register-form').addEventListener('submit', function() {
        var btn = document.getElementById('register-submit');
        var loader = document.getElementById('register-loader');
        if (btn) btn.disabled = true;
        if (loader) loader.style.display = 'block';
    });
</script>
