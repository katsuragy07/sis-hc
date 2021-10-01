<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77eddf3a60954db9d2f720c93253413e
{
    public static $files = array (
        'fa3df3013f51e030ec6f48c5e17462d5' => __DIR__ . '/..' . '/lindelius/php-jwt/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lindelius\\JWT\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lindelius\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/lindelius/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit77eddf3a60954db9d2f720c93253413e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit77eddf3a60954db9d2f720c93253413e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit77eddf3a60954db9d2f720c93253413e::$classMap;

        }, null, ClassLoader::class);
    }
}
