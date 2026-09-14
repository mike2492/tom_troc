<?php 

abstract class Controller{

    protected function isLoggedIn(){
        return isset($_SESSION['user_id']);
    }

    protected function render(string $view, array $data = []){
        extract($data);
        
        ob_start();
        require __DIR__ . '/../View/' . $view . '.php';
        $content = ob_get_clean();
        require __DIR__. '/../View/layout/main.php'; 
    }
}