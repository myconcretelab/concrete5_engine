<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInitabb6f6f01384e868f89b6976b4f1e161
=======
class ComposerAutoloaderInit632f41f9cc278ea913f576a1907551fa
>>>>>>> origin/master
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInitabb6f6f01384e868f89b6976b4f1e161', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitabb6f6f01384e868f89b6976b4f1e161', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInit632f41f9cc278ea913f576a1907551fa', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit632f41f9cc278ea913f576a1907551fa', 'loadClassLoader'));
>>>>>>> origin/master

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
            composerRequireabb6f6f01384e868f89b6976b4f1e161($file);
=======
            composerRequire632f41f9cc278ea913f576a1907551fa($file);
>>>>>>> origin/master
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequireabb6f6f01384e868f89b6976b4f1e161($file)
=======
function composerRequire632f41f9cc278ea913f576a1907551fa($file)
>>>>>>> origin/master
{
    require $file;
}
