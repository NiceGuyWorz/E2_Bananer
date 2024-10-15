<?php
// index.php

session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the main menu or dashboard
    header('Location: controllers/ReportController.php');
    exit();
} else {
    // Redirect to the login page
    header('Location: controllers/AuthController.php?action=login');
    exit();
}
