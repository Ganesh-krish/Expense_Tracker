            <div class="auth-footer">
                <p class="text-muted">&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. All rights reserved.</p>
            </div>
        </div>
    </div>
    <script src="<?php echo BASE_URL; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/auth.js"></script>
    <?php if (isset($extraJs)) echo $extraJs; ?>
</body>
</html>
