<?php

class Router{

    public function run(){

        if(!isset($_GET['controller']) || !isset($_GET['action'])){
            echo "Paramètres manquant";
            return;
        }

        $controllerName = $_GET['controller'];
        $actionName = $_GET['action'];

        $controllerClass = ucfirst($controllerName) . 'Controller';

        if(class_exists($controllerClass)){
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $actionName)) {
                $controllerInstance->$actionName();
            } else {
                echo "La méthode n'existe pas";
            }
        } else{
            echo "La classe n'existe pas";
            return;
        }
    }
}