<?php

namespace Filko\Router;

use Filko\Controller\IndexController;
use Filko\Helpers\Env;

class Paths
{
    const PATHS = [
        "/" => [
            "GET" => [
                "controller" => IndexController::class,
                "action" => 'index',
                "method" => 'GET',
                "config" => [
                    "test.txt" => "test.txt.css",
                    "index" => "index.js",
                    "files" => "components/File.js"
                ],
                "children" => [

                ],
                "permissions" => [
                    "locked" => false
                ]
            ]
        ],
        "/files" => [
            "POST" => [
                "controller" => IndexController::class,
                "action" => 'about',
                "method" => 'GET',
                "type" => 'json',
                "children" => [
                    "/get" => [
                        "controller" => IndexController::class,
                        "action" => 'xd',
                        "method" => 'POST',
                        "type" => 'json'
                    ],
                    "/delete" => [
                        "controller" => IndexController::class,
                        "action" => 'delete',
                        "method" => 'POST',
                        "type" => 'json'
                    ],
                    '/execute' => [
                        "controller" => IndexController::class,
                        "action" => 'execute',
                        "method" => 'POST',
                        "type" => 'json'
                    ]
                ],
            ],
        ]
    ];
}