<?php
require_once 'config.php';
require_once 'db.php';
require_once 'auth.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (isset($_SESSION['user'])) {
    if ($uri === '/files') {
        require 'files.php';
    } elseif ($uri === '/upload') {
        require 'upload.php';
    } elseif (preg_match('/^\/download\/(.+)$/', $uri, $matches)) {
        require 'download.php';
    } else {
        http_response_code(404);
        echo 'Page not found';
    }
} else {
    if ($uri === '/login') {
        require 'login.php';
    } else {
        header('Location: /login');
        exit();
    }
}