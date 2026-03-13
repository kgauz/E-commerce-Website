
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
    <h1>Order Manager</h1>


    <div class="admin-button">
      <a href="add_category.php" >Add Category</a>
    </div>

    <?php
    session_start();

    if(isset($_SESSION['category']))
    {
      echo $_SESSION['category'];
      unset ($_SESSION['category']);
    }
    if(isset($_SESSION['delete-category']))
    {
      echo $_SESSION['delete-category'];
      unset ($_SESSION['delete-category']);
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
      <th>Image</th>
      <th>Featured</th>
      <th>Active</th>
      <th>Actions</th>
    </tr>

    <?php

    session_start();
   

    $result =  $conn->query("SELECT * FROM table_category");

    if($result)
    {
      $count = mysqli_num_rows($result);

      if($count > 0)
      {
         $snt =1;
        while($rows = mysqli_fetch_assoc($result))
        {
           $title = $rows['title'];
           $ImageName = $rows['imageName'];
           $featured = $rows['featured'];
           $active = $rows['active'];
           $id = $rows['id'];

          ?>

            <tr>
              <td><?php echo $snt++ ?></td>
              <td><?php echo $title ?> </td>
              <td><img src="category/<?php echo $ImageName; ?>" style="max-width:70px; height:auto;" alt="Category Image"></td>
              <td><?php echo $featured ?></td>
              <td> <?php echo $active ?></td>
              <td>
                <div class="buttonUpDe">
                    <a href="update_category.php?id=<?php echo $id;?>" class="primary">Update category</a>
                     <a href="delete_category.php?id=<?php echo $id;?>" class="secondary">Delete category</a> 

                </div>
              </td>
              <tr>

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
