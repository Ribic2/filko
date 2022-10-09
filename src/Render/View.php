<?php

namespace Filko\Render;

class View
{
    protected static string $dirPath = "../views/";

    /**
     * @param string $file
     * @param array $data
     * @return bool|string
     */
    public static function render(string $file, array $data = []): bool|string
    {
        extract($data);
        ob_start();
        include self::$dirPath . $file;
        $output = ob_get_clean();
        print $output;
        return $output;
    }
}