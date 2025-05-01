<?php
require_once "BaseService.php";
require_once __DIR__ . '/../dao/UserDao.php'; 

class UserService extends BaseService {
    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function getByEmail($email) {
        if (empty($email)) {
            throw new Exception("Email is required.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        return $this->dao->getByEmail($email);
    }

    public function createUser($name, $email, $password, $role = 'customer') {
        if (empty($name) || empty($email) || empty($password)) {
            throw new Exception("Name, email, and password are required.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        return $this->dao->createUser($name, $email, $password, $role);
    }

    public function editUser($user_id, $name, $email, $role) {
        if (empty($user_id) || empty($name) || empty($email)) {
            throw new Exception("User ID, name, and email are required.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        return $this->dao->editUser($user_id, $name, $email, $role);
    }

    public function deleteUser($user_id) {
        if (empty($user_id)) {
            throw new Exception("User ID is required.");
        }
        return $this->dao->deleteUser($user_id);
    }
}

?>