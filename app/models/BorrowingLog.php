<?php
require_once __DIR__ . '/../core/Model.php';

class BorrowingLog extends Model
{
    public function all(string $search=''): array
    {
        $sql='SELECT b.*, i.item_name FROM borrowing_logs b LEFT JOIN inventory i ON i.id=b.inventory_id';
        $params=[];
        if($search!==''){
            $sql.=' WHERE b.borrower_name LIKE ? OR i.item_name LIKE ?';
            $term="%$search%";$params=[$term,$term];
        }
        $sql.=' ORDER BY b.date_borrowed DESC';
        $stmt=$this->db->prepare($sql);$stmt->execute($params);return $stmt->fetchAll();
    }

    public function create(array $d): bool
    {
        $stmt=$this->db->prepare('INSERT INTO borrowing_logs (borrower_name, inventory_id, date_borrowed, date_returned, item_condition, staff_name) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$d['borrower_name'],$d['inventory_id'],$d['date_borrowed'],$d['date_returned'] ?: null,$d['item_condition'],$d['staff_name']]);
    }

    public function update(int $id,array $d): bool
    {
        $stmt=$this->db->prepare('UPDATE borrowing_logs SET borrower_name=?, inventory_id=?, date_borrowed=?, date_returned=?, item_condition=?, staff_name=? WHERE id=?');
        return $stmt->execute([$d['borrower_name'],$d['inventory_id'],$d['date_borrowed'],$d['date_returned'] ?: null,$d['item_condition'],$d['staff_name'],$id]);
    }

    public function delete(int $id): bool
    {
        $stmt=$this->db->prepare('DELETE FROM borrowing_logs WHERE id=?');
        return $stmt->execute([$id]);
    }
}
