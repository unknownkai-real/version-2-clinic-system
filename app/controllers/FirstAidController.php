<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/FirstAidRecord.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Employee.php';

class FirstAidController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new FirstAidRecord();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'First aid record saved.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'First aid record updated.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'First aid record deleted.');
            }
            $this->redirect('first-aid');
        }

        $search = trim($_GET['search'] ?? '');
        $records = $model->all($search);
        $students = (new Student())->all();
        $employees = (new Employee())->all();
        $this->view('first_aid/index', compact('records', 'students', 'employees', 'search'));
    }
}
