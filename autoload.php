<?php
spl_autoload_register(function ($class_name) {
    include 'lib/' . $class_name . '.php';
});
?>