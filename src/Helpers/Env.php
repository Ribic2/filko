<?php

namespace Filko\Helpers;

class Env
{
    /**
     * @param string $key
     * @return array|false|string
     */
    public static function get(string $key): bool|array|string
    {
        return getenv($key, true);
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public static function set(string $key, string $value)
    {
       $_ENV[$key] = $value;
    }
}