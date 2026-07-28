// Auth.js
$(document).ready(function() {
    // Login form validation
    $('#login-form').on('submit', function(e) {
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var isValid = true;

        if (!email) {
            alert('Please enter your email');
            $('#email').focus();
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Please enter a valid email address');
            isValid = false;
        }

        if (!password) {
            alert('Please enter your password');
            $('#password').focus();
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Register form validation
    $('#register-form').on('submit', function(e) {
        var username = $('#username').val().trim();
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var confirmPassword = $('#confirm_password').val().trim();
        var isValid = true;

        if (!username || username.length < 3) {
            alert('Username must be at least 3 characters');
            $('#username').focus();
            isValid = false;
        }

        if (!email) {
            alert('Please enter your email');
            $('#email').focus();
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Please enter a valid email address');
            isValid = false;
        }

        if (!password) {
            alert('Please enter a password');
            $('#password').focus();
            isValid = false;
        } else if (password.length < 6) {
            alert('Password must be at least 6 characters');
            isValid = false;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match');
            $('#confirm_password').focus();
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Forgot password form validation
    $('#forgot-password-form').on('submit', function(e) {
        var email = $('#email').val().trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Please enter a valid email address');
            e.preventDefault();
            $('#email').focus();
        }
    });

    // Reset password form validation
    $('#reset-password-form').on('submit', function(e) {
        var password = $('#password').val().trim();
        var confirmPassword = $('#confirm_password').val().trim();
        var isValid = true;

        if (!password) {
            alert('Please enter a password');
            $('#password').focus();
            isValid = false;
        } else if (password.length < 6) {
            alert('Password must be at least 6 characters');
            isValid = false;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match');
            $('#confirm_password').focus();
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Check email availability
    $('#email').on('blur', function() {
        var email = $(this).val();
        if (email) {
            $.post('<?php echo BASE_URL; ?>auth/check-email', { email: email, csrf_token: '<?php echo csrfToken(); ?>' }, function(response) {
                if (response.exists) {
                    alert('Email already registered');
                }
            });
        }
    });

    // Check username availability
    $('#username').on('blur', function() {
        var username = $(this).val();
        if (username) {
            $.post('<?php echo BASE_URL; ?>auth/check-username', { username: username, csrf_token: '<?php echo csrfToken(); ?>' }, function(response) {
                if (response.exists) {
                    alert('Username already taken');
                }
            });
        }
    });
});
