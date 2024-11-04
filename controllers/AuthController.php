<?php

require_once 'Controller.php';

class AuthController extends Controller
{
    public static function index()
    {
        return self::view("views/login.php");
    }

    public static function register()
    {
        return self::view("views/register.php");
    }
}

if ($uri == '/login') {
    return AuthController::index();
}

AuthController::register();
