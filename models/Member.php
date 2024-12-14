<?php

require_once 'config/database.php';

class Member
{
    private $id, $username, $password;

    static function register($data)
    {
        global $pdo;
        try {
            // Cek username sudah terdaftar atau belum
            $stmt = $pdo->prepare("SELECT id FROM members WHERE username = ?");
            $stmt->execute([$data['username']]);
            if ($stmt->fetch()) {
                throw new Exception("Username sudah terdaftar!");
            }

            $query = $pdo->prepare("
                INSERT INTO members (username, password) 
                VALUES (?, ?)
            ");
            
            $result = $query->execute([
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            ]);

            if ($result) {
                // Auto login setelah register
                $_SESSION['member_id'] = $pdo->lastInsertId();
                $_SESSION['username'] = $data['username'];
            }

            return $result;
        } catch (PDOException $e) {
            throw new Exception("Gagal mendaftar: " . $e->getMessage());
        }
    }

    static function login($username, $password)
    {
        global $pdo;
        try {
            $stmt = $pdo->prepare("SELECT * FROM members WHERE username = ?");
            $stmt->execute([$username]);
            $member = $stmt->fetch(PDO::FETCH_OBJ);

            if ($member && password_verify($password, $member->password)) {
                $_SESSION['member_id'] = $member->id;
                $_SESSION['username'] = $member->username;
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    static function findByUsername($username)
    {
        global $pdo;
        try {
            $stmt = $pdo->prepare("SELECT * FROM members WHERE username = ?");
            $stmt->execute([$username]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return null;
        }
    }
} 