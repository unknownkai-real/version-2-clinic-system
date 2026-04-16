<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/BorrowingLog.php';
require_once __DIR__ . '/../models/Inventory.php';

class BorrowingController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new BorrowingLog();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'Borrowing entry created.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Borrowing entry updated.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'Borrowing entry deleted.');
            }
            $this->redirect('borrowing');
        }

        $search = trim($_GET['search'] ?? '');
        $logs = $model->all($search);
        $items = (new Inventory())->all();
        $this->view('borrowing/index', compact('logs', 'items', 'search'));
    }
}
