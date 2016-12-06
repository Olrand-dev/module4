<?php

session_start();
if (!isset($_SESSION["isLogged"])) {
    $_SESSION["isLogged"] = false;
}

if (isset($_COOKIE['msg'])) {setcookie('msg', '');}

require_once 'settings.php';
require_once 'autoload.php';
require_once 'Common/Storage.php';

$controller = 'category';
$action = 'catlist';
$parameters = null;


if(isset($_GET['route'])) {
    //echo $_GET['route'];

    $route = explode('/', $_GET['route']);
    if(isset($route[0])) {
        $controller = $route[0];
    }
    if(isset($route[1])) {
        $action = $route[1];
    }
    if(isset($route[2])) {
        $parameters = $route[2];
    }
}

$controllerName = '\\Controller\\' . ucfirst($controller) . 'Controller';

$controllerObj = new $controllerName();

if(is_callable(array($controllerObj, $action))) {
    $controllerObj->$action($parameters);
} else {
    $controllerObj->render404();
}

