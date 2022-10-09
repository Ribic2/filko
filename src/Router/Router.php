<?php

namespace Filko\Router;

use Exception;

class Router
{
    /**
     * @return void
     * @throws Exception
     */
    public static function getRoute(): void
    {
        $path = $_SERVER['REQUEST_URI'];

        if(!isset(Paths::PATHS[$path])){
            throw new Exception("Route not found!");
        }

        $route = new Route(Paths::PATHS[$path]);
        $route->run();
    }
}