<?php

class Controller
{
    protected function view(string $path, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/' . $path . '.php';
    }

    protected function redirect(string $route): void
    {
        header('Location: index.php?route=' . $route);
        exit;
    }

    protected function config(): array
    {
        return require __DIR__ . '/../config/config.php';
    }

    protected function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }
}
