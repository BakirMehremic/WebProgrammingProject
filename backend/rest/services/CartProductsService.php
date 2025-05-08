<?php
require_once "BaseService.php";
require_once __DIR__ . '/../dao/CartProductsDao.php'; 


class CartProductsService extends BaseService {
    public function __construct() {
        parent::__construct(new CartProductsDao());
    }

    public function getByCartId($cart_id) {
        if (empty($cart_id)) {
            throw new Exception("Cart ID is required.");
        }
        return $this->dao->getByCartId($cart_id);
    }

    public function createCartProduct($cart_id, $product_id, $quantity) {
        if (empty($cart_id) || empty($product_id)) {
            throw new Exception("Cart ID and Product ID are required.");
        }
        if ($quantity <= 0) {
            throw new Exception("Quantity must be greater than 0.");
        }
        return $this->dao->createCartProduct($cart_id, $product_id, $quantity);
    }

    public function updateCartProduct($cart_product_id, $quantity) {
        if (empty($cart_product_id)) {
            throw new Exception("Cart Product ID is required.");
        }
        if ($quantity <= 0) {
            throw new Exception("Quantity must be greater than 0.");
        }
        return $this->dao->updateCartProduct($cart_product_id, $quantity);
    }

    public function deleteCartProduct($cart_product_id) {
        if (empty($cart_product_id)) {
            throw new Exception("Cart Product ID is required.");
        }
        return $this->dao->deleteCartProduct($cart_product_id);
    }
}

?>