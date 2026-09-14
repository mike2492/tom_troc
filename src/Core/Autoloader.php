<?php
spl_autoload_register(function($className){

    $paths = [
        __DIR__ . '/',
        __DIR__ . '/../Controller/',
        __DIR__ . '/../Model/Entity/',
        __DIR__ . '/../Model/Manager/'
    ];

    foreach($paths as $path){
        if(file_exists($path . $className . '.php')){
            require($path . $className . '.php');
            return true;
        }
    }

});