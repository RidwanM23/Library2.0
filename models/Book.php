<?php

require_once 'config/database.php';

class Book
{
    private $id, $tittle, $author, $year, $stock;

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

    public function getStock()
    {
        return $this->stock;
    }

    public function updateStock($amount)
    {
        global $pdo;
        $query = $pdo->prepare("UPDATE books SET stock = stock + ? WHERE id = ?");
        return $query->execute([$amount, $this->id]);
    }

    static function filter($search)
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM books WHERE title LIKE '%$search%'");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Book');
    }

    static function get()
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM books");
        return $query->fetchAll(PDO::FETCH_CLASS, 'Book');
    }

    static function findById($id)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM books WHERE id = ?");
        $query->execute([$id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $query->fetch();
    }

    public function setStock($stock)
    {
        global $pdo;
        $query = $pdo->prepare("UPDATE books SET stock = ? WHERE id = ?");
        return $query->execute([$stock, $this->id]);
    }

    static function addStock($bookId, $amount)
    {
        global $pdo;
        $query = $pdo->prepare("UPDATE books SET stock = stock + ? WHERE id = ?");
        return $query->execute([$amount, $bookId]);
    }

    static function create($data)
    {
        global $pdo;
        $query = $pdo->prepare("INSERT INTO books (tittle, author, year, stock) VALUES (?, ?, ?, ?)");
        return $query->execute([
            $data['tittle'],
            $data['author'],
            $data['year'],
            $data['stock'] ?? 0
        ]);
    }
}
