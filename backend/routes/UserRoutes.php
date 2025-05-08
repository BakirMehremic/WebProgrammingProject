<?php

/**
 * @OA\Get(
 *     path="/user/email/{email}",
 *     tags={"user"},
 *     summary="Get user by email",
 *     @OA\Parameter(name="email", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="User data")
 * )
 */
Flight::route('GET /user/email/@email', function($email){
    Flight::json(Flight::userService()->getByEmail($email));
});

/**
 * @OA\Post(
 *     path="/user",
 *     tags={"user"},
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string"),
 *             @OA\Property(property="role", type="string", example="customer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User created")
 * )
 */
Flight::route('POST /user', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->createUser($data['name'], $data['email'], $data['password'], $data['role'] ?? 'customer'));
});

/**
 * @OA\Put(
 *     path="/user/{id}",
 *     tags={"user"},
 *     summary="Edit user details",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="role", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User updated")
 * )
 */
Flight::route('PUT /user/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->editUser($id, $data['name'], $data['email'], $data['role']));
});

/**
 * @OA\Delete(
 *     path="/user/{id}",
 *     tags={"user"},
 *     summary="Delete a user",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="User deleted")
 * )
 */
Flight::route('DELETE /user/@id', function($id){
    Flight::json(Flight::userService()->deleteUser($id));
});


?>