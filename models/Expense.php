<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class Expense extends BaseModel {
    protected $table = TABLE_TRANSACTIONS;
    
    public function __construct() {
        parent::__construct(TABLE_TRANSACTIONS);
    }
    
    public function createExpense($userId, $data) {
        $data['user_id'] = $userId;
        $data['type'] = TRANSACTION_TYPE_EXPENSE;
        return $this->create($data);
    }
    
    public function updateExpense($id, $userId, $data) {
        $data['type'] = TRANSACTION_TYPE_EXPENSE;
        return $this->update($id, $data, $userId);
    }
    
    public function deleteExpense($id, $userId) {
        return $this->delete($id, $userId);
    }
    
    public function findById($id, $userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . TABLE_TRANSACTIONS . " WHERE id = :id AND user_id = :user_id AND type = :type");
        $stmt->execute([
            'id' => $id,
            'user_id' => $userId,
            'type' => TRANSACTION_TYPE_EXPENSE
        ]);
        return $stmt->fetch();
    }
    
    public function getAllExpenses($userId, $filters = [], $page = 1, $perPage = ITEMS_PER_PAGE) {
        $sql = "SELECT t.*, c.name as category_name, c.color as category_color FROM " . TABLE_TRANSACTIONS . " t 
                LEFT JOIN " . TABLE_CATEGORIES . " c ON t.category_id = c.id 
                WHERE t.user_id = :user_id AND t.type = :type";
        $params = ['user_id' => $userId, 'type' => TRANSACTION_TYPE_EXPENSE];
        
        // Apply filters
        if (!empty($filters['date_from'])) {
            $sql .= " AND t.date >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND t.date <= :date_to";
            $params['date_to'] = $filters['date_to'];
        }
        if (!empty($filters['category_id'])) {
            $sql .= " AND t.category_id = :category_id";
            $params['category_id'] = $filters['category_id'];
        }
        if (!empty($filters['amount_from'])) {
            $sql .= " AND t.amount >= :amount_from";
            $params['amount_from'] = $filters['amount_from'];
        }
        if (!empty($filters['amount_to'])) {
            $sql .= " AND t.amount <= :amount_to";
            $params['amount_to'] = $filters['amount_to'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND (t.description LIKE :search OR c.name LIKE :search)";
            $params['search'] = '%' . $filters['search'] . '%';
        }
        
        $sql .= " ORDER BY t.date DESC, t.id DESC";
        
        $offset = ($page - 1) * $perPage;
        $sql .= " LIMIT $offset, $perPage";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function getExpenseCount($userId, $filters = []) {
        $sql = "SELECT COUNT(*) as total FROM " . TABLE_TRANSACTIONS . " WHERE user_id = :user_id AND type = :type";
        $params = ['user_id' => $userId, 'type' => TRANSACTION_TYPE_EXPENSE];
        
        if (!empty($filters['date_from'])) {
            $sql .= " AND date >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $sql .= " AND date <= :date_to";
            $params['date_to'] = $filters['date_to'];
        }
        if (!empty($filters['category_id'])) {
            $sql .= " AND category_id = :category_id";
            $params['category_id'] = $filters['category_id'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND description LIKE :search";
            $params['search'] = '%' . $filters['search'] . '%';
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
}
