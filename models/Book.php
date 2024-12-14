<?php

require_once 'config/database.php';

class Book
{
    private $id, $tittle, $author, $year;

    public function getId()
    {
        return $this->id;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getTittle()
    {
        return $this->tittle;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    static function filter($search)
    {
        global $pdo;
        try {
            $search = "%$search%";
            $stmt = $pdo->prepare("SELECT * FROM books WHERE tittle LIKE ?");
            $stmt->execute([$search]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }

    static function get()
    {
        global $pdo;
        try {
            $stmt = $pdo->prepare("SELECT * FROM books");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return [];
        }
    }

    static function findById($id)
    {
        global $pdo;
        try {
            $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return null;
        }
    }
}
