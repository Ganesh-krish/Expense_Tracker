<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class IncomeController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        // TODO: Load income list with filters
        $this->view('incomes/index');
    }
    
    public function create() {
        AuthMiddleware::check();
        $this->view('incomes/create');
    }
    
    public function store() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Validate and save income
        jsonResponse(['success' => true, 'message' => 'Income added successfully']);
    }
    
    public function edit() {
        AuthMiddleware::check();
        // TODO: Load income for editing
        $this->view('incomes/edit');
    }
    
    public function update() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Validate and update income
        jsonResponse(['success' => true, 'message' => 'Income updated successfully']);
    }
    
    public function destroy() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Delete income
        jsonResponse(['success' => true, 'message' => 'Income deleted successfully']);
    }
    
    public function getCategories() {
        AuthMiddleware::check();
        // TODO: Return income categories
        jsonResponse(['categories' => []]);
    }
}
