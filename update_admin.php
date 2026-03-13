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
    <h1>Update Admin</h1>
    <?php 
        session_start();
        if(isset($_SESSION['update']))
        {
          echo $_SESSION['update'];
          unset($_SESSION['update']); //remove it from the session
        }
    ?>


<?php 

$id = $_GET['id'];

$fullName = $conn->query("SELECT * FROM table_admin WHERE id = '$id' ");

if($fullName)
{
    $conter= mysqli_num_rows($fullName);
    if($conter > 0)
    {
        while($rows =mysqli_fetch_assoc($fullName))
        {
            $name = $rows['fullName'];
            $username = $rows['userName'];
            $email = $rows['email'];
           

            ?>
            <div class="table">

                <form  action="" method="POST">
                    <div class="form-admin"> 
                        <Label>Name</Label>
                        <input type="text" name="fullName" placeholder="<?php echo htmlspecialchars($name); ?>" >

                    </div>

                    <div class="form-admin"> 
                        <Label>username</Label>
                    <input  type="text" name="userName" placeHolder="<?php echo $username ; ?>" >
                    </div>

                    <div class="form-admin"> 
                        <Label>Email</Label>
                        <input type="email" name="email" placeHolder="<?php echo $email ; ?>" >
                    </div>
                    <input type="submit" name="Submit" value="Update" class="Submit" >
            
                </form>
                </div>
                <?php
        }
    }
}

?>






 <footer>Copy right </footer> 


    
</body>
</html>


<?php 
$id = $_GET['id'];
session_start();

#echo $id;

if(isset($_POST['Submit']))
{ 
      $name = $_POST['fullName'];
      $username = $_POST['userName'];
      $email = $_POST['email'];

      $sql = $conn->query("UPDATE table_admin SET  fullName ='$name', userName = '$username', email = '$email' WHERE id = '$id' ");
    echo "hello";
    if($sql)
    {
        $_SESSION['update'] = '<div class="correct-message">admin data updated </div>';
        header("Location: admin.php");
        echo "hello";
        
    }
    else
    {
        $_SESSION['update'] = '<div class="error-message">admin data not updated </div>';
        header("Location: admin.php");
        echo "not there";
    }

   
}
?>

