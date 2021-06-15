<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2fd9fe408e5f265b529d5540934eb803
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zend\\Stdlib\\' => 12,
            'Zend\\Db\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zend\\Stdlib\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-stdlib/src',
        ),
        'Zend\\Db\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-db/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PFBC' => 
            array (
                0 => __DIR__ . '/..' . '/pfbc/pfbc',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2fd9fe408e5f265b529d5540934eb803::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2fd9fe408e5f265b529d5540934eb803::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2fd9fe408e5f265b529d5540934eb803::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2fd9fe408e5f265b529d5540934eb803::$classMap;

        }, null, ClassLoader::class);
    }
}
