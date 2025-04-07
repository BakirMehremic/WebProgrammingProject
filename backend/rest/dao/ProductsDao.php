<?php 
class ProductsDao extends BaseDao {
    public function __construct() {
        parent::__construct("products");
    }

    public function getById($product_id) {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createProduct($name, $description, $price, $stock_quantity) {
        $stmt = $this->connection->prepare(
            "INSERT INTO products (name, description, price, stock_quantity) 
            VALUES (:name, :description, :price, :stock_quantity)"
        );
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':stock_quantity' => $stock_quantity
        ]);
    }

    public function updateProduct($product_id, $name, $description, $price, $stock_quantity) {
        $stmt = $this->connection->prepare(
            "UPDATE products SET name = :name, description = :description, price = :price, stock_quantity = :stock_quantity 
            WHERE product_id = :product_id"
        );
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':stock_quantity' => $stock_quantity,
            ':product_id' => $product_id
        ]);
    }

    public function deleteProduct($product_id) {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE product_id = :product_id");
        return $stmt->execute([':product_id' => $product_id]);
    }
}
?>
