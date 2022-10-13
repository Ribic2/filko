<?php

namespace Filko\Router;

use Exception;

class Route
{
    protected string $controller;
    protected string $action;
    protected string $method;
    public array $config;
    protected array $children;
    public string $type;
    protected array $permissions;

    public function __construct(array $data)
    {
        $this->controller = $data['controller'];
        $this->action = $data['action'];
        $this->method = $data['method'];
        $this->config = $data['config'] ?? [];
        $this->children = $data['children'] ?? [];
        $this->type = $data['type'] ?? 'view';
        $this->permissions = $data['permissions'] ?? [];
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $controller = new $this->controller();

        if($this->permissions['locked'] ?? false){
            throw new Exception("You don't have permission to visit this route!");
        }

        if (!method_exists($controller, $this->action)) {
            throw new Exception(sprintf("Given method doesn't exist in %s", $this->controller));
        }
        $controller->{$this->action}();
    }
}