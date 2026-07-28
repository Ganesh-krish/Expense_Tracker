<?php require_once VIEWS_PATH . 'auth/header.php'; ?>

<div class="auth-body">
    <h5 class="mb-3">Create an account</h5>
    <form method="POST" action="<?php echo BASE_URL; ?>register">
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <div class="mt-3 text-center">
        <p>Already have an account? <a href="<?php echo BASE_URL; ?>login">Login</a></p>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
