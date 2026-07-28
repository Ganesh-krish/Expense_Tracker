<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class Setting extends BaseModel {
    protected $table = TABLE_SETTINGS;
    
    public function __construct() {
        parent::__construct(TABLE_SETTINGS);
    }
    
    public function getByKey($userId, $key) {
        $stmt = $this->pdo->prepare("SELECT value FROM " . TABLE_SETTINGS . " WHERE user_id = :user_id AND key_name = :key");
        $stmt->execute(['user_id' => $userId, 'key' => $key]);
        return $stmt->fetchColumn();
    }
    
    public function set($userId, $key, $value) {
        $stmt = $this->pdo->prepare("
            INSERT INTO " . TABLE_SETTINGS . " (user_id, key_name, value) 
            VALUES (:user_id, :key, :value)
            ON DUPLICATE KEY UPDATE value = :value
        ");
        return $stmt->execute(['user_id' => $userId, 'key' => $key, 'value' => $value]);
    }
}
