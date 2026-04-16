<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $user = $userModel->findByUsername(trim($_POST['username']));

            if ($user && password_verify($_POST['password'], $user['password'])) {
                session_regenerate_id(true);
                Auth::login($user);
                $this->redirect('dashboard');
            }

            $this->setFlash('danger', 'Invalid login credentials.');
        }

        $this->view('auth/login');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('login');
    }
}
