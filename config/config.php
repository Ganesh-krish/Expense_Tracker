<?php
// Application Configuration
return [
    'app_name' => 'Expense Tracker',
    'app_url' => 'http://localhost/expense_tracker',
    'base_url' => 'http://localhost/expense_tracker',
    'env' => 'development', // development | production
    'debug' => true,
    
    'jwt_secret' => 'your-secret-key-change-this-in-production-' . bin2hex(random_bytes(32)),
    'jwt_expiration' => 3600, // 1 hour in seconds
    'refresh_token_expiration' => 604800, // 7 days in seconds
    
    'session' => [
        'lifetime' => 86400, // 24 hours
        'path' => '/',
        'domain' => '',
        'secure' => false, // set true in production with HTTPS
        'httponly' => true,
        'samesite' => 'Lax'
    ],
    
    'pagination' => [
        'per_page' => 10,
        'per_page_options' => [10, 25, 50, 100]
    ],
    
    'upload' => [
        'max_file_size' => 2048, // KB (2MB)
        'allowed_image_types' => ['jpg', 'jpeg', 'png', 'gif'],
        'receipt_dir' => 'uploads/receipts/',
        'avatar_dir' => 'uploads/avatars/',
        'avatar_max_size' => 1024 // KB (1MB)
    ],
    
    'password' => [
        'min_length' => 6
    ],
    
    'email' => [
        'from_email' => 'noreply@expensetracker.com',
        'from_name' => 'Expense Tracker'
    ]
];
