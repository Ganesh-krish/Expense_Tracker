            </div>
        </div>
    <?php if (!isLoggedIn()): ?>
        <div class="auth-container">
    <?php endif; ?>
    <script src="<?php echo BASE_URL; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
    <?php if (isset($extraJs)) echo $extraJs; ?>
    <?php if (APP_DEBUG): ?>
        <script>console.log('Debug Mode: ' + <?php echo APP_DEBUG; ?>);</script>
    <?php endif; ?>
</body>
</html>
