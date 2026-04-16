<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Inventory.php';
require_once __DIR__ . '/../models/DamagedItem.php';

class InventoryController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new Inventory();
        $damagedModel = new DamagedItem();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            $_POST['is_damaged'] = isset($_POST['is_damaged']) ? 1 : 0;
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'Inventory item created.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Inventory item updated.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'Inventory item removed.');
            } elseif ($action === 'create_damaged') {
                $damagedModel->create($_POST);
                $this->setFlash('success', 'Damaged item record created.');
            } elseif ($action === 'update_damaged') {
                $damagedModel->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Damaged item record updated.');
            } elseif ($action === 'delete_damaged') {
                $damagedModel->delete((int)$_POST['id']);
                $this->setFlash('success', 'Damaged item record deleted.');
            }
            $this->redirect('inventory');
        }

        $search = trim($_GET['search'] ?? '');
        $items = $model->all($search);
        $damagedItems = $damagedModel->all();
        $this->view('inventory/index', compact('items', 'damagedItems', 'search'));
    }
}
