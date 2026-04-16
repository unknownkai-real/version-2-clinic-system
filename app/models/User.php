<?php

require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        return $user ?: null;
    }
}
