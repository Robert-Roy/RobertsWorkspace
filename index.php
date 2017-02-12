<?php
require "robertsworkspace/helpers/bootstrap.php";
$router = new Router($routes);
// For Local Testing
$requestURI = $_SERVER["REQUEST_URI"];
$requestURI = str_replace("RobertsWorkspace/", "", $requestURI);
$requestURI = trim($requestURI, "/");

require $router->direct($requestURI);