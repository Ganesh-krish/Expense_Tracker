<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class User extends BaseModel {
    protected $table = TABLE_USERS;

    public function __construct() {
        parent::__construct(TABLE_USERS);
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id, $userId = null) {
        return parent::findById($id, $userId);
    }

    public function createUser($data) {
        return $this->create($data);
    }

    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
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

    public function validateResetToken($token) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM " . TABLE_PASSWORD_RESETS . "
            WHERE created_at > NOW() - INTERVAL 1 HOUR
        ");
        $stmt->execute();
        $resets = $stmt->fetchAll();
        foreach ($resets as $reset) {
            if (password_verify($token, $reset['token'])) {
                $this->pdo->prepare("DELETE FROM " . TABLE_PASSWORD_RESETS . " WHERE id = :id")
                    ->execute(['id' => $reset['id']]);
                return $reset['email'];
            }
        }
        return false;
    }
}
