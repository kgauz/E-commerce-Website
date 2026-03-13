<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require "confi.php";

// Get session variables
$email = $_SESSION['email'] ?? '';
$token = $_SESSION['otp1'] ?? '';

// If email or token is missing, redirect
if (empty($email) || empty($token)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

// Prepare query safely
$stmt = $conn->prepare("SELECT uniqueCode FROM UserProfile WHERE email = ? LIMIT 1");
if (!$stmt) {
    // If prepare fails, destroy session and redirect
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// If no user found, destroy session and redirect
if ($result->num_rows !== 1) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

// Fetch unique code from DB
$row = $result->fetch_assoc();

// Validate token
if (!isset($row['uniqueCode']) || trim($row['uniqueCode']) !== trim($token)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
