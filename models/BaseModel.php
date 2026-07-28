<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class BaseModel {
    protected $pdo;
    protected $table;
    
    public function __construct($table = '') {
        global $pdo;
        $this->pdo = $pdo;
        $this->table = $table;
    }
    
    protected function findAll($conditions = [], $orderBy = '') {
        $sql = "SELECT * FROM " . $this->table;
        $params = [];
        
        if (!empty($conditions)) {
            $sql .= " WHERE ";
            $clauses = [];
            foreach ($conditions as $column => $value) {
                $clauses[] = "$column = :$column";
                $params[$column] = $value;
            }
            $sql .= implode(' AND ', $clauses);
        }
        
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    protected function findById($id, $userId = null) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $params = ['id' => $id];
        
        if ($userId !== null) {
            $sql .= " AND user_id = :user_id";
            $params['user_id'] = $userId;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    protected function create($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    
    protected function update($id, $data, $userId = null) {
        $set = [];
        $params = ['id' => $id];
        
        foreach ($data as $column => $value) {
            $set[] = "$column = :$column";
            $params[$column] = $value;
        }
        
        $sql = "UPDATE " . $this->table . " SET " . implode(', ', $set) . " WHERE id = :id";
        
        if ($userId !== null) {
            $sql .= " AND user_id = :user_id";
            $params['user_id'] = $userId;
        }
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    
    protected function delete($id, $userId = null) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $params = ['id' => $id];
        
        if ($userId !== null) {
            $sql .= " AND user_id = :user_id";
            $params['user_id'] = $userId;
        }
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
