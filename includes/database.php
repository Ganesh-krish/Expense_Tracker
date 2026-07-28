<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

// Include middleware
require_once ROOT_PATH . 'middleware/AuthMiddleware.php';

// Include all controllers
$controllers = [
    'BaseController',
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
    'BaseModel',
    'User',
    'PasswordReset',
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
