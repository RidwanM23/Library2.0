<?php

require_once 'models/Loan.php';
require_once 'models/Book.php';
require_once 'models/Member.php';
require_once 'controllers/Controller.php';

class LoanController extends Controller
{
    public function borrow()
    {
        if (!$this->isLoggedIn()) {
            header("Location: index.php?page=login");
            return;
        }

        $member = Member::findByUserId($_SESSION['user_id']);
        if (!$member) {
            header("Location: index.php?page=member-register");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = Loan::borrow($member->getId(), $_POST['book_id']);
                if ($result) {
                    header("Location: index.php?page=member-dashboard&success=1");
                    return;
                }
            } catch (Exception $e) {
                $this->error = $e->getMessage();
            }
        }

        $bookId = $_GET['book_id'] ?? null;
        $book = $bookId ? Book::findById($bookId) : null;
        
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