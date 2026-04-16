<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Employee.php';
require_once __DIR__ . '/../models/EmployeeRecord.php';

class EmployeesController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new Employee();
        $recordModel = new EmployeeRecord();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'Employee created successfully.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Employee updated successfully.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'Employee deleted successfully.');
            } elseif ($action === 'create_record') {
                $recordModel->create($_POST);
                $this->setFlash('success', 'Employee health record added.');
            } elseif ($action === 'update_record') {
                $recordModel->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Employee health record updated.');
            } elseif ($action === 'delete_record') {
                $recordModel->delete((int)$_POST['id']);
                $this->setFlash('success', 'Employee health record deleted.');
            }
            $this->redirect('employees');
        }

        $search = trim($_GET['search'] ?? '');
        $employees = $model->all($search);
        $records = $recordModel->all();
        $this->view('employees/index', compact('employees', 'records', 'search'));
    }
}
