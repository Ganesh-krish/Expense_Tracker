<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class Category extends BaseModel {
    protected $table = TABLE_CATEGORIES;
    
    public function __construct() {
        parent::__construct(TABLE_CATEGORIES);
    }
    
    public function getByType($userId, $type) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . TABLE_CATEGORIES . " WHERE user_id = :user_id AND type = :type ORDER BY name ASC");
        $stmt->execute([
            'user_id' => $userId,
            'type' => $type
        ]);
        return $stmt->fetchAll();
    }
    
    public function getAll($userId) {
        return $this->findAll(['user_id' => $userId], 'name ASC');
    }
    
    public function isDefault($id) {
        $stmt = $this->pdo->prepare("SELECT is_default FROM " . TABLE_CATEGORIES . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $category = $stmt->fetch();
        return $category && $category['is_default'] == STATUS_ACTIVE;
    }
    
    public function getDefaultCategories() {
        return $this->findAll(['is_default' => STATUS_ACTIVE, 'user_id' => null], 'name ASC');
    }
    
    public function create($userId, $data) {
        $data['user_id'] = $userId;
        return parent::create($data);
    }
    
    public function update($id, $userId, $data) {
        return parent::update($id, $data, $userId);
    }
    
    public function delete($id, $userId) {
        return parent::delete($id, $userId);
    }
}
