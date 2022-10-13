<?php

namespace Filko\Render;

class View
{
    protected static string $dirPath = "../views/";

    /**
     * Renders .phtml file
     * It can be used as return function in controller or even in .phtml files to render components
     * @param string $file
     * @param array $data
     * @return void
     */
    public static function render(string $file, array $data = [])
    {
        extract($data);
        ob_start();
        include self::$dirPath . $file;
        $output = ob_get_clean();
        print $output;
    }

    /**
     * @param string $file
     * @param array $data
     * @return void
     */
    public static function getComponent(string $file, array $data = [])
    {
        extract($data);
        ob_start();
        include "../views/" . $file;
        $output = ob_get_clean();
        print $output;
    }

    /**
     * @param $data
     * @return void
     */
    public static function JSON($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo htmlentities(json_encode($data), true);
        exit;
    }
}