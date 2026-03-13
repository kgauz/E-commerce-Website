<?php 
include("confi.php");
session_start();

if(!isset($_SESSION['user'])) {
    $_SESSION['no-username'] = '<div class="error-message">Please login to access admin Panel</div>';
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Update order</title>
</head>
<body>

<script src="script.js"></script>
    <div class="nav-links">
        <h1>Krowned</h1>
        <div class="nav-link">
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

    <h1>Update OrderStatus</h1>

    <?php
    if(isset($_SESSION['update_order'])) {
        echo $_SESSION['update_order'];
        unset($_SESSION['update_order']);
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = $conn->query("SELECT * FROM table_order WHERE id = '$id' ");

        if($sql && $sql->num_rows > 0) {
            $row = $sql->fetch_assoc();

            $status= $row['status'];
            
            ?>
            
            <form action="" method="POST" >
                <table class="form-container">
                   <tr>
                        <td>Status</td>
                        <td>
                            <select name="orderStatus" id="orderStatus" class="status-dropdown">
                                 <option value="Paid" <?php if($status == 'Paid') echo 'selected'; ?>>Paid</option>
                                <option value="onDelivery" <?php if($status == 'onDelivery') echo 'selected'; ?>>On Delivery</option>
                                <option value="Delivered" <?php if($status == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                <option value="Canceled" <?php if($status == 'Canceled') echo 'selected'; ?>>Canceled</option>
                            </select>
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
    ?>

   
</body>
</html>

<?php
if(isset($_POST['Submit'])) {
    $status = $_POST['orderStatus'];


    // update Sales
    $sql = "UPDATE table_order SET status = '$status' WHERE id = '$id'";
    echo $sql;
    if($conn->query($sql)) {
        $_SESSION['update_order'] = '<div class="correct-message">Order updated successfully</div>';
        header("Location:order.php");
        echo "hello";
        
    } else {
        $_SESSION['update_order'] = '<div class="error-message">Order update failed</div>';
        header("Location:updateOrder.php?id=$id");
        exit;
    }
}
?>
