<?php
require_once __DIR__ . '/../core/Model.php';

class FirstAidRecord extends Model
{
    public function all(string $search=''): array
    {
        $sql = "SELECT f.*, COALESCE(CONCAT(s.first_name,' ',s.last_name), CONCAT(e.first_name,' ',e.last_name)) AS patient_name
                FROM first_aid_records f
                LEFT JOIN students s ON s.id=f.student_id
                LEFT JOIN employees e ON e.id=f.employee_id";
        $params=[];
        if($search!==''){
            $sql .= " WHERE COALESCE(CONCAT(s.first_name,' ',s.last_name), CONCAT(e.first_name,' ',e.last_name)) LIKE ? OR f.cause LIKE ?";
            $term="%$search%";$params=[$term,$term];
        }
        $sql.=' ORDER BY f.record_datetime DESC';
        $stmt=$this->db->prepare($sql);$stmt->execute($params);return $stmt->fetchAll();
    }

    public function create(array $d): bool
    {
        $studentId = $d['patient_type'] === 'student' ? (int)$d['patient_id'] : null;
        $employeeId = $d['patient_type'] === 'employee' ? (int)$d['patient_id'] : null;
        $stmt=$this->db->prepare('INSERT INTO first_aid_records (student_id, employee_id, record_datetime, cause, first_aid_treatment, diagnosis) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$studentId,$employeeId,$d['record_datetime'],$d['cause'],$d['first_aid_treatment'],$d['diagnosis']]);
    }

    public function update(int $id,array $d): bool
    {
        $studentId = $d['patient_type'] === 'student' ? (int)$d['patient_id'] : null;
        $employeeId = $d['patient_type'] === 'employee' ? (int)$d['patient_id'] : null;
        $stmt=$this->db->prepare('UPDATE first_aid_records SET student_id=?, employee_id=?, record_datetime=?, cause=?, first_aid_treatment=?, diagnosis=? WHERE id=?');
        return $stmt->execute([$studentId,$employeeId,$d['record_datetime'],$d['cause'],$d['first_aid_treatment'],$d['diagnosis'],$id]);
    }

    public function delete(int $id): bool
    {
        $stmt=$this->db->prepare('DELETE FROM first_aid_records WHERE id=?');
        return $stmt->execute([$id]);
    }
}
