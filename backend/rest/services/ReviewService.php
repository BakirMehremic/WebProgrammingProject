<?php
require_once "BaseService.php";
require_once __DIR__ . '/../dao/ReviewsDao.php'; 


class ReviewService extends BaseService {
    public function __construct() {
        parent::__construct(new ReviewsDao());
    }

    public function getByProductId($product_id) {
        if (empty($product_id)) {
            throw new Exception("Product ID is required.");
        }
        return $this->dao->getByProductId($product_id);
    }

    public function getByUserId($user_id) {
        if (empty($user_id)) {
            throw new Exception("User ID is required.");
        }
        return $this->dao->getByUserId($user_id);
    }

    public function createReview($user_id, $product_id, $rating, $review_text) {
        if (empty($user_id) || empty($product_id)) {
            throw new Exception("User ID and Product ID are required.");
        }
        if ($rating < 1 || $rating > 5) {
            throw new Exception("Rating must be between 1 and 5.");
        }
        return $this->dao->createReview($user_id, $product_id, $rating, $review_text);
    }

    public function updateReview($review_id, $rating, $review_text) {
        if (empty($review_id)) {
            throw new Exception("Review ID is required.");
        }
        if ($rating < 1 || $rating > 5) {
            throw new Exception("Rating must be between 1 and 5.");
        }
        return $this->dao->updateReview($review_id, $rating, $review_text);
    }

    public function deleteReview($review_id) {
        if (empty($review_id)) {
            throw new Exception("Review ID is required.");
        }
        return $this->dao->deleteReview($review_id);
    }
}

?>