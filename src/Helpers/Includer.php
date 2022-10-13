<?php

namespace Filko\Helpers;

use Filko\Enum\Helper;

class Includer
{
    /**
     * Includes .js and .css files that are added to Paths.php route under config tag
     * @param array $config
     * @return void
     */
    public static function getConfigs(array $config)
    {
        foreach ($config as $item) {
            $itemArray = explode(".", $item) ?? [];
            $splitItem = end($itemArray);

            if ($splitItem === Helper::JAVASCRIPT_EXTENSION) {
                echo sprintf("<script src='./assets/javascript/%s' type='module'></script>", $item);
            } else {
                echo sprintf("<link rel='stylesheet' type='text/css' href='./assets/css/%s'></link >", $item);
            }

        }
    }
}
