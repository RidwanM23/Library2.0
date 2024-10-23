<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri == '/') {
    return require 'controllers/HomeController.php';
}

if ($uri == '/book') {
    return require 'controllers/BookController.php';
}

return require 'views/notFoundPage.php';
