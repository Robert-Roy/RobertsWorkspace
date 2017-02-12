<?php
require "vendor/autoload.php";
require "robertsworkspace/helpers/bootstrap.php";
$router = new Router($routes);
$requestURI = $_SERVER["REQUEST_URI"];
$requestURI = $router->trimURI($requestURI);
require $router->direct($requestURI);