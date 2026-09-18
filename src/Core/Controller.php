<?php

abstract class Controller {

    protected function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    protected function render(string $view, array $data = []): void
    {
        ob_start();
        extract($data);
        require __DIR__ . '/../View/' . $view . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../View/main.php';
    }
}