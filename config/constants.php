<?php
// Constants Configuration
// Centralized constants for the application

// Table Names
define('TABLE_USERS', 'users');
define('TABLE_CATEGORIES', 'categories');
define('TABLE_TRANSACTIONS', 'transactions');
define('TABLE_BUDGETS', 'budgets');
define('TABLE_SETTINGS', 'settings');
define('TABLE_PASSWORD_RESETS', 'password_resets');

// Transaction Types
define('TRANSACTION_TYPE_INCOME', 1);
define('TRANSACTION_TYPE_EXPENSE', 2);

// Category Types
define('CATEGORY_TYPE_INCOME', 1);
define('CATEGORY_TYPE_EXPENSE', 2);

// User Roles
define('ROLE_USER', 1);
define('ROLE_ADMIN', 2);

// Recurring Frequencies
define('RECURRING_DAILY', 1);
define('RECURRING_WEEKLY', 2);
define('RECURRING_MONTHLY', 3);
define('RECURRING_YEARLY', 4);

// Status / Boolean
define('STATUS_ACTIVE', 1);
define('STATUS_INACTIVE', 0);
define('BOOLEAN_TRUE', 1);
define('BOOLEAN_FALSE', 0);

// Pagination
define('ITEMS_PER_PAGE', 10);
define('ITEMS_PER_PAGE_OPTIONS', [10, 25, 50, 100]);

// File Upload
define('MAX_FILE_SIZE', 2048); // KB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif']);
define('UPLOAD_DIR_RECEIPTS', 'uploads/receipts/');
define('UPLOAD_DIR_AVATARS', 'uploads/avatars/');

// Security
define('PASSWORD_MIN_LENGTH', 6);
define('CSRF_TOKEN_LENGTH', 32);
define('SESSION_LIFETIME', 86400);

// Currency
define('DEFAULT_CURRENCY', 'USD');
define('AVAILABLE_CURRENCIES', ['USD', 'EUR', 'GBP', 'INR', 'JPY', 'CAD', 'AUD']);

// Date Format
define('DEFAULT_DATE_FORMAT', 'Y-m-d');
define('AVAILABLE_DATE_FORMATS', ['Y-m-d', 'd-m-Y', 'm-d-Y', 'd/m/Y', 'm/d/Y']);

// Flash Messages
define('FLASH_SUCCESS', 'success');
define('FLASH_ERROR', 'error');
define('FLASH_WARNING', 'warning');
define('FLASH_INFO', 'info');
