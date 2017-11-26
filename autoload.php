<?php
define('BASE_URI', __DIR__ . DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class) {
    $file = BASE_URI . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($file))
    {
        require $file;
    }
});
?>