<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class Transaction extends BaseModel {
    protected $table = TABLE_TRANSACTIONS;
    
    public function __construct() {
        parent::__construct(TABLE_TRANSACTIONS);
    }
    
    public function getTotalBalance($userId) {
        $stmt = $this->pdo->prepare("
            SELECT 
                COALESCE(SUM(CASE WHEN type = :income THEN amount ELSE 0 END), 0) -
                COALESCE(SUM(CASE WHEN type = :expense THEN amount ELSE 0 END), 0) as balance
            FROM " . TABLE_TRANSACTIONS . " 
            WHERE user_id = :user_id
        ");
        $stmt->execute([
            'user_id' => $userId,
            'income' => TRANSACTION_TYPE_INCOME,
            'expense' => TRANSACTION_TYPE_EXPENSE
        ]);
        return $stmt->fetchColumn();
    }
    
    public function getMonthlyIncome($userId, $month, $year) {
        $stmt = $this->pdo->prepare("
            SELECT COALESCE(SUM(amount), 0) FROM " . TABLE_TRANSACTIONS . " 
            WHERE user_id = :user_id AND type = :type 
            AND MONTH(date) = :month AND YEAR(date) = :year
        ");
        $stmt->execute([
            'user_id' => $userId,
            'type' => TRANSACTION_TYPE_INCOME,
            'month' => $month,
            'year' => $year
        ]);
        return $stmt->fetchColumn();
    }
    
    public function getMonthlyExpense($userId, $month, $year) {
        $stmt = $this->pdo->prepare("
            SELECT COALESCE(SUM(amount), 0) FROM " . TABLE_TRANSACTIONS . " 
            WHERE user_id = :user_id AND type = :type 
            AND MONTH(date) = :month AND YEAR(date) = :year
        ");
        $stmt->execute([
            'user_id' => $userId,
            'type' => TRANSACTION_TYPE_EXPENSE,
            'month' => $month,
            'year' => $year
        ]);
        return $stmt->fetchColumn();
    }
    
    public function getRecentTransactions($userId, $limit = 10) {
        $stmt = $this->pdo->prepare("
            SELECT t.*, c.name as category_name, c.color as category_color 
            FROM " . TABLE_TRANSACTIONS . " t 
            LEFT JOIN " . TABLE_CATEGORIES . " c ON t.category_id = c.id 
            WHERE t.user_id = :user_id 
            ORDER BY t.date DESC, t.id DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getCategoryWiseExpense($userId, $month, $year) {
        $stmt = $this->pdo->prepare("
            SELECT c.name, c.color, COALESCE(SUM(t.amount), 0) as total 
            FROM " . TABLE_CATEGORIES . " c
            LEFT JOIN " . TABLE_TRANSACTIONS . " t ON c.id = t.category_id 
            WHERE c.user_id = :user_id AND c.type = :type 
            AND MONTH(t.date) = :month AND YEAR(t.date) = :year
            GROUP BY c.id, c.name, c.color
            ORDER BY total DESC
        ");
        $stmt->execute([
            'user_id' => $userId,
            'type' => CATEGORY_TYPE_EXPENSE,
            'month' => $month,
            'year' => $year
        ]);
        return $stmt->fetchAll();
    }
    
    public function getMonthlyTrend($userId, $months = 6) {
        $stmt = $this->pdo->prepare("
            SELECT 
                DATE_FORMAT(date, '%Y-%m') as month,
                SUM(CASE WHEN type = :income THEN amount ELSE 0 END) as income,
                SUM(CASE WHEN type = :expense THEN amount ELSE 0 END) as expense
            FROM " . TABLE_TRANSACTIONS . " 
            WHERE user_id = :user_id 
            AND date >= DATE_SUB(NOW(), INTERVAL :months MONTH)
            GROUP BY DATE_FORMAT(date, '%Y-%m')
            ORDER BY month ASC
        ");
        $stmt->execute([
            'user_id' => $userId,
            'income' => TRANSACTION_TYPE_INCOME,
            'expense' => TRANSACTION_TYPE_EXPENSE,
            'months' => $months
        ]);
        return $stmt->fetchAll();
    }
}
