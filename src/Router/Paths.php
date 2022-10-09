<?php

namespace Filko\Router;

use Filko\Controller\IndexController;

class Paths
{
    const PATHS = [
        "/" => [
            "file" => "index.phtml",
            "controller" => IndexController::class,
            "action" => 'index',
            "method" => 'GET'
        ]
    ];
}