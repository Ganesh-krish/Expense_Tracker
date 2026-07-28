<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class SearchController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        $this->view('search/index');
    }
    
    public function suggestions() {
        AuthMiddleware::check();
        // TODO: Return search suggestions
        jsonResponse(['suggestions' => []]);
    }
    
    public function results() {
        AuthMiddleware::check();
        // TODO: Return search results
        jsonResponse(['results' => []]);
    }
    
    public function advanced() {
        AuthMiddleware::check();
        verifyCsrf();
        // TODO: Apply advanced filters
        jsonResponse(['results' => []]);
    }
    
    public function getCategories() {
        AuthMiddleware::check();
        // TODO: Return all categories
        jsonResponse(['categories' => []]);
    }
}
