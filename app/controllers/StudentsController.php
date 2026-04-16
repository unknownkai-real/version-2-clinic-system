<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/StudentRecord.php';

class StudentsController extends Controller
{
    public function index(): void
    {
        Auth::requireAuth();
        $model = new Student();
        $recordModel = new StudentRecord();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'create';
            switch ($action) {
                case 'create': $model->create($_POST); $this->setFlash('success', 'Student created successfully.'); break;
                case 'update': $model->update((int)$_POST['id'], $_POST); $this->setFlash('success', 'Student updated successfully.'); break;
                case 'delete': $model->delete((int)$_POST['id']); $this->setFlash('success', 'Student deleted successfully.'); break;
                case 'create_lab': $recordModel->createLab($_POST); $this->setFlash('success', 'Lab record added.'); break;
                case 'update_lab': $recordModel->updateLab((int)$_POST['id'], $_POST); $this->setFlash('success', 'Lab record updated.'); break;
                case 'delete_lab': $recordModel->deleteLab((int)$_POST['id']); $this->setFlash('success', 'Lab record deleted.'); break;
                case 'create_vax': $recordModel->createVaccination($_POST); $this->setFlash('success', 'Vaccination record added.'); break;
                case 'update_vax': $recordModel->updateVaccination((int)$_POST['id'], $_POST); $this->setFlash('success', 'Vaccination record updated.'); break;
                case 'delete_vax': $recordModel->deleteVaccination((int)$_POST['id']); $this->setFlash('success', 'Vaccination record deleted.'); break;
                case 'create_drug': $recordModel->createDrugTest($_POST); $this->setFlash('success', 'Drug test record added.'); break;
                case 'update_drug': $recordModel->updateDrugTest((int)$_POST['id'], $_POST); $this->setFlash('success', 'Drug test record updated.'); break;
                case 'delete_drug': $recordModel->deleteDrugTest((int)$_POST['id']); $this->setFlash('success', 'Drug test record deleted.'); break;
            }
            $this->redirect('students');
        }

        $search = trim($_GET['search'] ?? '');
        $students = $model->all($search);
        foreach ($students as &$student) {
            $student['history'] = $model->history((int)$student['id']);
        }
        $labs = $recordModel->labs();
        $vaccinations = $recordModel->vaccinations();
        $drugTests = $recordModel->drugTests();

        $this->view('students/index', compact('students', 'search', 'labs', 'vaccinations', 'drugTests'));
    }
}
