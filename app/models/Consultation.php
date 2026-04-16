<?php
require_once __DIR__ . '/../core/Model.php';

class Consultation extends Model
{
    public function all(string $search=''): array
    {
        $sql = "SELECT c.*, COALESCE(CONCAT(s.first_name,' ',s.last_name), CONCAT(e.first_name,' ',e.last_name)) AS patient_name
                FROM consultations c
                LEFT JOIN students s ON s.id=c.student_id
                LEFT JOIN employees e ON e.id=c.employee_id";
        $params=[];
        if($search!==''){
            $sql .= " WHERE COALESCE(CONCAT(s.first_name,' ',s.last_name), CONCAT(e.first_name,' ',e.last_name)) LIKE ? OR c.complaint LIKE ? OR c.diagnosis LIKE ?";
            $term="%$search%";
            $params=[$term,$term,$term];
        }
        $sql.=' ORDER BY c.consultation_date DESC';
        $stmt=$this->db->prepare($sql);$stmt->execute($params);return $stmt->fetchAll();
    }

    public function create(array $d): bool
    {
        $studentId = $d['patient_type'] === 'student' ? (int)$d['patient_id'] : null;
        $employeeId = $d['patient_type'] === 'employee' ? (int)$d['patient_id'] : null;
        $stmt=$this->db->prepare('INSERT INTO consultations (student_id, employee_id, consultation_date, complaint, diagnosis, treatment, confidential_notes) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$studentId,$employeeId,$d['consultation_date'],$d['complaint'],$d['diagnosis'],$d['treatment'],$d['confidential_notes'] ?? null]);
    }

    public function update(int $id,array $d): bool
    {
        $studentId = $d['patient_type'] === 'student' ? (int)$d['patient_id'] : null;
        $employeeId = $d['patient_type'] === 'employee' ? (int)$d['patient_id'] : null;
        $stmt=$this->db->prepare('UPDATE consultations SET student_id=?, employee_id=?, consultation_date=?, complaint=?, diagnosis=?, treatment=?, confidential_notes=? WHERE id=?');
        return $stmt->execute([$studentId,$employeeId,$d['consultation_date'],$d['complaint'],$d['diagnosis'],$d['treatment'],$d['confidential_notes'] ?? null,$id]);
    }

    public function delete(int $id): bool
    {
        $stmt=$this->db->prepare('DELETE FROM consultations WHERE id=?');
        return $stmt->execute([$id]);
    }
}
