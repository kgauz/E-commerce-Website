
<?php 
  include("confi.php");
  session_start();
      if(!isset($_SESSION['user']))
      {
         $_SESSION['no-username'] = '<div class="error-message">Please login to access admin Panel</div>';
         header("Location: login.php");

      }

  ?>
<?php 
include("confi.php");
?>
<?php
session_start();

 $id = $_GET['id'] ?? '';

if (!is_numeric($id)) {
    die("Invalid ID");
}

$sql = $conn->query("DELETE FROM table_category WHERE id = '$id' ");

if($sql)
{
     if ($conn->affected_rows > 0) {
        $_SESSION['delete-category'] = "<div class='correct-message'>Category removed from the database</div>";
    } else {
        $_SESSION['delete-category'] = "<div class='error-message'>No category found with ID $id</div>";
    }
    header("Location: shopOrder.php");
}
else{
     $_SESSION['delete-category'] = "<div class='error-message'>SQL Error: '. $conn->error . '</div>";
    header("Location: shopOrder.php");
}
?>