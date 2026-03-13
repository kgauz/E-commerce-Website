<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    header("Location: input.php");
    exit();
}
?>
<h1>Welcome User, <?= $_SESSION['name']; ?>!</h1>
<a href="input.php">Logout</a>
