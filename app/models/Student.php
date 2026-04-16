<?php
require_once __DIR__ . '/../core/Model.php';

class Student extends Model
{
    public function all(string $search = ''): array
    {
        $sql = 'SELECT * FROM students';
        $params = [];
        if ($search !== '') {
            $sql .= ' WHERE student_no LIKE ? OR first_name LIKE ? OR last_name LIKE ?';
            $term = "%$search%";
            $params = [$term, $term, $term];
        }
        $sql .= ' ORDER BY created_at DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO students (student_no, first_name, last_name, course, year_level, birth_date, sex) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$data['student_no'], $data['first_name'], $data['last_name'], $data['course'], $data['year_level'], $data['birth_date'] ?: null, $data['sex']]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM students WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE students SET student_no=?, first_name=?, last_name=?, course=?, year_level=?, birth_date=?, sex=? WHERE id=?');
        return $stmt->execute([$data['student_no'], $data['first_name'], $data['last_name'], $data['course'], $data['year_level'], $data['birth_date'] ?: null, $data['sex'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM students WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function history(int $id): array
    {
        $history = [];
        $stmt = $this->db->prepare('SELECT * FROM vaccinations WHERE student_id = ?');
        $stmt->execute([$id]);
        $history['vaccinations'] = $stmt->fetchAll();

        $stmt = $this->db->prepare('SELECT * FROM lab_results WHERE student_id = ?');
        $stmt->execute([$id]);
        $history['labs'] = $stmt->fetchAll();

        return $history;
    }
}
