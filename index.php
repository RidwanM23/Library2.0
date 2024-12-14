<?php
session_start();
define('SECURE_ACCESS', true);

$uri = $_SERVER['REQUEST_URI'];
$query_string = $_SERVER['QUERY_STRING'] ?? NULL;

if ($uri == '/') {
    return require 'controllers/HomeController.php';
}

if ($uri == '/visitor') {
    return require 'controllers/VisitorController.php';
}

if ($uri == '/membership') {
    return require 'controllers/MembershipController.php';
}

if ($uri == '/book') {
    return require 'controllers/BookController.php';
}

if ($uri == '/book?' . $query_string) {
    return require 'controllers/BookController.php';
}

if ($uri == '/login' || $uri == '/register') {
    return require 'controllers/AuthController.php';
}

// Tambahkan route untuk peminjaman
if (isset($_GET['page']) && $_GET['page'] == 'borrow-book') {
    require_once 'controllers/LoanController.php';
    $controller = new LoanController();
    return $controller->borrow();
}

// Tambahkan route untuk pengembalian
if (isset($_GET['page']) && $_GET['page'] == 'return-book') {
    require_once 'controllers/LoanController.php';
    $controller = new LoanController();
    return $controller->return();
}

// Tambahkan route untuk member
if (isset($_GET['page']) && $_GET['page'] == 'member-register') {
    require_once 'controllers/MemberController.php';
    $controller = new MemberController();
    return $controller->register();
}

if (isset($_GET['page']) && $_GET['page'] == 'member-dashboard') {
    require_once 'controllers/MemberController.php';
    $controller = new MemberController();
    return $controller->dashboard();
}

return require 'views/notFoundPage.php';
