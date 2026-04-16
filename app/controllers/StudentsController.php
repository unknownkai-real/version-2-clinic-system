<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Student.php';

class StudentsController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new Student();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            if ($action === 'create') {
                $model->create($_POST);
                $this->setFlash('success', 'Student created successfully.');
            } elseif ($action === 'update') {
                $model->update((int)$_POST['id'], $_POST);
                $this->setFlash('success', 'Student updated successfully.');
            } elseif ($action === 'delete') {
                $model->delete((int)$_POST['id']);
                $this->setFlash('success', 'Student deleted successfully.');
            }
            $this->redirect('students');
        }

        $search = trim($_GET['search'] ?? '');
        $students = $model->all($search);
        foreach ($students as &$student) {
            $student['history'] = $model->history((int)$student['id']);
        }
        $this->view('students/index', compact('students', 'search'));
    }
}
