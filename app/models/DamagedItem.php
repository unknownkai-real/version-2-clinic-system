<?php
require_once __DIR__ . '/../core/Model.php';

class DamagedItem extends Model
{
    public function all(): array
    {
        $stmt=$this->db->query('SELECT * FROM damaged_items ORDER BY record_date DESC');
        return $stmt->fetchAll();
    }

    public function create(array $d): bool
    {
        $st=$this->db->prepare('INSERT INTO damaged_items (item_name, description, quantity, record_date) VALUES (?, ?, ?, ?)');
        return $st->execute([$d['item_name'],$d['description']?:null,$d['quantity'],$d['record_date']]);
    }

    public function update(int $id, array $d): bool
    {
        $st=$this->db->prepare('UPDATE damaged_items SET item_name=?, description=?, quantity=?, record_date=? WHERE id=?');
        return $st->execute([$d['item_name'],$d['description']?:null,$d['quantity'],$d['record_date'],$id]);
    }

    public function delete(int $id): bool
    {
        $st=$this->db->prepare('DELETE FROM damaged_items WHERE id=?');
        return $st->execute([$id]);
    }
}
