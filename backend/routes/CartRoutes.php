<?php
/**
 * @OA\Get(
 *     path="/cart/{user_id}",
 *     tags={"cart"},
 *     summary="Get cart by user ID",
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Cart for the given user")
 * )
 */
Flight::route('GET /cart/@user_id', function($user_id){
    Flight::json(Flight::cartService()->getByUserId($user_id));
});

/**
 * @OA\Post(
 *     path="/cart",
 *     tags={"cart"},
 *     summary="Create a new cart for a user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(@OA\Property(property="user_id", type="integer"))
 *     ),
 *     @OA\Response(response=200, description="New cart created")
 * )
 */
Flight::route('POST /cart', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->createCart($data['user_id']));
});

/**
 * @OA\Put(
 *     path="/cart/{cart_id}",
 *     tags={"cart"},
 *     summary="Update user associated with a cart",
 *     @OA\Parameter(name="cart_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(@OA\Property(property="user_id", type="integer"))
 *     ),
 *     @OA\Response(response=200, description="Cart updated")
 * )
 */
Flight::route('PUT /cart/@cart_id', function($cart_id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartService()->updateCartUser($cart_id, $data['user_id']));
});

/**
 * @OA\Delete(
 *     path="/cart/{cart_id}",
 *     tags={"cart"},
 *     summary="Delete a cart",
 *     @OA\Parameter(name="cart_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Cart deleted")
 * )
 */
Flight::route('DELETE /cart/@cart_id', function($cart_id){
    Flight::json(Flight::cartService()->deleteCart($cart_id));
});

?>