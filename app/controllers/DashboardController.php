<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';

class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $this->view('dashboard/index', ['title' => 'Dashboard']);
    }
}
