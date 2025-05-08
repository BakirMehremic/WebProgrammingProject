<?php

/**
 * @OA\Post(
 *     path="/product",
 *     tags={"product"},
 *     summary="Create a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "description", "price", "stock_quantity"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="price", type="number", format="float"),
 *             @OA\Property(property="stock_quantity", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Product created")
 * )
 */
Flight::route('POST /product', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data['name'], $data['description'], $data['price'], $data['stock_quantity']));
});

/**
 * @OA\Put(
 *     path="/product/{id}",
 *     tags={"product"},
 *     summary="Update an existing product",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "description", "price", "stock_quantity"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="price", type="number", format="float"),
 *             @OA\Property(property="stock_quantity", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Product updated")
 * )
 */
Flight::route('PUT /product/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->updateProduct($id, $data['name'], $data['description'], $data['price'], $data['stock_quantity']));
});

/**
 * @OA\Delete(
 *     path="/product/{id}",
 *     tags={"product"},
 *     summary="Delete a product",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Product deleted")
 * )
 */
Flight::route('DELETE /product/@id', function($id){
    Flight::json(Flight::productService()->deleteProduct($id));
});


?>