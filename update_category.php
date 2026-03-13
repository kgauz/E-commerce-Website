
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

    <h1>Update Category</h1>

    <?php
    session_start();

    if(isset($_SESSION['update_category']))
    {
        echo $_SESSION['update_category'];
        unset($_SESSION['update_category']);
    }

    ?>

    <?php
    session_start();

    if(isset($_GET['id']))
      {
          $id = $_GET['id'];

          $sql = $conn->query("SELECT * FROM table_category WHERE id = '$id' ");

          if($sql)
          {
            $count = mysqli_num_rows($sql);
           

            if($count > 0)
            {
              while($rows = mysqli_fetch_assoc($sql))
              {
                $Title = $rows['title'];
                $Featured = $rows['featured'];
                $Active = $rows['active'];
                $ImageName = $rows['imageName'];


                ?>
                        
             <form action="" method="POST" enctype="multipart/form-data">
               <table class="form-container ">
              <tr > 
                <td>Title</td>
                <td>
                  <input type="text" name="title" placeholder="<?php echo $Title ; ?>" >
                </td>
              </tr>

              <tr>
                 <td>Current image</td>
                  <td>
                  <?php if(!empty($ImageName)): ?>
                    <img src="category/<?php echo htmlspecialchars($ImageName); ?>" 
                          alt="Current Hair Image" 
                           style="max-width:100px; height:auto; border:1px solid #ccc; border-radius:2px;">
                  <?php endif; ?>
                </td>
              </tr>

              <tr > 
                <td>Select image</td>
                 <td>
                  <input type="file" name="imageName">
                </td>
              </tr>

              <tr>      
            <td>Featured</td>
            <td class="radio-button">
              <label>
                <input type="radio" name="featured" value="Yes" 
                  <?php if($Featured == "Yes") echo "checked"; ?> > Yes
              </label><br>
              <label>
                <input type="radio" name="featured" value="No" 
                  <?php if($Featured == "No") echo "checked"; ?> > No
              </label>
            </td>
          </tr>
              <tr > 
                <td>Active</td>
                <td class="radio-button">
                  <label><input type="radio" name="active" value="Yes"
                    <?php if($Active == "Yes") echo "checked"; ?> required> Yes
                </label><br>
                  <label><input type="radio" name="active" value="No"
                    <?php if($Active == "No") echo "checked"; ?> required> No
                </label>
                </td>
              </tr>

              <tr>
                <td colspan="2" style="text-align:center;">
                  <input type="submit" name="Submit" value="Update" class="Submit">
                </td>
              </tr>

          </table>
        </form>
    
          <?php




              }
            }
          }
      }
      else
      {
        $id = ' ';
      }


    ?>



 <footer>Copy right </footer> 


    
</body>
</html>


<?php

  session_start();
  require_once 'confi.php';
  $id = $_GET['id'];
    if(isset($_POST['Submit']))
    {
        $Title = $_POST['title'];
        $Featured = $_POST['featured'];
        $Active =$_POST['active'];
        $ImageName = $_POST['imageName'];


           if (isset($_FILES['imageName']['name']) && $_FILES['imageName']['error'] == 0) {
                $ext = pathinfo($_FILES['imageName']['name'], PATHINFO_EXTENSION);

                // generate a new name OR keep original
                $ImageName = "category_" . rand(1000,9999) . "." . $ext;

                $upload_dir = __DIR__ . "/category/";
                $destination_path = $upload_dir . $ImageName;
                $source_path = $_FILES['imageName']['tmp_name'];

                if (move_uploaded_file($source_path, $destination_path)) {
                    $_SESSION['updated'] = "Image updated successfully!<br>";
                } else {
                    $_SESSION['updated'] = "Image failed to update.<br>";
                }
          }



        // update the database
        $sql = "UPDATE table_category SET 
            featured = '$Featured',
            active = '$Active'";

            if (!empty($Title)) {
                $sql .= ", title = '$Title'";
            }
            if (!empty($ImageName)) {
                $sql .= ", imageName = '$ImageName'";
            }

            $sql .= " WHERE id = '$id'";

        $respond = $conn->query($sql);


      if($respond)
      {
          $_SESSION['update-category'] = '<div class="correct-message">category data updated </div>';
          header("Location: shopOrder.php");
          
      }
      else
      {
          $_SESSION['update-category'] = '<div class="error-message">category data not updated </div>';
          header("Location: update_category.php");
      }


    }
    




?>
