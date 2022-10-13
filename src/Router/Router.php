<?php

namespace Filko\Router;

use Exception;
use Filko\Helpers\Includer;

class Router
{
    /**
     * @return Route
     * @throws Exception
     */
    public static function getRoute(): Route
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Path is exploded by '?' because if GET param is set in the URL
        // it doesn't map it correctly
        $path = explode("?", $path)[0];

        $splitPath = explode('/', $path);

        // TODO Better checkup for child routes
        // Checks for child route
        $route = isset($splitPath[2]) ?
            Paths::PATHS[sprintf("/%s", $splitPath[1])]
            [$method]["children"]
            [sprintf("/%s", $splitPath[2])] :
            Paths::PATHS[$path][$method];

        if (!isset($route)) {
            header("Status: 404 Not Found");
        }

        return new Route(
            $route
        );
    }
}