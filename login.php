
<?php include('confi.php') ?>

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

    <div class ="container">
       
        <div class ="form-box">
            <form  action=""  method="POST">
                 <?php 
                  session_start();
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                   if(isset( $_SESSION['no-username']))
                   {
                       echo   $_SESSION['no-username'];
                   }
                  
                   
                    ?>
                <h3>Login</h3>

            
              
                <input type="text" name="userName" placeholder="username" required>
                <input type="password" name="password" placeholder=" Password" required>
                <br><br>
                <input type="submit" name="login" value="Login" class="btn3" required>

            </form>
        </div>

    </div>
   


    
</body>
</html>


<?php
session_start();

if(isset($_POST['login']))
{
    $username = $_POST['userName'];
    $password = md5($_POST['password']);

    $sql = $conn->query("SELECT * FROM table_admin WHERE password ='$password' AND userName ='$username'");
  
        $count = $sql->num_rows;

        if($count ==1)
        {
              $row = $sql->fetch_assoc(); 
              $database_pass = $row['password'];
              $username_database = $row['userName']; 

                $_SESSION['login'] = "<div class='correct-message'>logged in  Successfully</div>";
                $_SESSION['user'] = $username;
                header("Location: home.php");

       }
         else
        {
            $_SESSION['login'] = "<div class='error-message'>No data found for specific username and password</div>";
             header("Location: login.php");
            exit;
        }

    
  
}
?>

    

