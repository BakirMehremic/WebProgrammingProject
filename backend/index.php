<?php
require 'vendor/autoload.php'; //run autoloader
require_once __DIR__ . '/routes/CartRoutes.php';
require_once __DIR__ . '/routes/CartProductsRoutes.php';
require_once __DIR__ . '/routes/ProductRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';


Flight::route('/', function(){  //define route and define function to handle request
   echo 'Hello world!';
});


Flight::start();  //start FlightPHP
?>
