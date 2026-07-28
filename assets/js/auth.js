// Auth.js
$(document).ready(function() {
    // Login form validation
    $('#login-form').submit(function(e) {
        e.preventDefault();
        
        var email = $('#email').val();
        var password = $('#password').val();
        
        if (!email || !password) {
            alert('Please fill all fields');
            return;
        }
        
        $.post('<?php echo BASE_URL; ?>login', $(this).serialize(), function(response) {
            if (response.success) {
                window.location.href = '<?php echo BASE_URL; ?>dashboard';
            } else {
                alert(response.message || 'Login failed');
            }
        }).fail(function() {
            alert('Login failed. Please try again.');
        });
    });
    
    // Register form validation
    $('#register-form').submit(function(e) {
        e.preventDefault();
        
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();
        
        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }
        
        if (password.length < 6) {
            alert('Password must be at least 6 characters');
            return;
        }
        
        $.post('<?php echo BASE_URL; ?>register', $(this).serialize(), function(response) {
            if (response.success) {
                window.location.href = '<?php echo BASE_URL; ?>dashboard';
            } else {
                alert(response.message || 'Registration failed');
            }
        }).fail(function() {
            alert('Registration failed. Please try again.');
        });
    });
    
    // Forgot password form
    $('#forgot-password-form').submit(function(e) {
        e.preventDefault();
        $.post('<?php echo BASE_URL; ?>forgot-password', $(this).serialize(), function(response) {
            alert(response.message);
            if (response.success) {
                window.location.href = '<?php echo BASE_URL; ?>login';
            }
        });
    });
    
    // Reset password form
    $('#reset-password-form').submit(function(e) {
        e.preventDefault();
        
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();
        
        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }
        
        $.post('<?php echo BASE_URL; ?>reset-password', $(this).serialize(), function(response) {
            if (response.success) {
                window.location.href = '<?php echo BASE_URL; ?>login';
            } else {
                alert(response.message);
            }
        });
    });
    
    // Check email availability
    $('#email').on('blur', function() {
        var email = $(this).val();
        if (email) {
            $.post('<?php echo BASE_URL; ?>auth/check-email', { email: email }, function(response) {
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
            $.post('<?php echo BASE_URL; ?>auth/check-username', { username: username }, function(response) {
                if (response.exists) {
                    alert('Username already taken');
                }
            });
        }
    });
});
