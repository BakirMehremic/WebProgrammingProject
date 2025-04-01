<?php 
class CartProductsDao extends BaseDao {
    public function __construct() {
        parent::__construct("cart_products");
    }

    public function getById($cart_product_id) {
        $stmt = $this->connection->prepare("SELECT * FROM cart_products WHERE cart_product_id = :cart_product_id");
        $stmt->bindParam(':cart_product_id', $cart_product_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByCartId($cart_id) {
        $stmt = $this->connection->prepare("SELECT * FROM cart_products WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createCartProduct($cart_id, $product_id, $quantity) {
        $stmt = $this->connection->prepare(
            "INSERT INTO cart_products (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)"
        );
        return $stmt->execute([
            ':cart_id' => $cart_id,
            ':product_id' => $product_id,
            ':quantity' => $quantity
        ]);
    }

    public function updateCartProduct($cart_product_id, $quantity) {
        $stmt = $this->connection->prepare(
            "UPDATE cart_products SET quantity = :quantity WHERE cart_product_id = :cart_product_id"
        );
        return $stmt->execute([
            ':quantity' => $quantity,
            ':cart_product_id' => $cart_product_id
        ]);
    }

    public function deleteCartProduct($cart_product_id) {
        $stmt = $this->connection->prepare("DELETE FROM cart_products WHERE cart_product_id = :cart_product_id");
        return $stmt->execute([':cart_product_id' => $cart_product_id]);
    }
}
?>
