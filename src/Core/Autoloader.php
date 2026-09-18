<?php
spl_autoload_register(function($class){
    $paths = [
        __DIR__ . '/../src/Core/',
        __DIR__ . '/../src/Model/Entity/',
        __DIR__ . '/../src/Model/Manager/',
        __DIR__ . '/../src/Controller/'
    ];

    foreach($paths as $path){
        if(file_exists($path . $class . '.php')){
            require $path . $class . '.php';
            return;
        }
    }
});