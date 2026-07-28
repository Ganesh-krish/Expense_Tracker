<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class ReportController extends BaseController {
    public function index() {
        AuthMiddleware::check();
        $this->view('reports/index');
    }
    
    public function expenseReport() {
        AuthMiddleware::check();
        $this->view('reports/expense_report');
    }
    
    public function incomeReport() {
        AuthMiddleware::check();
        $this->view('reports/income_report');
    }
    
    public function monthlyReport() {
        AuthMiddleware::check();
        $this->view('reports/monthly_report');
    }
    
    public function exportCsv() {
        AuthMiddleware::check();
        // TODO: Export CSV
    }
    
    public function exportPdf() {
        AuthMiddleware::check();
        // TODO: Export PDF
    }
    
    public function getData() {
        AuthMiddleware::check();
        // TODO: Return report data for AJAX
        jsonResponse(['data' => []]);
    }
    
    public function getCategories() {
        AuthMiddleware::check();
        // TODO: Return categories for filter
        jsonResponse(['categories' => []]);
    }
}
