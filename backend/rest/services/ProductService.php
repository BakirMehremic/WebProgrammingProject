<?php
require_once "BaseService.php";
require_once __DIR__ . '/../dao/ProductsDao.php'; 


class ProductService extends BaseService {
    public function __construct() {
        parent::__construct(new ProductsDao());
    }

    public function createProduct($name, $description, $price, $stock_quantity) {
        if (empty($name) || empty($description)) {
            throw new Exception("Name and description are required.");
        }
        if ($price < 0 || $stock_quantity < 0) {
            throw new Exception("Price and stock quantity must be non-negative.");
        }
        return $this->dao->createProduct($name, $description, $price, $stock_quantity);
    }

    public function updateProduct($product_id, $name, $description, $price, $stock_quantity) {
        if (empty($product_id)) {
            throw new Exception("Product ID is required.");
        }
        if (empty($name) || empty($description)) {
            throw new Exception("Name and description are required.");
        }
        if ($price < 0 || $stock_quantity < 0) {
            throw new Exception("Price and stock quantity must be non-negative.");
        }
        return $this->dao->updateProduct($product_id, $name, $description, $price, $stock_quantity);
    }

    public function deleteProduct($product_id) {
        if (empty($product_id)) {
            throw new Exception("Product ID is required.");
        }
        return $this->dao->deleteProduct($product_id);
    }
}

?>