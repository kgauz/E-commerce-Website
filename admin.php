
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

    <h1>Manage Admin</h1>

    <?php 
        session_start();
        if(isset($_SESSION['add']))
        {
          echo $_SESSION['add'];
          unset($_SESSION['add']); //remove it from the session
        }
          if(isset($_SESSION['delete']))
        {
          echo $_SESSION['delete'];
          unset($_SESSION['delete']); //remove it from the session
        }
          if(isset($_SESSION['update']))
        {
          echo $_SESSION['update'];
          unset($_SESSION['update']); //remove it from the session
        }

        if(isset($_SESSION['newPassword']))
        {
          echo $_SESSION['newPassword'];
          unset($_SESSION['newPassword']); //remove it from the session
        }
        if(isset($_SESSION['Password']))
        {
          echo $_SESSION['Password'];
          unset($_SESSION['Password']); //remove it from the session
        }
        
    
    ?>


    
    <div class="admin-button">
      <a href="add_admin.php" >Add admin</a>
    </div>


<div class="table">
  <table >
    <tr>
      <th>Id</th>
      <th>FullName</th>
      <th>userName</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>

    <?php

    session_start();
 
$sql = mysqli_query($conn, "SELECT * FROM table_admin");

if ($sql) {
    $counter = mysqli_num_rows($sql);

    if ($counter > 0) {
        $sn = 1;
        while ($rows = mysqli_fetch_assoc($sql)) {
            $id       = $rows['id'];
            $fullName = $rows['fullName'];  // exact column name
            $userName = $rows['userName'];
            $email    = $rows['email'];
            ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $fullName; ?></td>
              <td><?php echo $userName; ?></td>
              <td><?php echo $email; ?></td>
              <td>
                <div class="buttonUpDe">
                   <a href="changePassword.php?id=<?php echo $id;?>" class="primary">Change Password</a>
                    <a href="update_admin.php?id=<?php echo $id;?>" class="primary">Update admin</a>
                     <a href="delete-admin.php?id=<?php echo $id;?>" class="secondary">Delete admin</a> 
                    <!-- <a href="delete-admin.php?id=<?php echo $id; ?>" class="secondary">Delete</a> -->

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
