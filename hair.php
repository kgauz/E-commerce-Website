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
    <h1>Hair Manager</h1>

    <?php

    session_start();
      if(isset($_SESSION['hair']))
      {
        echo $_SESSION['hair'];
        unset($_SESSION['hair']);
      }

      if(isset($_SESSION['delete_hair']))
      {
        echo  $_SESSION['delete_hair'];
        unset($_SESSION['delete_hair']);
      }
      if(isset($_SESSION['update_hair']))
      {
        echo  $_SESSION['update_hair'];
        unset($_SESSION['update_hair']);
      }
    ?>

     <div class="admin-button">
      <a href="add_hair.php" >Add Hair</a>
    </div>

<div class="table">
  <table border="1" cellspacing="0" cellpadding="8">
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Price</th>
      <th>Image</th>
      <th>CategoryId</th>
      <th>featured</th>
      <th>Active</th>
      <th>Actions</th>
    </tr>
    <?php

    session_start();
 
$sql = mysqli_query($conn, "SELECT * FROM table_hair");

if ($sql) {
    $counter = mysqli_num_rows($sql);

    if ($counter > 0) {
        $sn = 1;
        while ($rows = mysqli_fetch_assoc($sql)) {
            $id       = $rows['id'];
            $Title = $rows['title'];  
            $description = $rows['description'];
            $Price    = $rows['price'];
            $imageName    = $rows['image_name'];
            $categoryID    = $rows['category_id'];
            $featured    = $rows['featured'];
            $active    = $rows['active'];
            ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $Title; ?></td>
              <td><?php echo $description; ?></td>
              <td><?php echo $Price; ?></td>
              <td><img src="category/<?php echo $imageName; ?>" style="max-width:70px; height:auto;" alt="hair Image"></td>
              <td><?php echo $categoryID; ?></td>
              <td><?php echo $featured; ?></td>
              <td><?php echo $active; ?></td>
              <td>
                <div class="buttonUpDe">
                    <a href="update_hair.php?id=<?php echo $id;?>&image_name=<?php echo $imageName;?>" class="primary">Update hair</a>
                     <a href="delete-hair.php?id=<?php echo $id;?>&image_name=<?php echo $imageName;?>" class="secondary">Delete hair</a> 

                </div>
              </td>
            </tr>
            <?php
        }
    }
} else {
    $_SESSION['error'] = 'not found';
}
?>


   
  </table>

</div>


    



 <footer>Copy right </footer> 


    
</body>
</html>
