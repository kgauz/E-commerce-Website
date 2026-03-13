
<?php
 include("confi.php");
 session_start();
  
      if(!isset($_SESSION['user']))
      {
         $_SESSION['no-username'] = '<div class="error-message">Please login to access admin Panel </div>';
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
    <h1>Sales Manager</h1>


    <div class="admin-button">
      <a href="add_sales.php" >Add sale</a>
    </div>

    <?php
    session_start();

    if(isset($_SESSION['sales']))
    {
      echo $_SESSION['sales'];
      unset ($_SESSION['sales']);
    }
    if(isset($_SESSION['delete-Sales']))
    {
      echo $_SESSION['delete-Sales'];
      unset ($_SESSION['delete-Sales']);
    }

    if(isset( $_SESSION['update-category']))
    {
      echo  $_SESSION['update-category'];
      unset( $_SESSION['update-category']);
    }
    
    ?>

<div class="table">
  <table border="1" cellspacing="0" cellpadding="8">
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>NewPrice</th>
      <th>OldPrice</th>
      <th>Image</th>
      <th>Active</th>
      <th>Description</th>
      <th>Inches</th>
      <th>Actions</th>
    </tr>

    <?php

    session_start();
   

    $result =  $conn->query("SELECT * FROM Sales");

    if($result)
    {
      $count = mysqli_num_rows($result);

      if($count > 0)
      {
         $snt =1;
        while($rows = mysqli_fetch_assoc($result))
        {
           $title = $rows['title'];
           $ImageName = $rows['ImageName'];
           $active = $rows['active'];
           $id = $rows['id'];
          $oldPrice = $rows['OldPrice'];
          $newPrice = $rows['newPrice'];
          $description = $rows['description'];
          $inches = $rows['inches'];

          ?>

            <tr>
              <td><?php echo $snt++ ?></td>
              <td><?php echo $title ?> </td>
              <td><?php echo $newPrice ?> </td>
              <td><?php echo $oldPrice ?> </td>
              <td><img src="category/<?php echo $ImageName; ?>" style="max-width:70px; height:auto;" alt="Category Image"></td>
              <td><?php echo $active ?> </td>
              <td><?php echo $description ?> </td>
              <td><?php echo $inches ?> </td>
              <td>
                <div class="buttonUpDe">
                    <a href="update_Sales.php?id=<?php echo $id;?>" class="primary">Update category</a>
                     <a href="delete_Sales.php?id=<?php echo $id;?>&image_name=<?php echo $imageName;?>" class="secondary">Delete Sales</a> 

                </div>
              </td>

            </tr>

          <?php


        }
      }
    }

  ?>

  </table>


</div>


    



 <footer>Copy right </footer> 


    
</body>
</html>
