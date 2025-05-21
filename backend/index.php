<?php
require 'vendor/autoload.php'; 

require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';


require_once __DIR__ . '/routes/AuthRoutes.php';  
require_once __DIR__ . '/routes/CartRoutes.php';
require_once __DIR__ . '/routes/CartProductsRoutes.php';
require_once __DIR__ . '/routes/ProductRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', 'AuthMiddleware');

Flight::route('GET /ping', function() {
    echo 'pong';
});


// Flight::route('/*', function () {
//     $url = Flight::request()->url;
    

//    if (str_contains($url, '/auth/login') || str_contains($url, '/auth/register')) {
//         return true;
//     }

//     try {
//         $token = Flight::request()->getHeader("Authentication");

//         if (!$token) {
//             Flight::halt(401, 'Missing Authentication token');
//         }

//         if (Flight::auth_middleware()->verifyToken($token)) {
//             return true;
//         } else {
//             Flight::halt(401, 'Invalid token');
//         }
//     } catch (Exception $e) {
//         Flight::halt(401, $e->getMessage());
//     }
// });

Flight::route('/', function () {
    echo 'Hello world!';
});

Flight::start();
