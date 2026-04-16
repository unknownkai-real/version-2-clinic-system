<?php
require_once __DIR__ . '/../core/Model.php';

class Consultation extends Model
{
    public function all(string $search = ''): array
    {
        $sql = "SELECT c.*, 
                CASE
                    WHEN c.patient_type = 'Student' THEN CONCAT(s.first_name, ' ', s.last_name)
                    WHEN c.patient_type = 'Employee' THEN CONCAT(e.first_name, ' ', e.last_name)
                END AS patient_name
                FROM consultations c
                LEFT JOIN students s ON c.patient_id = s.id AND c.patient_type = 'Student'
                LEFT JOIN employees e ON c.patient_id = e.id AND c.patient_type = 'Employee'";

        $params = [];
        if ($search !== '') {
            $sql .= " WHERE (
                        CASE
                            WHEN c.patient_type = 'Student' THEN CONCAT(s.first_name, ' ', s.last_name)
                            WHEN c.patient_type = 'Employee' THEN CONCAT(e.first_name, ' ', e.last_name)
                        END
                    ) LIKE ? OR c.complaint LIKE ? OR c.intervention LIKE ? OR c.disposition LIKE ?";
            $term = "%$search%";
            $params = [$term, $term, $term, $term];
        }

        $sql .= ' ORDER BY c.consult_datetime DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create(array $d): bool
    {
        $stmt = $this->db->prepare('INSERT INTO consultations (consult_datetime, patient_id, patient_type, complaint, intervention, disposition, private_notes) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([
            $d['consult_datetime'],
            (int)$d['patient_id'],
            $d['patient_type'],
            $d['complaint'],
            $d['intervention'] ?? null,
            $d['disposition'] ?? null,
            $d['private_notes'] ?? null,
        ]);
    }

    public function update(int $id, array $d): bool
    {
        $stmt = $this->db->prepare('UPDATE consultations SET consult_datetime=?, patient_id=?, patient_type=?, complaint=?, intervention=?, disposition=?, private_notes=? WHERE id=?');
        return $stmt->execute([
            $d['consult_datetime'],
            (int)$d['patient_id'],
            $d['patient_type'],
            $d['complaint'],
            $d['intervention'] ?? null,
            $d['disposition'] ?? null,
            $d['private_notes'] ?? null,
            $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM consultations WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function searchPatients(string $type, string $q): array
    {
        $like = '%' . $q . '%';
        if ($type === 'Student') {
            $stmt = $this->db->prepare("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM students WHERE CONCAT(first_name, ' ', last_name) LIKE ? OR student_no LIKE ? ORDER BY first_name LIMIT 15");
            $stmt->execute([$like, $like]);
            return $stmt->fetchAll();
        }

        $stmt = $this->db->prepare("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees WHERE CONCAT(first_name, ' ', last_name) LIKE ? OR employee_no LIKE ? ORDER BY first_name LIMIT 15");
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll();
    }
}
