<?php 
include("confi.php");
session_start();

      if(!isset($_SESSION['user']))
      {
         header("Location: login.php");
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

    <h1>Change Admin</h1>
    <?php 
        session_start();
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
        <div class="table">

            <form  action="" method="POST">
                <div class="form-admin"> 
                    <Label>Old Password</Label> 
                    <input  type="password" name="password" placeholder="Enter old password" required >
                    </div>

                    <div class="form-admin"> 
                        <Label>Current Password</Label>
                    <input type="password" name="currentPassword" placeholder ="Enter new password" required >
                    </div>

                    <div class="form-admin"> 
                        <Label>Confirm password</Label>
                        <input type="password" name="confirmPassword" placeHolder="Confirm password"  required>
                    </div>
                    <input type="submit" name="Submit" value="Change" class="Submit"  required>
                
                </form>
        </div>




 <footer>Copy right </footer> 


    
</body>
</html>



<?php 

$id = $_GET['id'] ?? '';
   session_start();

if(isset($_POST['Submit']))
{
    $oldPasswordEntered = md5($_POST['password']);
    $currentPassword =  md5($_POST['currentPassword']);
    $cornfirmPassword =  md5($_POST['confirmPassword']);

    $fullName = $conn->query("SELECT * FROM table_admin WHERE id = '$id' ");

    if($fullName)
    {

        $conter= mysqli_num_rows($fullName);
        if($conter > 0)
        {
            $rows =mysqli_fetch_assoc($fullName);
                
            $oldPassword = $rows['password'];


            if($oldPasswordEntered == $oldPassword) 
            {
    
               # $_SESSION['newPassword'] = 'Password match old one';
              
                   
                if($cornfirmPassword == $currentPassword)
                {
                    $pass = $conn->query("UPDATE table_admin  SET password = '$currentPassword'  WHERE id ='$id' ");

                    if($pass)
                    {
                        $_SESSION['Password'] = 'Your password has been changed successfully.';
                        header("Location:admin.php");
                    }
                    else{
                        $_SESSION['Password'] = '<div class="error-message">An error occurred while accessing the database. Please try again later. </div>';
                       # header("Location:admin.php");
                       
                    }
                 
                } 
                else{
                    $_SESSION['Password'] = '<div class="error-message">Your current password does not match the confirmation. Kindly re-enter your passwords</div>';
                    #header("Location:admin.php");
                  
                }

            }
            else{
                 $_SESSION['newPassword'] = '<div class="error-message">Your password does not match the old one </div>';
                 header("Location:admin.php");
            }

           
        }
    }

}


           



?>


