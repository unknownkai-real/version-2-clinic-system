<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Consultation.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Employee.php';

class ConsultationsController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new Consultation();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'Consultation recorded.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Consultation updated.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'Consultation deleted.');
            }
            $this->redirect('consultations');
        }

        $search = trim($_GET['search'] ?? '');
        $consultations = $model->all($search);
        $students = (new Student())->all();
        $employees = (new Employee())->all();
        $this->view('consultations/index', compact('consultations', 'students', 'employees', 'search'));
    }
}
