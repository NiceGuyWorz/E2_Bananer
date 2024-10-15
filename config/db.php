<?php
// config/db.php

// Database credentials
$host     = 'localhost';       // Your database host
$db       = 'academia_db';     // The name of your database
$user     = 'postgres';        // Your PostgreSQL username
$pass     = 'your_password';   // Your PostgreSQL password
$port     = '5433';            // The default PostgreSQL port
$charset  = 'utf8';            // Character set

// Data Source Name (DSN)
$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

// Create a PDO instance
try {
    $pdo = new PDO($dsn, null, null, $options);
} catch (\PDOException $e) {
    // Handle connection errors
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
