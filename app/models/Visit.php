<?php
require_once __DIR__ . '/../core/Model.php';

class Visit extends Model
{
    public function all(string $search=''): array
    {
        $sql = "SELECT v.*, COALESCE(CONCAT(s.first_name,' ',s.last_name), CONCAT(e.first_name,' ',e.last_name)) AS patient_name
                FROM visits v
                LEFT JOIN students s ON s.id=v.student_id
                LEFT JOIN employees e ON e.id=v.employee_id";
        $params=[];
        if($search!==''){
            $sql .= " WHERE COALESCE(CONCAT(s.first_name,' ',s.last_name), CONCAT(e.first_name,' ',e.last_name)) LIKE ? OR v.complaint LIKE ?";
            $term="%$search%";
            $params=[$term,$term];
        }
        $sql .= ' ORDER BY v.visit_datetime DESC';
        $stmt=$this->db->prepare($sql); $stmt->execute($params); return $stmt->fetchAll();
    }

    public function create(array $d): bool
    {
        $studentId = $d['patient_type'] === 'student' ? (int)$d['patient_id'] : null;
        $employeeId = $d['patient_type'] === 'employee' ? (int)$d['patient_id'] : null;
        $stmt=$this->db->prepare('INSERT INTO visits (student_id, employee_id, visit_datetime, complaint, intervention, disposition, private_notes) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$studentId,$employeeId,$d['visit_datetime'],$d['complaint'],$d['intervention'],$d['disposition'],$d['private_notes'] ?? null]);
    }

    public function update(int $id,array $d): bool
    {
        $studentId = $d['patient_type'] === 'student' ? (int)$d['patient_id'] : null;
        $employeeId = $d['patient_type'] === 'employee' ? (int)$d['patient_id'] : null;
        $stmt=$this->db->prepare('UPDATE visits SET student_id=?, employee_id=?, visit_datetime=?, complaint=?, intervention=?, disposition=?, private_notes=? WHERE id=?');
        return $stmt->execute([$studentId,$employeeId,$d['visit_datetime'],$d['complaint'],$d['intervention'],$d['disposition'],$d['private_notes'] ?? null,$id]);
    }

    public function delete(int $id): bool
    {
        $stmt=$this->db->prepare('DELETE FROM visits WHERE id=?');
        return $stmt->execute([$id]);
    }
}
