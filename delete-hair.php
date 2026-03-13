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

 

    $sql = $conn->query("DELETE FROM table_hair WHERE id =$id");

    if($sql)
    {
        $_SESSION['delete_hair'] = "<div class='correct-message'>Hair removed from the database </div>";
        header("Location: hair.php");
    }
    else{
        $_SESSION['delete_hair'] = '<div class="error-message">Hair not removed </div>';
        header("Location: hair.php");
    }



 ?>
