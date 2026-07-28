<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class User extends BaseModel {
    protected $table = TABLE_USERS;
    
    public function __construct() {
        parent::__construct(TABLE_USERS);
    }
    
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . TABLE_USERS . " WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
    
    public function findById($id) {
        return $this->findById($id);
    }
    
    public function create($data) {
        return parent::create($data);
    }
    
    public function update($id, $data, $userId = null) {
        return parent::update($id, $data, $userId);
    }
    
    public function delete($id, $userId = null) {
        return parent::delete($id, $userId);
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function generateRememberToken() {
        return bin2hex(random_bytes(60));
    }
    
    public function generateJwt($email, $role) {
        return generateJwt($_SESSION['user_id'], $email, $role);
    }
    
    public function validateJwt($token) {
        return validateJwt($token);
    }
    
    public function hasRole($role) {
        return $_SESSION['user_role'] === $role;
    }
}
