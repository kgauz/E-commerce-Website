
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
   <br>
    <h1>Add Hair</h1>

    <?php

    if(isset($_SESSION['hair']))
    {
      echo $_SESSION['hair'];
      unset($_SESSION['hair']);
    }


    ?>

<div>
<form action="" method="POST" enctype="multipart/form-data">
  <table class="form-container">
    <tr>
      <td>Title</td>
      <td>
        <input type='text' name='title' placeholder="Title" required>
      </td>

    </tr>

    <tr>
      <td>Description</td>
      <td>
        <input type='text' name='Description' placeholder="Description" required>
      </td>

    </tr>

     <tr>
      <td>Price</td>
      <td>
        <input type="number" name="Price" placeholder="0" min="0" step="0.01"  required>
      </td>

    </tr>
    <tr>
      <td>Image</td>
      <td>
        <input type="file" name="image" required>
      </td>

    </tr>
     <tr>
      <td>Category</td>
     
      <?php
           
           session_start();
           include("confi.php");

           $sql = $conn->query("SELECT * FROM table_category WHERE active ='Yes'");
         
           if($sql)
           {
              $count = mysqli_num_rows($sql);
              ?>
               <td>
                <select name ='categoryId'>
                  <?php
              if($count > 0)
              {
                
                while($row=mysqli_fetch_assoc($sql))
                {
                    $Title = $row['title'];
                    $id = $row['id'];
                    echo $Title;

                    ?>
                    
                        <option value="<?php  echo $id; ?>"><?php echo $Title; ?></option>
                   
                    <?php


                }
                ?>
                  </select>
                    </td>
                <?php
              }
              else{
                ?>
                 <option value="0">no value</option>
                 <?php
              }
             
           }
          


      ?>

    </tr>
     <tr>
      <td>Featured</td>
      <td class="radio-button">
        <QLabel>
           <input type="radio" name="featured"  value= "Yes" required> Yes
        </QLabel><br>
          <QLabel>
            <input type="radio" name="featured"  value= "No"  required>   No
        </QLabel>
       
      </td>

    </tr>

     <tr>
      <td>Active</td>
      <td class="radio-button">
        <QLabel>
           <input type="radio" name="active"  value= "Yes" required> Yes
        </QLabel><br>
          <QLabel>
            <input type="radio" name="active"  value= "No"  required>   No
        </QLabel>
       
      </td>

    </tr>

      <tr>
        <td colspan="2" style="text-align:center;">
          <input type="submit" name="Submit" value="Add" class="Submit">
        </td>
      </tr>

  


  </table>
</form>

</div>


    



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
        $Price = $_POST['Price'];
        $Description = $_POST['Description'];

        if(isset( $_POST['categoryId']))
        {
           $CategoryID = $_POST['categoryId'];
        }
        else
        {
           $CategoryID = "0";
        }




         print_r($_FILES['image']);
         //die();

       if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {

   
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    echo $ext;

   
    $image_name = "hair_" . rand(000, 999) . "." . $ext;

    
    $upload_dir = __DIR__ . "/category/"; 

   
    $destination_path = $upload_dir .$image_name;


    $source_path = $_FILES['image']['tmp_name'];
      echo $source_path;


    if (move_uploaded_file($source_path, $destination_path)) {
        $_SESSION['upload'] =  "Upload successful!<br>";

    } else {
        $_SESSION['upload'] =  " Upload failed.<br>";
    }


}
else{
   $image_name = "no image selected";
}

        // store into the database
       $respond = $conn->query("INSERT INTO table_hair (title,description,price,image_name,category_id,featured,active ) VALUES('$Title','$Description','$Price','$image_name','$CategoryID','$Featured', '$Active')");
        
       if($respond)
       {
         $_SESSION['hair'] = "<div class='correct-message'>Hair has been added </div>";
            header("Location: hair.php"); 
       }
       else
       {
         $_SESSION['hair'] = "<div class='error-message'>Hair has not been added </div>";
             header("Location: add_hair.php");
       }


    }
    




?>