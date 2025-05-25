<?php

require 'vendor/autoload.php'; 

require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . "/rest/services/CartProductsService.php";
require_once __DIR__ . "/rest/services/CartService.php";
require_once __DIR__ . "/rest/services/ProductService.php";
require_once __DIR__ . "/rest/services/ReviewService.php";
require_once __DIR__ . "/rest/services/UserService.php";

require_once __DIR__ . '/middleware/AuthMiddleware.php';


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::register('auth_service', 'AuthService');
Flight::register('cartProductsService', 'CartProductsService'); 
Flight::register('cartService', 'CartService');
Flight::register('productService', 'ProductService');
Flight::register('reviewService', 'ReviewService');
Flight::register('userService', 'UserService');
Flight::register('auth_middleware', 'AuthMiddleware');


Flight::route('/*', function () {
    $request = Flight::request();

    // Allow public routes
    $publicRoutes = ['/auth/login', '/auth/register'];
    foreach ($publicRoutes as $route) {
        if (str_starts_with($request->url, $route)) {
            return true;
        }
    }

    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? null;

    if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
        Flight::halt(401, 'Missing or malformed Authorization header');
    }

    $token = substr($authHeader, 7); 

    try {
        if (Flight::auth_middleware()->verifyToken($token)) {
            return true;
        } else {
            Flight::halt(401, 'Invalid token');
        }
    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});



require_once __DIR__ . '/rest/routes/AuthRoutes.php';  
require_once __DIR__ . '/rest/routes/CartRoutes.php';
require_once __DIR__ . '/rest/routes/CartProductsRoutes.php';
require_once __DIR__ . '/rest/routes/ProductRoutes.php';
require_once __DIR__ . '/rest/routes/ReviewRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';




Flight::start();
?>