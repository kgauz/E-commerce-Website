
<?php 
  include("confi.php");
  
  session_start();
      if(!isset($_SESSION['user']))
      {
         $_SESSION['no-username'] = '<div class="error-message">Please login to access admin Panel </div>';
         header("Location: login.php");
         exit;

      }
     

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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

    <div class="dash">
        <h3>Dashboard </h3>
        <?php 
                    session_start();
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    ?>

    </div>
    <div class="category">
        <p>5 Category</p>
        <p>5 Category</p>
        <p>5 Category</p>
        <p>5 Category</p>
    </div>
    
    
    <div class="text-align1">
        <h3>Welcome Admin here </h3>
    </div>


   <!-- <h1>Welcome Admin here,  <?= $_SESSION['name']; ?>!</h1> -->

 <footer>Copy right </footer> 


    
</body>
</html>
