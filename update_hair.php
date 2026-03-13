
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
                <li><a href="order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
        </nav>
    </div>

    </div>

    <h1>Update Hair</h1>

    <?php
    session_start();

    if(isset($_SESSION['update_hair']))
    {
        echo $_SESSION['update_hair'];
        unset($_SESSION['update_hair']);
    }

    ?>

    <?php
    session_start();

    if(isset($_GET['id']))
      {
          $id = $_GET['id'];

          $sql = $conn->query("SELECT * FROM table_hair WHERE id = '$id' ");

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
                $ImageName = $rows['image_name'];
                $description = $rows['description'];
                $Price    = $rows['price'];
                $categoryID    = $rows['category_id'];


                ?>
                        
             <form action="" method="POST" enctype="multipart/form-data">
               <table class="form-container ">
              <tr > 
                <td>Title</td>
                <td>
                  <input type="text" name="title" value="<?php echo htmlspecialchars($Title) ; ?>" >
                </td>
              </tr>

               <tr > 
                <td>Description</td>
                <td>
                  <input type="text" name="description" value="<?php echo htmlspecialchars($description) ; ?>" >
                </td>
              </tr>
              <tr > 
                <td>Price</td>
                <td>
                  <input type="number" name="Price" value="<?php echo  htmlspecialchars($Price) ; ?>" >
                </td>
              </tr>

               <tr > 
                <td>Select image</td>
                 <td>
                  <input type="file" name="image">
                </td>
              </tr>

              <tr > 
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
                <td>CategoryId</td>
                <td>
                  <input type="number" name="category" value="<?php echo  htmlspecialchars($categoryID) ; ?>" >
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
    
if (isset($_POST['Submit'])) {
    $Title       = $_POST['title'];
    $Featured    = $_POST['featured'];
    $Active      = $_POST['active'];
    $description = $_POST['description'];
    $Price       = $_POST['Price'];
    $categoryID  = $_POST['category'];


    // 1. Get current image
    $res = $conn->query("SELECT image_name FROM table_hair WHERE id='$id'");
    $row = $res->fetch_assoc();
    $ImageName = $row['image_name']; // keep old image by default



    // 2. If new file uploaded
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $newImage = "category_" . rand(1000, 9999) . "." . $ext;

        $upload_dir = __DIR__ . "/category/";
        $destination_path = $upload_dir . $newImage;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination_path)) {
            // replace only if upload successful
            $ImageName = $newImage;
            $_SESSION['updated'] = "Image updated successfully!";
        } else {
            $_SESSION['updated'] = "Image failed to update.";
        }
    }
    // 3. Update query
    $sql = "UPDATE table_hair SET 
                title       = '$Title',
                description = '$description',
                price       = '$Price',
                image_name  = '$ImageName',
                category_id = '$categoryID',
                featured    = '$Featured',
                active      = '$Active'
            WHERE id = '$id'";
     
    $respond = $conn->query($sql);

    if ($respond) {
        $_SESSION['update_hair'] = '<div class="correct-message">Hair data updated</div>';
        header("Location: hair.php");
        exit;
    } else {
        $_SESSION['update_hair'] = '<div class="error-message">Hair data not updated</div>';
        header("Location: update_hair.php?id=$id");
        exit;
    }
}


?>
