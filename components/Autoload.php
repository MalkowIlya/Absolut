<?php

function __autoload($class_name)
{
    //Создаем массив в котором храняться дериктории с нужным классом
    $array_paths = array (
        '/models/',
        '/components/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path .$class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}