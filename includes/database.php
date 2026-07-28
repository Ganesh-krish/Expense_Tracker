<?php
require_once 'config.php';
require_once 'database.php';
require_once 'functions.php';

// Include all controllers
$controllers = [
    'DashboardController',
    'AuthController',
    'ExpenseController',
    'IncomeController',
    'CategoryController',
    'ReportController',
    'UserController',
    'SettingController',
    'BudgetController',
    'SearchController'
];

foreach ($controllers as $controller) {
    $file = CONTROLLERS_PATH . $controller . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

// Include all models
$models = [
    'User',
    'Expense',
    'Income',
    'Category',
    'Transaction',
    'Budget',
    'Setting'
];

foreach ($models as $model) {
    $file = MODELS_PATH . $model . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
