<?php
define ('BASE_URI', '/Applications/MAMP/htdocs/prjtrls/');

spl_autoload_register(function ($class) {
    $file = BASE_URI . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file))
    {
        require $file;
    }
});
?>