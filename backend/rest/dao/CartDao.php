<?php 
require_once __DIR__ . '/BaseDao.php';

class CartDao extends BaseDao{
    public function __construct() {
        parent::__construct("users");
    }

    public function getById($cart_id) {
        $stmt = $this->connection->prepare("SELECT * FROM cart WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    
    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function createCart($user_id) {
        $stmt = $this->connection->prepare(
            "INSERT INTO cart (user_id) VALUES (:user_id)"
        );
        return $stmt->execute([':user_id' => $user_id]);
    }


    public function updateCartUser($cart_id, $user_id) {
        $stmt = $this->connection->prepare(
            "UPDATE cart SET user_id = :user_id WHERE cart_id = :cart_id"
        );
        return $stmt->execute([
            ':user_id' => $user_id,
            ':cart_id' => $cart_id
        ]);
    }


    public function deleteCart($cart_id) {
        $stmt = $this->connection->prepare("DELETE FROM cart WHERE cart_id = :cart_id");
        return $stmt->execute([':cart_id' => $cart_id]);
    }
}

?>