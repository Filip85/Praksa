<?php

final class App {
    public static function start() {
        //$path = $_SERVER['REQUEST_URI'];
        $path = Request::pathInfo();

        $path = trim($path, '/');
        $parts = explode('/', $path);
        var_dump($parts);

        if(!isset($parts[0]) || empty($parts[0])) {
            $controller = 'Index';
        }
        else {
            $controller = ucfirst(strtolower($parts[0]));
        }

        $controller .= 'Controller';

        if(!isset($parts[1]) || empty($parts[1])) {
            $action = 'index';
        }
        else {
            $action = strtolower($parts[1]);
        }

        var_dump($controller);
        var_dump($action);

        if(class_exists($controller) && method_exists($controller, $action)) {
            $IController = new $controller;
            $IController->$action();
        }
    }
}