<?php
require_once __DIR__ . '/../core/Model.php';

class Inventory extends Model
{
    public function all(string $search = ''): array
    {
        $sql = 'SELECT * FROM inventory';
        $params = [];
        if ($search !== '') {
            $sql .= ' WHERE item_name LIKE ? OR category LIKE ? OR batch_no LIKE ?';
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
        $stmt = $this->db->prepare('INSERT INTO inventory (item_name, category, quantity, expiration_date, is_damaged, notes, batch_no) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$data['item_name'], $data['category'], $data['quantity'], $data['expiration_date'] ?: null, $data['is_damaged'] ?? 0, $data['notes'] ?? null, $data['batch_no'] ?? null]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE inventory SET item_name=?, category=?, quantity=?, expiration_date=?, is_damaged=?, notes=?, batch_no=? WHERE id=?');
        return $stmt->execute([$data['item_name'], $data['category'], $data['quantity'], $data['expiration_date'] ?: null, $data['is_damaged'] ?? 0, $data['notes'] ?? null, $data['batch_no'] ?? null, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM inventory WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
