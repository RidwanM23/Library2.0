<?php

require_once 'config/database.php';

class Member
{
    private $id, $user_id, $nik, $full_name, $address, $phone;
    private $created_at;

    public function getId()
    {
        return $this->id;
    }

    public function getNik()
    {
        return $this->nik;
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    static function register($userId, $data)
    {
        global $pdo;
        $query = $pdo->prepare("INSERT INTO members (user_id, nik, full_name, address, phone, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        return $query->execute([
            $userId,
            $data['nik'],
            $data['full_name'],
            $data['address'],
            $data['phone']
        ]);
    }

    static function findByUserId($userId)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM members WHERE user_id = ?");
        $query->execute([$userId]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Member');
        return $query->fetch();
    }
} 