<?php

require_once 'models/Book.php';
require_once 'controllers/Controller.php';

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user adalah admin
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header("Location: index.php?page=login");
            exit;
        }
    }

    public function manageBooks()
    {
        $books = Book::get();
        require 'views/admin/books.php';
    }

    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = Book::create($_POST);
                if ($result) {
                    header("Location: index.php?page=manage-books&success=1");
                    return;
                }
            } catch (Exception $e) {
                $this->error = $e->getMessage();
            }
        }
        require 'views/admin/add_book.php';
    }

    public function updateStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $bookId = $_POST['book_id'];
                $amount = (int)$_POST['amount'];
                
                $result = Book::addStock($bookId, $amount);
                if ($result) {
                    header("Location: index.php?page=manage-books&success=2");
                    return;
                }
            } catch (Exception $e) {
                $this->error = $e->getMessage();
            }
        }
        header("Location: index.php?page=manage-books");
    }
} 