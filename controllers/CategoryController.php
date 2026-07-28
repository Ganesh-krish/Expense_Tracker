<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class CategoryController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        // TODO: Load categories list
        $this->view('categories/index');
    }
    
    public function create() {
        AuthMiddleware::check();
        $this->view('categories/create');
    }
    
    public function store() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Validate and create category
        jsonResponse(['success' => true, 'message' => 'Category created successfully']);
    }
    
    public function edit() {
        AuthMiddleware::check();
        // TODO: Load category for editing
        $this->view('categories/edit');
    }
    
    public function update() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Validate and update category
        jsonResponse(['success' => true, 'message' => 'Category updated successfully']);
    }
    
    public function destroy() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Delete category
        jsonResponse(['success' => true, 'message' => 'Category deleted successfully']);
    }
    
    public function getByType() {
        AuthMiddleware::check();
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_NUMBER_INT);
        // TODO: Return categories by type
        jsonResponse(['categories' => []]);
    }
    
    public function checkName() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Check if category name exists
        jsonResponse(['exists' => false]);
    }
}
