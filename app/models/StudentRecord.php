<?php
require_once __DIR__ . '/../core/Model.php';

class StudentRecord extends Model
{
    public function labs(): array
    {
        return $this->db->query("SELECT l.*, CONCAT(s.first_name,' ',s.last_name) student_name FROM student_labs l JOIN students s ON s.id=l.student_id ORDER BY l.record_date DESC")->fetchAll();
    }

    public function vaccinations(): array
    {
        return $this->db->query("SELECT v.*, CONCAT(s.first_name,' ',s.last_name) student_name FROM student_vaccinations v JOIN students s ON s.id=v.student_id ORDER BY v.record_date DESC")->fetchAll();
    }

    public function drugTests(): array
    {
        return $this->db->query("SELECT d.*, CONCAT(s.first_name,' ',s.last_name) student_name FROM student_drug_tests d JOIN students s ON s.id=d.student_id ORDER BY d.record_date DESC")->fetchAll();
    }

    public function createLab(array $d): bool { $st=$this->db->prepare('INSERT INTO student_labs (student_id, lab_type, record_date, file_path, result_summary) VALUES (?, ?, ?, ?, ?)'); return $st->execute([(int)$d['student_id'],$d['lab_type'],$d['record_date'],$d['file_path']?:null,$d['result_summary']?:null]); }
    public function updateLab(int $id,array $d): bool { $st=$this->db->prepare('UPDATE student_labs SET student_id=?, lab_type=?, record_date=?, file_path=?, result_summary=? WHERE id=?'); return $st->execute([(int)$d['student_id'],$d['lab_type'],$d['record_date'],$d['file_path']?:null,$d['result_summary']?:null,$id]); }
    public function deleteLab(int $id): bool { $st=$this->db->prepare('DELETE FROM student_labs WHERE id=?'); return $st->execute([$id]); }

    public function createVaccination(array $d): bool { $st=$this->db->prepare('INSERT INTO student_vaccinations (student_id, dose, record_date, file_path) VALUES (?, ?, ?, ?)'); return $st->execute([(int)$d['student_id'],$d['dose'],$d['record_date'],$d['file_path']?:null]); }
    public function updateVaccination(int $id,array $d): bool { $st=$this->db->prepare('UPDATE student_vaccinations SET student_id=?, dose=?, record_date=?, file_path=? WHERE id=?'); return $st->execute([(int)$d['student_id'],$d['dose'],$d['record_date'],$d['file_path']?:null,$id]); }
    public function deleteVaccination(int $id): bool { $st=$this->db->prepare('DELETE FROM student_vaccinations WHERE id=?'); return $st->execute([$id]); }

    public function createDrugTest(array $d): bool { $st=$this->db->prepare('INSERT INTO student_drug_tests (student_id, record_date, result, notes) VALUES (?, ?, ?, ?)'); return $st->execute([(int)$d['student_id'],$d['record_date'],$d['result'],$d['notes']?:null]); }
    public function updateDrugTest(int $id,array $d): bool { $st=$this->db->prepare('UPDATE student_drug_tests SET student_id=?, record_date=?, result=?, notes=? WHERE id=?'); return $st->execute([(int)$d['student_id'],$d['record_date'],$d['result'],$d['notes']?:null,$id]); }
    public function deleteDrugTest(int $id): bool { $st=$this->db->prepare('DELETE FROM student_drug_tests WHERE id=?'); return $st->execute([$id]); }
}
