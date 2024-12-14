<?php

require_once 'config/database.php';

class Loan
{
    private $id, $member_id, $book_id, $borrowed_at, $due_date;
    private $returned_at, $fine_amount;
    
    const FINE_PER_DAY = 1000; // Rp 1.000 per hari
    const LOAN_DURATION = 7; // 7 hari durasi peminjaman

    public function getId()
    {
        return $this->id;
    }

    public function getDueDate()
    {
        return $this->due_date;
    }

    public function getReturnedAt()
    {
        return $this->returned_at;
    }

    public function getFineAmount()
    {
        return $this->fine_amount;
    }

    public function calculateFine()
    {
        if (!$this->returned_at) return 0;
        
        $dueDate = new DateTime($this->due_date);
        $returnDate = new DateTime($this->returned_at);
        
        if ($returnDate <= $dueDate) return 0;
        
        $diff = $returnDate->diff($dueDate);
        return $diff->days * self::FINE_PER_DAY;
    }

    static function borrow($memberId, $bookId)
    {
        global $pdo;
        
        try {
            $pdo->beginTransaction();

            // Cek stok buku
            $book = Book::findById($bookId);
            if ($book->getStock() <= 0) {
                throw new Exception("Stok buku tidak tersedia");
            }

            // Kurangi stok
            $book->updateStock(-1);

            // Buat peminjaman
            $dueDate = date('Y-m-d', strtotime('+' . self::LOAN_DURATION . ' days'));
            $query = $pdo->prepare("INSERT INTO loans (member_id, book_id, borrowed_at, due_date) VALUES (?, ?, NOW(), ?)");
            $query->execute([$memberId, $bookId, $dueDate]);

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    static function return($loanId)
    {
        global $pdo;
        
        try {
            $pdo->beginTransaction();

            // Update loan
            $query = $pdo->prepare("UPDATE loans SET returned_at = NOW() WHERE id = ?");
            $query->execute([$loanId]);

            // Hitung denda
            $loan = self::findById($loanId);
            $fine = $loan->calculateFine();

            // Update denda
            $query = $pdo->prepare("UPDATE loans SET fine_amount = ? WHERE id = ?");
            $query->execute([$fine, $loanId]);

            // Kembalikan stok
            $book = Book::findById($loan->book_id);
            $book->updateStock(1);

            $pdo->commit();
            return $fine;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    static function findById($id)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM loans WHERE id = ?");
        $query->execute([$id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'Loan');
        return $query->fetch();
    }

    static function getActiveLoansByMember($memberId)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM loans WHERE member_id = ? AND returned_at IS NULL");
        $query->execute([$memberId]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Loan');
    }
} 