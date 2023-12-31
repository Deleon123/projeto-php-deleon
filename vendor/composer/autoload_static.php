<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1d70ebb25b5a4a1cdc4206072d69e8b3
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
            'Cocur\\Slugify\\' => 14,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/Config',
        ),
        'Cocur\\Slugify\\' => 
        array (
            0 => __DIR__ . '/..' . '/cocur/slugify/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1d70ebb25b5a4a1cdc4206072d69e8b3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1d70ebb25b5a4a1cdc4206072d69e8b3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1d70ebb25b5a4a1cdc4206072d69e8b3::$classMap;

        }, null, ClassLoader::class);
    }
}
