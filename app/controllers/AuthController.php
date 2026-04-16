<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    private const LEGACY_ADMIN_HASH = '$2y$10$R5P5/XwzCROTx8Jx85TRW.k6v52Nmnif6xvYIh9n6D6M7UAuRdR8K';

    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $user = $userModel->findByUsername($username);

            $isValidPassword = $user && password_verify($password, $user['password']);

            // Backward-compatibility for the previously seeded wrong admin hash.
            if (!$isValidPassword && $user && $user['username'] === 'admin' && $password === 'admin123' && $user['password'] === self::LEGACY_ADMIN_HASH) {
                $newHash = password_hash('admin123', PASSWORD_DEFAULT);
                $userModel->updatePassword((int)$user['id'], $newHash);
                $user['password'] = $newHash;
                $isValidPassword = true;
            }

            if ($isValidPassword) {
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
