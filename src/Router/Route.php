<?php

namespace Filko\Router;

use Filko\Controller\Controller;

class Route
{
    protected string $controller;
    protected string $action;
    protected string $method;

    public function __construct(array $data)
    {
        $this->controller = $data['controller'];
        $this->action = $data['action'];
        $this->method = $data['method'];
    }

    public function run(){
       $controller =  new $this->controller();
       $controller->{$this->action}();
    }
}