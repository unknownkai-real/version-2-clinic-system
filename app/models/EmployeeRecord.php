<?php
require_once __DIR__ . '/../core/Model.php';

class EmployeeRecord extends Model
{
    public function all(): array
    {
        return $this->db->query("SELECT r.*, CONCAT(e.first_name,' ',e.last_name) employee_name FROM employee_health_records r JOIN employees e ON e.id=r.employee_id ORDER BY r.record_date DESC")->fetchAll();
    }

    public function create(array $d): bool
    {
        $st=$this->db->prepare('INSERT INTO employee_health_records (employee_id, record_type, record_date, results, notes) VALUES (?, ?, ?, ?, ?)');
        return $st->execute([(int)$d['employee_id'],$d['record_type'],$d['record_date'],$d['results'],$d['notes']?:null]);
    }

    public function update(int $id,array $d): bool
    {
        $st=$this->db->prepare('UPDATE employee_health_records SET employee_id=?, record_type=?, record_date=?, results=?, notes=? WHERE id=?');
        return $st->execute([(int)$d['employee_id'],$d['record_type'],$d['record_date'],$d['results'],$d['notes']?:null,$id]);
    }

    public function delete(int $id): bool
    {
        $st=$this->db->prepare('DELETE FROM employee_health_records WHERE id=?');
        return $st->execute([$id]);
    }
}
