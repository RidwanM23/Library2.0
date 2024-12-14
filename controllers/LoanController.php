<?php

require_once 'models/Loan.php';
require_once 'models/Book.php';
require_once 'models/Member.php';
require_once 'controllers/Controller.php';

class LoanController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function borrow()
    {
        if (!isset($_SESSION['member_id'])) {
            header("Location: index.php?page=member-register");
            return;
        }

        $member = Member::findByUsername($_SESSION['username']);
        if (!$member) {
            header("Location: index.php?page=member-register");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = Loan::borrow($member->id, $_POST['book_id']);
                if ($result) {
                    header("Location: index.php?page=member-dashboard&success=1");
                    return;
                }
            } catch (Exception $e) {
                $this->error = $e->getMessage();
            }
        }

        $bookId = $_GET['book_id'] ?? $_POST['book_id'] ?? null;
        $book = $bookId ? Book::findById($bookId) : null;
        
        if (!$book) {
            header("Location: /book");
            return;
        }

        require 'views/loan/borrow.php';
    }

    public function return()
    {
        if (!$this->isLoggedIn()) {
            header("Location: index.php?page=login");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $fine = Loan::return($_POST['loan_id']);
                header("Location: index.php?page=member-dashboard&fine=" . $fine);
                return;
            } catch (Exception $e) {
                $this->error = $e->getMessage();
            }
        }

        header("Location: index.php?page=member-dashboard");
    }
} 