<?php
$routes = [
    // Auth Routes
    'GET:login' => 'AuthController@showLogin',
    'POST:login' => 'AuthController@login',
    'GET:register' => 'AuthController@showRegister',
    'POST:register' => 'AuthController@register',
    'GET:logout' => 'AuthController@logout',
    'GET:forgot-password' => 'AuthController@showForgotPassword',
    'POST:forgot-password' => 'AuthController@forgotPassword',
    'GET:reset-password' => 'AuthController@showResetPassword',
    'POST:reset-password' => 'AuthController@resetPassword',
    
    // Dashboard
    'GET:dashboard' => 'DashboardController@index',
    'POST:dashboard/quick-add-expense' => 'DashboardController@quickAddExpense',
    'POST:dashboard/quick-add-income' => 'DashboardController@quickAddIncome',
    'GET:dashboard/get-categories' => 'DashboardController@getCategories',
    'POST:dashboard/refresh-data' => 'DashboardController@refreshData',
    
    // Expenses
    'GET:expenses' => 'ExpenseController@index',
    'GET:expenses/create' => 'ExpenseController@create',
    'POST:expenses' => 'ExpenseController@store',
    'GET:expenses/edit' => 'ExpenseController@edit',
    'PUT:expenses' => 'ExpenseController@update',
    'DELETE:expenses' => 'ExpenseController@destroy',
    'GET:expenses/categories' => 'ExpenseController@getCategories',
    'POST:expenses/upload-receipt' => 'ExpenseController@uploadReceipt',
    'DELETE:expenses/delete-receipt' => 'ExpenseController@deleteReceipt',
    
    // Incomes
    'GET:incomes' => 'IncomeController@index',
    'GET:incomes/create' => 'IncomeController@create',
    'POST:incomes' => 'IncomeController@store',
    'GET:incomes/edit' => 'IncomeController@edit',
    'PUT:incomes' => 'IncomeController@update',
    'DELETE:incomes' => 'IncomeController@destroy',
    'GET:incomes/categories' => 'IncomeController@getCategories',
    
    // Categories
    'GET:categories' => 'CategoryController@index',
    'GET:categories/create' => 'CategoryController@create',
    'POST:categories' => 'CategoryController@store',
    'GET:categories/edit' => 'CategoryController@edit',
    'PUT:categories' => 'CategoryController@update',
    'DELETE:categories' => 'CategoryController@destroy',
    'GET:categories/get-by-type' => 'CategoryController@getByType',
    'POST:categories/check-name' => 'CategoryController@checkName',
    
    // Reports
    'GET:reports' => 'ReportController@index',
    'GET:reports/expense' => 'ReportController@expenseReport',
    'GET:reports/income' => 'ReportController@incomeReport',
    'GET:reports/monthly' => 'ReportController@monthlyReport',
    'GET:reports/export/csv' => 'ReportController@exportCsv',
    'GET:reports/export/pdf' => 'ReportController@exportPdf',
    'GET:reports/data' => 'ReportController@getData',
    'GET:reports/categories' => 'ReportController@getCategories',
    
    // Users
    'GET:profile' => 'UserController@profile',
    'POST:profile/update' => 'UserController@updateProfile',
    'POST:profile/change-password' => 'UserController@changePassword',
    'POST:profile/delete-account' => 'UserController@deleteAccount',
    'POST:users/upload-avatar' => 'UserController@uploadAvatar',
    'DELETE:users/delete-avatar' => 'UserController@deleteAvatar',
    
    // Settings
    'GET:settings' => 'SettingController@index',
    'POST:settings/update' => 'SettingController@update',
    'GET:settings/export' => 'SettingController@export',
    'POST:settings/clear-data' => 'SettingController@clearData',
    'GET:settings/get' => 'SettingController@get',
    'POST:settings/update' => 'SettingController@update',
    
    // Search
    'GET:search' => 'SearchController@index',
    'GET:search/suggestions' => 'SearchController@suggestions',
    'GET:search/results' => 'SearchController@results',
    'POST:search/advanced' => 'SearchController@advanced',
    'GET:search/categories' => 'SearchController@getCategories',
    
    // Budgets
    'GET:budgets' => 'BudgetController@index',
    'GET:budgets/create' => 'BudgetController@create',
    'POST:budgets' => 'BudgetController@store',
    'GET:budgets/edit' => 'BudgetController@edit',
    'PUT:budgets' => 'BudgetController@update',
    'DELETE:budgets' => 'BudgetController@destroy',
    'GET:budgets/progress' => 'BudgetController@getProgress',
    'GET:budgets/alerts' => 'BudgetController@checkAlerts',
    'GET:budgets/categories' => 'BudgetController@getCategories'
];

function matchRoute($method, $url) {
    global $routes;
    $key = $method . ':' . $url;
    return $routes[$key] ?? null;
}
