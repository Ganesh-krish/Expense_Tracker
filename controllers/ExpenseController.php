<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class ExpenseController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        // TODO: Load expense list with filters
        $this->view('expenses/index');
    }
    
    public function create() {
        AuthMiddleware::check();
        $this->view('expenses/create');
    }
    
    public function store() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Validate and save expense
        jsonResponse(['success' => true, 'message' => 'Expense added successfully']);
    }
    
    public function edit() {
        AuthMiddleware::check();
        // TODO: Load expense for editing
        $this->view('expenses/edit');
    }
    
    public function update() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Validate and update expense
        jsonResponse(['success' => true, 'message' => 'Expense updated successfully']);
    }
    
    public function destroy() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Delete expense
        jsonResponse(['success' => true, 'message' => 'Expense deleted successfully']);
    }
    
    public function getCategories() {
        AuthMiddleware::check();
        // TODO: Return expense categories
        jsonResponse(['categories' => []]);
    }
    
    public function uploadReceipt() {
        AuthMiddleware::check();
        // TODO: Handle receipt upload
        jsonResponse(['success' => true, 'message' => 'Receipt uploaded']);
    }
    
    public function deleteReceipt() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Delete receipt
        jsonResponse(['success' => true, 'message' => 'Receipt deleted']);
    }
}
