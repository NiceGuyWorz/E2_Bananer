<?php
// controllers/UserController.php

session_start();

require_once '../models/User.php';

class UserController
{
    // Ensure the user is authenticated and is 'bananer@lamejor.com'
    public function __construct()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['email'] !== 'bananer@lamejor.com') {
            header('Location: ../controllers/AuthController.php?action=login');
            exit();
        }
    }

    // Display the user registration form
    public function showRegistrationForm()
    {
        require '../views/users/register.php';
    }

    // Process the user registration form
    public function registerUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = $_POST['role']; // 'professor' or 'administrative'

            // Validate input
            if (empty($email) || empty($password) || empty($role)) {
                $error = "Please fill in all fields.";
                require '../views/users/register.php';
                return;
            }

            $userModel = new User();
            // Check if the user exists as professor or administrative
            if ($userModel->existsInSystem($email, $role)) {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Register the user in Bananer
                if ($userModel->registerBananerUser($email, $hashedPassword, $role)) {
                    $success = "User registered successfully.";
                    require '../views/users/register.php';
                } else {
                    $error = "Failed to register user.";
                    require '../views/users/register.php';
                }
            } else {
                $error = "The user must exist as a professor or administrative in the system.";
                require '../views/users/register.php';
            }
        } else {
            $this->showRegistrationForm();
        }
    }
}

// Router logic
$userController = new UserController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'register':
            $userController->registerUser();
            break;
        default:
            $userController->showRegistrationForm();
            break;
    }
} else {
    $userController->showRegistrationForm();
}
