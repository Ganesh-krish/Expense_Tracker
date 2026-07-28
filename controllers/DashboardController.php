<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class DashboardController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        // TODO: Load dashboard data
        $this->view('dashboard/index');
    }
    
    public function quickAddExpense() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Handle quick add expense
        jsonResponse(['success' => true, 'message' => 'Expense added successfully']);
    }
    
    public function quickAddIncome() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Handle quick add income
        jsonResponse(['success' => true, 'message' => 'Income added successfully']);
    }
    
    public function getCategories() {
        AuthMiddleware::check();
        // TODO: Return categories by type
        jsonResponse(['categories' => []]);
    }
    
    public function refreshData() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Refresh dashboard data
        jsonResponse(['success' => true]);
    }
}
