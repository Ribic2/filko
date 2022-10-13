<?php

namespace Filko\Controller;

class Controller
{
    /**
     * Returns POST request data by key
     * @param string|null $key
     * @return string|null
     */
    public function getPayload(string $key = null): ?string
    {
        return json_decode(file_get_contents("php://input"))->$key ?? null;
    }
}