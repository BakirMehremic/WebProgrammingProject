<?php 
class ReviewsDao extends BaseDao {
    public function __construct() {
        parent::__construct("reviews");
    }

    public function getById($review_id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE review_id = :review_id");
        $stmt->bindParam(':review_id', $review_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByProductId($product_id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createReview($user_id, $product_id, $rating, $review_text) {
        $stmt = $this->connection->prepare(
            "INSERT INTO reviews (user_id, product_id, rating, review_text) 
            VALUES (:user_id, :product_id, :rating, :review_text)"
        );
        return $stmt->execute([
            ':user_id' => $user_id,
            ':product_id' => $product_id,
            ':rating' => $rating,
            ':review_text' => $review_text
        ]);
    }

    public function updateReview($review_id, $rating, $review_text) {
        $stmt = $this->connection->prepare(
            "UPDATE reviews SET rating = :rating, review_text = :review_text 
            WHERE review_id = :review_id"
        );
        return $stmt->execute([
            ':rating' => $rating,
            ':review_text' => $review_text,
            ':review_id' => $review_id
        ]);
    }

    public function deleteReview($review_id) {
        $stmt = $this->connection->prepare("DELETE FROM reviews WHERE review_id = :review_id");
        return $stmt->execute([':review_id' => $review_id]);
    }
}
?>
