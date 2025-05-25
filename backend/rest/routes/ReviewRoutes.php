<?php
/**
 * @OA\Get(
 *     path="/review/product/{product_id}",
 *     tags={"review"},
 *     summary="Get reviews for a product",
 *     @OA\Parameter(name="product_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="List of reviews")
 * )
 */
Flight::route('GET /review/product/@product_id', function($product_id){
    Flight::json(Flight::reviewService()->getByProductId($product_id));
});

/**
 * @OA\Get(
 *     path="/review/user/{user_id}",
 *     tags={"review"},
 *     summary="Get reviews by a user",
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="List of reviews")
 * )
 */
Flight::route('GET /review/user/@user_id', function($user_id){
    Flight::json(Flight::reviewService()->getByUserId($user_id));
});

/**
 * @OA\Post(
 *     path="/review",
 *     tags={"review"},
 *     summary="Create a new review",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "product_id", "rating", "review_text"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="rating", type="integer"),
 *             @OA\Property(property="review_text", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Review created")
 * )
 */
Flight::route('POST /review', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->createReview($data['user_id'], $data['product_id'], $data['rating'], $data['review_text']));
});

/**
 * @OA\Put(
 *     path="/review/{id}",
 *     tags={"review"},
 *     summary="Update a review",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="rating", type="integer"),
 *             @OA\Property(property="review_text", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Review updated")
 * )
 */
Flight::route('PUT /review/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->updateReview($id, $data['rating'], $data['review_text']));
});

/**
 * @OA\Delete(
 *     path="/review/{id}",
 *     tags={"review"},
 *     summary="Delete a review",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Review deleted")
 * )
 */
Flight::route('DELETE /review/@id', function($id){
    Flight::json(Flight::reviewService()->deleteReview($id));
});


?>