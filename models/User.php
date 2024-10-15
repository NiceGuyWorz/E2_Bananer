<?php
// models/User.php

require_once '../config/db.php';

class User
{
    private $pdo;

    public function __construct()
    {
        // Use the PDO instance from db.php
        global $pdo;
        $this->pdo = $pdo;
    }

    // Get user by email
    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email_institucional = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    // Check if the user exists as professor or administrative
    public function existsInSystem($email, $role)
    {
        $stmt = $this->pdo->prepare('
            SELECT p.RUN
            FROM persona p
            INNER JOIN ' . ($role === 'professor' ? 'academico a' : 'administrativo a') . ' ON p.RUN = a.RUN
            WHERE p.Mail_Institucional = :email
        ');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() !== false;
    }

    // Register a new user in Bananer
    public function registerBananerUser($email, $hashedPassword, $role)
    {
        // Insert into users table
        $stmt = $this->pdo->prepare('INSERT INTO users (email_institucional, clave, role) VALUES (:email, :clave, :role)');
        return $stmt->execute([
            'email' => $email,
            'clave' => $hashedPassword,
            'role'  => $role,
        ]);
    }

    // Additional methods as needed
}
