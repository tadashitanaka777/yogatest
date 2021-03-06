<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f5af4bc2c2786a30d8698d88a8b6343
{
    public static $files = array (
        'c43c0042778d3c380f1e1043e47be687' => __DIR__ . '/../..' . '/wp-load.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Manage\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Manage\\' => 
        array (
            0 => __DIR__ . '/../..' . '/manage',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1f5af4bc2c2786a30d8698d88a8b6343::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1f5af4bc2c2786a30d8698d88a8b6343::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
