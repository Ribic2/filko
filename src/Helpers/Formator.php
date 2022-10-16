<?php

namespace Filko\Helpers;

use Filko\Enum\Ftp;

class Formator
{
    /**
     * Builds and formats folder from given array
     * @param array $folders
     * @return array
     */
    public static function formatFolders(array $folders): array
    {
        $items = [];
        foreach ($folders as $folder) {
            $formattedFolderName = self::removeParentPath($folder);
            $split = array_filter(explode("/", $formattedFolderName), "trim");

            $items = array_merge_recursive($items, self::buildArray($split));
        }
        return $items;
    }

    /**
     * Builds array from given arrays
     * @param array $items
     * @return array|array[]
     */
    protected static function buildArray(array $items): array
    {
        $array = [];
        foreach (array_reverse($items) as $valueAsKey)
            if (count(explode(".", $valueAsKey)) === 1) {
                $array = [$valueAsKey => $array];
            } else {
                $array[] = $valueAsKey;
            }
        return $array;
    }

    /**
     * Remove parent folder from path
     * @param string $folder
     * @return array|string
     */
    protected static function removeParentPath(string $folder): array|string
    {
        return str_replace(Ftp::DEFAULT_FOLDER, '', $folder);
    }
}