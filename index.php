<?php
echo ".htacces is improperly configured:"
echo $_SERVER['REQUEST_URI'];
die();
//This is not used, it is here for reference.
//require "vendor/autoload.php";
//require "robertsworkspace/helpers/bootstrap.php";
//$router = new Router($routes);
//$requestURI = $_SERVER["REQUEST_URI"];
//$requestURI = $router->trimURI($requestURI);
//require $router->direct($requestURI);