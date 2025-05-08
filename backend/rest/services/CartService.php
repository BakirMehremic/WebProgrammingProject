<?php
require_once "BaseService.php";
require_once __DIR__ . '/../dao/CartDao.php'; 


class CartService extends BaseService {
    public function __construct() {
        parent::__construct(new CartDao());
    }

    public function getByUserId($user_id) {
        if (empty($user_id)) {
            throw new Exception("User ID is required.");
        }
        return $this->dao->getByUserId($user_id);
    }

    public function createCart($user_id) {
        if (empty($user_id)) {
            throw new Exception("User ID is required.");
        }
        return $this->dao->createCart($user_id);
    }

    public function updateCartUser($cart_id, $user_id) {
        if (empty($cart_id) || empty($user_id)) {
            throw new Exception("Cart ID and User ID are required.");
        }
        return $this->dao->updateCartUser($cart_id, $user_id);
    }

    public function deleteCart($cart_id) {
        if (empty($cart_id)) {
            throw new Exception("Cart ID is required.");
        }
        return $this->dao->deleteCart($cart_id);
    }
}

?>