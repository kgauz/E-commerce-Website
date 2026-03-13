
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


if(isset($_GET['id']) && isset($_GET['image_name']))
{
    $image_name = $_GET['image_name'];
     $id = $_GET['id'];

    if($image_name != "")
   {
        $path=  __DIR__ . "/category/"; // -> /opt/lampp/htdocs/newOne/category/

            // 4. Destination file (server path)
            $destination_path = $path .$image_name;
            unlink($destination_path);
       

    }
}

$sql = $conn->query("DELETE FROM Sales WHERE id = '$id' ");

if($sql)
{
     if ($conn->affected_rows > 0) {
        $_SESSION['delete-Sales'] = "<div class='correct-message'>Sale removed from the database</div>";
    } else {
        $_SESSION['delete-Sales'] = "<div class='error-message'>No sale found with ID $id</div>";
    }
    header("Location: Sales.php");
}
else{
     $_SESSION['delete-Sales'] = "<div class='error-message'>SQL Error: '. $conn->error . '</div>";
    header("Location: shopOrder.php");
}
?>