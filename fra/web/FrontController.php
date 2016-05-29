<?php

declare(strict_types = 1);

namespace fra\web;

class FrontController
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $splitUri = explode('/', trim($uri, '/'));
        $action = 'index';
        if (class_exists( $controller = '\\app\\controllers\\' . $splitUri[0])) {
            $controller = new $controller();
            if (method_exists($controller, 'action' . ucfirst($splitUri[1]))) {
                $action = 'action' . ucfirst($splitUri[1]);
            }
        } else {
            $controller = '\\app\\controllers\\Site';
            $controller = new $controller();
            if (method_exists($controller, 'action' . ucfirst($splitUri[0]))) {
                $action = 'action' . ucfirst($splitUri[0]);
            }
        }
        $controller->action($action);
    }
}