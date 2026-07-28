<?php
require_once ROOT_PATH . 'config/database.php';
require_once ROOT_PATH . 'config/constants.php';

class PasswordReset extends BaseModel {
    protected $table = TABLE_PASSWORD_RESETS;

    public function __construct() {
        parent::__construct(TABLE_PASSWORD_RESETS);
    }

    public function createToken($email, $token) {
        $this->pdo->prepare("DELETE FROM " . $this->table . " WHERE email = :email")
            ->execute(['email' => $email]);
        return $this->create([
            'email' => $email,
            'token' => password_hash($token, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function findValidToken($email, $token) {
        $hashed = password_hash($token, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("
            SELECT * FROM " . $this->table . "
            WHERE email = :email
            AND created_at > NOW() - INTERVAL 1 HOUR
        ");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        if ($row && password_verify($token, $row['token'])) {
            return $row;
        }
        return false;
    }
}
