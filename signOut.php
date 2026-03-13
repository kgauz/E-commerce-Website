<?php
session_start();
require "confi.php";

$email = $_SESSION['email'];


// $stmt = $conn->prepare("UPDATE UserProfile SET uniqueCode='NULL' WHERE Email=?");
//  $stmt->bind_param("s", $email);
// $stmt->execute();

$sql = $conn->query("UPDATE UserProfile SET uniqueCode='Null' WHERE Email='$email'");


session_unset();
session_destroy();

header("Location: index.php");
exit;
?>
