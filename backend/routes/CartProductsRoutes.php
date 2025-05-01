<?php
/**
 * @OA\Get(
 *     path="/cart-product/{cart_id}",
 *     tags={"cart-product"},
 *     summary="Get all products in a cart",
 *     @OA\Parameter(
 *         name="cart_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         description="Cart ID"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of cart products"
 *     )
 * )
 */
Flight::route('GET /cart-product/@cart_id', function($cart_id){
    Flight::json(Flight::cartProductsService()->getByCartId($cart_id));
});

/**
 * @OA\Post(
 *     path="/cart-product",
 *     tags={"cart-product"},
 *     summary="Add a product to a cart",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"cart_id", "product_id", "quantity"},
 *             @OA\Property(property="cart_id", type="integer"),
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="quantity", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Cart product created")
 * )
 */
Flight::route('POST /cart-product', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartProductsService()->createCartProduct($data['cart_id'], $data['product_id'], $data['quantity']));
});

/**
 * @OA\Put(
 *     path="/cart-product/{id}",
 *     tags={"cart-product"},
 *     summary="Update quantity of a product in a cart",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(@OA\Property(property="quantity", type="integer"))
 *     ),
 *     @OA\Response(response=200, description="Cart product updated")
 * )
 */
Flight::route('PUT /cart-product/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::cartProductsService()->updateCartProduct($id, $data['quantity']));
});

/**
 * @OA\Delete(
 *     path="/cart-product/{id}",
 *     tags={"cart-product"},
 *     summary="Delete a product from cart",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Deleted")
 * )
 */
Flight::route('DELETE /cart-product/@id', function($id){
    Flight::json(Flight::cartProductsService()->deleteCartProduct($id));
});

?>