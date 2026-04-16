<?php
require_once __DIR__ . '/../core/Model.php';

class Employee extends Model
{
    public function all(string $search = ''): array
    {
        $sql = 'SELECT * FROM employees';
        $params = [];
        if ($search !== '') {
            $sql .= ' WHERE employee_no LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR department LIKE ?';
            $term = "%$search%";
            $params = [$term, $term, $term, $term];
        }
        $sql .= ' ORDER BY created_at DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO employees (employee_no, first_name, last_name, department, position, birth_date, sex, physical_exam, drug_test, dental_benefits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$data['employee_no'], $data['first_name'], $data['last_name'], $data['department'], $data['position'], $data['birth_date'] ?: null, $data['sex'], $data['physical_exam'], $data['drug_test'], $data['dental_benefits']]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE employees SET employee_no=?, first_name=?, last_name=?, department=?, position=?, birth_date=?, sex=?, physical_exam=?, drug_test=?, dental_benefits=? WHERE id=?');
        return $stmt->execute([$data['employee_no'], $data['first_name'], $data['last_name'], $data['department'], $data['position'], $data['birth_date'] ?: null, $data['sex'], $data['physical_exam'], $data['drug_test'], $data['dental_benefits'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM employees WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
