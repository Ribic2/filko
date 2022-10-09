<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit31e8586ca93562af90f748a753dbaa7e
{
    public static $files = array (
        '6e36873efc63260a23f7fd0da8b232a6' => __DIR__ . '/../..' . '/public/Bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Filko\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Filko\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit31e8586ca93562af90f748a753dbaa7e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit31e8586ca93562af90f748a753dbaa7e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit31e8586ca93562af90f748a753dbaa7e::$classMap;

        }, null, ClassLoader::class);
    }
}