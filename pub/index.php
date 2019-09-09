<h1>Home</h1>

<?php

set_include_path(implode(PATH_SEPARATOR, array(
    '../app/model',
    '../app/controller',
    '../app/view'
)));

spl_autoload_register(function ($class) {
    $classPath = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
    if ($file = stream_resolve_include_path($classPath)) {
        include $file;
        return true;
    }
    return false;
});

var_dump(get_include_path());

//var_dump($_SERVER['REQUEST_URI']);

App::start();