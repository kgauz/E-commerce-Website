
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

    <h1>Add Admin</h1>
    <?php 
        session_start();
        if(isset($_SESSION['add']))
        {
          echo $_SESSION['add'];
          unset($_SESSION['add']); //remove it from the session
        }
    ?>

<div class="table">

   <form  action="" method="POST">
    <div class="form-admin"> 
        <Label>Name</Label>
        <input type="text" name="fullName" placeHolder="Enter your full name" required>
    </div>

     <div class="form-admin"> 
        <Label>userName</Label>
       <input type="text" name="userName" placeHolder="Enter your username" required>
    </div>

     <div class="form-admin">      
        <Label>Password</Label>
        <input type="password" name="password" placeHolder="Enter your password " required>
    </div>
     <div class="form-admin"> 
        <Label>Email</Label>
        <input type="email" name="email" placeHolder="Enter your email" required>
    </div>
    <input type="submit" name="Submit" value="Submit" class="Submit" required>
  
  

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
        $Name = $_POST['fullName'];
        $UserName =$_POST['userName'];
        $Password = md5($_POST['password']);
        $Email =$_POST['email'];


        // store into the database
       $respond = $conn->query("INSERT INTO table_admin (fullName,userName,password, email) VALUES('$Name', '$UserName', '$Password', '$Email')");

       if($respond == TRUE)
       {
         $_SESSION['add'] = "The admin is added successfully";
             header("Location: admin.php");
             exit();

       }
       else
       {
         $_SESSION['add'] = "The admin is not added succssfully";
       }


    }
    




?>
