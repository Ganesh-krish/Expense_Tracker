<?php require_once VIEWS_PATH . 'auth/header.php'; ?>

<div class="auth-body">
    <h5 class="mb-3">Login to your account</h5>
    <form method="POST" action="<?php echo BASE_URL; ?>login">
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
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
