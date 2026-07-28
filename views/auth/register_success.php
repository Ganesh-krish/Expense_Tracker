<?php require_once VIEWS_PATH . 'auth/header.php'; ?>

<div class="auth-body text-center">
    <div class="success-state">
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h4 class="mt-3 mb-2">Registered successfully</h4>
        <p class="text-muted mb-0">Your account has been created. Redirecting you to the dashboard...</p>
    </div>
</div>

<?php require_once VIEWS_PATH . 'auth/footer.php'; ?>
<script>
    setTimeout(function() {
        window.location.href = '<?php echo BASE_URL; ?>dashboard';
    }, 2200);
</script>
