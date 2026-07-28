            </div>
        </div>
    <?php endif; ?>
    <?php if (!isLoggedIn()): ?>
        <div class="auth-container">
    <?php endif; ?>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
    <?php if (isset($extraJs)) echo $extraJs; ?>
    <?php if (APP_DEBUG): ?>
        <script>console.log('Debug Mode: ' + <?php echo APP_DEBUG; ?>);</script>
    <?php endif; ?>
</body>
</html>
