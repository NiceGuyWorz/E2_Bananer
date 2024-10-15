<?php
// controllers/AuthController.php

session_start();

require_once '../models/User.php';

class AuthController
{
    // Display the login form
    public function showLoginForm()
    {
        require '../views/auth/login.php';
    }

    // Process the login form
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Validate input
            if (empty($email) || empty($password)) {
                $error = "Please enter both email and password.";
                require '../views/auth/login.php';
                return;
            }

            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['clave'])) {
                // Authentication successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email_institucional'];
                $_SESSION['role'] = $user['role']; // e.g., 'bananer' or 'regular'

                // Redirect to the main menu
                header('Location: menu.php');
                exit();
            } else {
                // Authentication failed
                $error = "Invalid email or password.";
                require '../views/auth/login.php';
            }
        } else {
            $this->showLoginForm();
        }
    }

    // Logout the user
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

// Router logic
$authController = new AuthController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $authController->login();
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            $authController->showLoginForm();
            break;
    }
} else {
    $authController->showLoginForm();
}
