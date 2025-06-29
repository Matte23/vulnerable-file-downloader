<?php

function getDatabaseConnection() {
    $config = require __DIR__ . '/config.php';
    $dsn = "mysql:host={$config['database']['host']};dbname={$config['database']['dbname']};charset={$config['database']['charset']}";
    
    try {
        $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage() . ". Check your configuration:" . $dsn . "\n credentials: " . $config['database']['username'] . ":" . $config['database']['password']);
    }
}
?>