<?php
define('BP', '../');

set_include_path(implode(PATH_SEPARATOR, array(
    BP . 'app/model',
    BP. 'app/controller',
    BP. 'app/view'
)));

spl_autoload_register(function ($class) {
    $classPath = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
    if ($file = stream_resolve_include_path($classPath)) {
        include $file;
        return true;
    }
    return false;
});

App::start();