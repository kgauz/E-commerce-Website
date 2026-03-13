<?php 
  include("confi.php");
  session_start();
      if(!isset($_SESSION['user']))
      {
         $_SESSION['no-username'] = '<div class="error-message">Please login to access admin Panel</div>';
         header("Location: login.php");

      }

  ?>

<?php include("confi.php")
?>
<?php 
session_start();

$id = $_GET['id'];
 

$sql = $conn->query("DELETE FROM table_admin WHERE id =$id");

if($sql)
{
    $_SESSION['delete'] = "Admin removed from the database";
    header("Location: admin.php");
}
else{
    $_SESSION['delete'] = 'Admin not removed';
     header("Location: admin.php");
}


 ?>
