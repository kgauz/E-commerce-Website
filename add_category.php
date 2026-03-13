
<?php 
  include("confi.php");
  session_start();
      if(!isset($_SESSION['user']))
      {
         $_SESSION['no-username'] = '<div class="error-message">Please login to access admin Panel</div>';
         header("Location: login.php");

      }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>login system</title>
</head>

<body>
    <!-- start of the menu  -->
    <div class="nav-links">
        <h1>Krowned</h1>
        <div class ="nav-link">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="shopOrder.php">Category</a></li>
                <li><a href="hair.php">Hair</a></li>
                <li><a href="Sales.php">Sales</a></li>
                <li><a href="order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
                
                
            </ul>
        </nav>
    </div>

      

    </div>

    <h1>Add Category</h1>
    <?php 
        session_start();
        if(isset($_SESSION['order']))
        {
          echo $_SESSION['order'];
          unset($_SESSION['order']); //remove it from the session
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
<form action="" method="POST" enctype="multipart/form-data">
  <table class="form-container ">
      <tr > 
        <td>Title</td>
        <td>
          <input type="text" name="title" placeholder="Enter title" required>
        </td>
      </tr>

      <tr > 
        <td>Select image</td>
        <td>
          <input type="file" name="imageName" >
        </td>
      </tr>

      <tr >      
        <td>Featured</td>
        <td class="radio-button">
          <label><input type="radio" name="featured" value="Yes" required> Yes</label><br>
          <label><input type="radio" name="featured" value="No"> No</label>
        </td>
      </tr>

      <tr > 
        <td>Active</td>
        <td class="radio-button">
          <label><input type="radio" name="active" value="Yes" required> Yes</label><br>
          <label><input type="radio" name="active" value="No"> No</label>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="text-align:center;">
          <input type="submit" name="Submit" value="Submit" class="Submit">
        </td>
      </tr>
  </table>
</form>




 <footer>Copy right </footer> 


    
</body>
</html>

<?php

  session_start();
  require_once 'confi.php';

    if(isset($_POST['Submit']))
    {
        $Title = $_POST['title'];
        $Featured = $_POST['featured'];
        $Active =$_POST['active'];

         // print_r($_FILES['imageName']);
         //die();

       if (isset($_FILES['imageName']['name']) && $_FILES['imageName']['error'] == 0) {






        // 1. Get extension
    $ext = pathinfo($_FILES['imageName']['name'], PATHINFO_EXTENSION);

    // 2. Rename file
    $image_name = "hair_category_" . rand(000, 999) . "." . $ext;

    // 3. Absolute path for saving
    $upload_dir = __DIR__ . "/category/"; // -> /opt/lampp/htdocs/newOne/category/

    // 4. Destination file (server path)
    $destination_path = $upload_dir .$image_name;

    // 5. Temporary file from PHP
    $source_path = $_FILES['imageName']['tmp_name'];


    // 6. Move uploaded file
    if (move_uploaded_file($source_path, $destination_path)) {
        $_SESSION['upload'] =  "Upload successful!<br>";

    } else {
        $_SESSION['upload'] =  " Upload failed.<br>";
    }


}


        // store into the database
       $respond = $conn->query("INSERT INTO table_category (title,imageName,featured,active ) VALUES('$Title', '$image_name', '$Featured', '$Active')");
       echo "hello";

       if($respond)
       {
         $_SESSION['category'] = "<div class='correct-message'>Order has been added </div>";
            header("Location: add_category.php");
            
       }
       else
       {
         $_SESSION['category'] = "<div class='error-message'>Order has not been added </div>";
             header("Location: shopOrder.php");
       }


    }
    




?>
