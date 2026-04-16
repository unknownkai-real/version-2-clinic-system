<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Visit.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Employee.php';

class VisitsController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new Visit();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'Visit saved.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Visit updated.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'Visit deleted.');
            }
            $this->redirect('visits');
        }

        $search = trim($_GET['search'] ?? '');
        $visits = $model->all($search);
        $students = (new Student())->all();
        $employees = (new Employee())->all();
        $this->view('visits/index', compact('visits', 'students', 'employees', 'search'));
    }
}
