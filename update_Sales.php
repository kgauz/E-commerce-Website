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
    <title>Update Sales</title>
</head>
<body>
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

    <h1>Update Sales</h1>

    <?php
    if(isset($_SESSION['update_sales'])) {
        echo $_SESSION['update_sales'];
        unset($_SESSION['update_sales']);
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = $conn->query("SELECT * FROM Sales WHERE id = '$id' ");

        if($sql && $sql->num_rows > 0) {
            $row = $sql->fetch_assoc();

            $Title       = $row['title'];
            $OldPrice    = $row['OldPrice'];
            $newPrice    = $row['newPrice'];
            $Active      = $row['active'];
            $ImageName   = $row['ImageName'];
            $description = $row['description'];
            $inches      = $row['inches'];
            ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form-container">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo htmlspecialchars($Title); ?>"></td>
                    </tr>

                    <tr>
                        <td>Old Price</td>
                        <td><input type="number" step="0.01" name="OldPrice" value="<?php echo htmlspecialchars($OldPrice); ?>"></td>
                    </tr>

                    <tr>
                        <td>New Price</td>
                        <td><input type="number" step="0.01" name="newPrice" value="<?php echo htmlspecialchars($newPrice); ?>"></td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td><input type="text" name="description" value="<?php echo htmlspecialchars($description); ?>"></td>
                    </tr>

                    <tr>
                        <td>Inches</td>
                        <td><input type="text" name="inches" value="<?php echo htmlspecialchars($inches); ?>"></td>
                    </tr>

                    <tr>
                        <td>Select image</td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Current Image</td>
                        <td>
                            <?php if(!empty($ImageName)): ?>
                                <img src="category/<?php echo htmlspecialchars($ImageName); ?>" style="max-width:100px; height:auto;">
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Active</td>
                        <td class="radio-button">
                            <label><input type="radio" name="active" value="Yes" <?php if($Active == "Yes") echo "checked"; ?>> Yes</label>
                            <label><input type="radio" name="active" value="No" <?php if($Active == "No") echo "checked"; ?>> No</label>
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
    $Title       = $_POST['title'];
    $OldPrice    = $_POST['OldPrice'];
    $newPrice    = $_POST['newPrice'];
    $Active      = $_POST['active'];
    $description = $_POST['description'];
    $inches      = $_POST['inches'];

    // get old image
    $res = $conn->query("SELECT ImageName FROM Sales WHERE id='$id'");
    $row = $res->fetch_assoc();
    $ImageName = $row['ImageName'];

    // if new image uploaded
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $newImage = "sale_" . rand(1000, 9999) . "." . $ext;

        $upload_dir = __DIR__ . "/category/";
        $destination_path = $upload_dir . $newImage;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination_path)) {
            $ImageName = $newImage;
        }
    }

    // update Sales
    $sql = "UPDATE Sales SET 
                title       = '$Title',
                OldPrice    = '$OldPrice',
                newPrice    = '$newPrice',
                ImageName   = '$ImageName',
                active      = '$Active',
                description = '$description',
                inches      = '$inches'
            WHERE id = '$id'";

    if($conn->query($sql)) {
        $_SESSION['update_sales'] = '<div class="correct-message">Sale updated successfully</div>';
        header("Location: Sales.php");
        exit;
    } else {
        $_SESSION['update_sales'] = '<div class="error-message">Sale update failed</div>';
        header("Location: update_Sales.php?id=$id");
        exit;
    }
}
?>
