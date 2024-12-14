<?php

class Controller
{
    protected $error;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public static function view($view, $data = [])
    {
        if (!defined('SECURE_ACCESS')) {
            die('Direct access not permitted');
        }
        return require $view;
    }
}
