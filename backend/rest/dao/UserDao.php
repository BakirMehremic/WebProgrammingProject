<?php
require_once __DIR__ . '/BaseDao.php';


class UserDao extends BaseDao{
    public function __construct() {
        parent::__construct("users");
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getById($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createUser($name, $email, $password, $role = 'customer') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->connection->prepare(
            "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)"
        );
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role' => $role
        ]);
    }

    public function editUser($user_id, $name, $email, $role) {
        $stmt = $this->connection->prepare(
            "UPDATE users SET name = :name, email = :email, role = :role WHERE user_id = :user_id"
        );
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':role' => $role,
            ':user_id' => $user_id
        ]);
    }

    public function deleteUser($user_id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE user_id = :user_id");
        return $stmt->execute([':user_id' => $user_id]);
    }
 
}
?>