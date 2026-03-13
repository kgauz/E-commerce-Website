

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: emailLogin.php");
    exit;
}
?>
 <?php
 ob_start(); 
// Start session & validate user first
require "logoutInfor.php"; // must be first

// Now include header HTML
include "header_order.php";
?>

<div class="user">


   
<?php
 echo "<p class='sh'>Orders</p>";
?>
 <?php

if (!isset($_SESSION['email'])) {
    echo "<h3 class='messageMiddle'>You are not logged in. Please log in first.</h3>";
    exit();
}

$email = $_SESSION['email'];
// echo "<p>Welcome, $email</p><br>";

// Query to get user orders
$query = "SELECT id, hairType, quantity, status, order_date 
          FROM table_order 
          WHERE customer_email = '$email'";

$result = mysqli_query($conn, $query);



if (!$result) {
    echo "<p>Error fetching orders: " . mysqli_error($conn) . "</p>";
    exit();
}

if (mysqli_num_rows($result) == 0) {
    echo "<div class='noAccount'>
    <p>No orders found for this account.<br> Go to store to place order</p>
    </div>";
} else {

    echo "<table border='1' cellpadding='1'>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr> ";

    while ($row = mysqli_fetch_assoc($result)) {
        $statusColor = match($row['status']) {
            'onDelivery' => 'orange',
            'Paid' => 'green',
            'Delivered' => 'green',
            'Cancelled' => 'red',
            default => 'gray'
        };

        echo "<tr>
                <td>{$row['hairType']}</td>
                <td>{$row['quantity']}</td>
                <td style='color:$statusColor;'>{$row['status']}</td>
                <td>{$row['order_date']}</td>
              </tr>";
    }
        
    echo "</table>";
}

mysqli_close($conn);
ob_end_flush(); 
?>

</div>

</body>

</html>


