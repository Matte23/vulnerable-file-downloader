<?php
require_once 'config.php';
require_once 'db.php';
require_once 'auth.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = __DIR__ . '/files/' . $file;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit();
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>