<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd10a3d9bb4ada0cea29db8e627e61be
{
    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'Ubench' => 
            array (
                0 => __DIR__ . '/..' . '/devster/ubench/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitcd10a3d9bb4ada0cea29db8e627e61be::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}