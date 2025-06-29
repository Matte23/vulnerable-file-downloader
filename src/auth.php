<?php
session_start();
require_once 'db.php';

function login($username, $password) {
    $db = getDatabaseConnection();
    $query = "SELECT * FROM users WHERE username = '$username'";
    $stmt = $db->query($query);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout() {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}
