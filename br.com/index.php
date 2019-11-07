<?php

require_once 'Core/autoLoader.php';

if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
    $splittedPath = explode('/', ltrim($path), 4);
    $controller = ucfirst($splittedPath[1]);
    $method = isset($splittedPath[2]) ? $splittedPath[2] : exit('----Page Not Found----');
    $parameters = explode('/', ltrim($splittedPath[3]));
    $requiredFile = __DIR__ . '/Controller/' . $controller . 'Controller.php';
    if (file_exists($requiredFile)) {
        $controllerClass = $controller . 'Controller';
        $controllerObject = new $controllerClass();
        $controllerObject->$method($parameters);
    } else {
        exit('----Page Not Found----');
    }
} else {
    $controllerClass = 'UserController';
    $controllerObject = new $controllerClass();
    $controllerObject->loadHomePage();
}
