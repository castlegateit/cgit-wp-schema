<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7f0bcad1227c6df0d13268a66d150c8b
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Castlegate\\Schema\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Castlegate\\Schema\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7f0bcad1227c6df0d13268a66d150c8b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7f0bcad1227c6df0d13268a66d150c8b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7f0bcad1227c6df0d13268a66d150c8b::$classMap;

        }, null, ClassLoader::class);
    }
}
