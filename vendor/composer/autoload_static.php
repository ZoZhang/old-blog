<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf57147fb7665b5a519cfc1e42891d23d
{
    public static $prefixLengthsPsr4 = array (
        'X' => 
        array (
            'XPathSelector\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'XPathSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/stil/xpath-selector/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf57147fb7665b5a519cfc1e42891d23d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf57147fb7665b5a519cfc1e42891d23d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
