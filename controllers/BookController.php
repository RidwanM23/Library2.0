<?php

require_once 'Controller.php';

class BookController extends Controller
{
    public static function index()
    {
        return self::view("views/book.php");
    }
}

BookController::index();
