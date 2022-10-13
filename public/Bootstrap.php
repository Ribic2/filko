<?php

use Filko\Helpers\Includer;
use Filko\Router\Router;

require '../vendor/autoload.php';

$route = Router::getRoute();

if ($route->type == 'json') {
    Includer::getConfigs($route->config);
    Router::getRoute()->run();
} else {
    echo sprintf("<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>My Website</title>
    <link rel='stylesheet' href='./assets/css/index.css'/>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=VT323&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
    %s
</head>
<body>
<main>
     %s
</main>
</body>
</html>",
        Includer::getConfigs($route->config),
        Router::getRoute()->run()
    );
}

