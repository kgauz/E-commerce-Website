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
                <li><a href="order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
                
            </ul>
        </nav>
    </div>

      

    </div>

    <h1>Hair Manager</h1>
     <?php
    if(isset($_SESSION['update_order'])) {
        echo $_SESSION['update_order'];
        unset($_SESSION['update_order']);
    }
    if(isset($_SESSION['delete-order']))
    {
      echo $_SESSION['delete-order'];
      unset ($_SESSION['delete-order']);
    }
    ?>

<div class="table order">
  <table >
    <!-- //<thead> -->
    <tr>
      <th>Id</th>
      <th>HairType</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
      <th>OrderDate</th>
      <th>Status</th>
      <th>CusName</th>
      <th>CusContact</th>
      <th>CusEmail</th>
      <th>CusAddress</th>
      <th>Actions</th>
    </tr>
    <!-- </thead>
    <tbody> -->

    <?php
     
     $sql= $conn->query("SELECT * FROM table_order");

     if($sql)
     {
        $count = mysqli_num_rows($sql);
        $isbn = 1;
        

        if($count > 0)
        {
          while($row=mysqli_fetch_assoc($sql))
          {
            $id = $row['id'];
            $hairType = $row['hairType'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $total = $row['total'];
            $orderDate = $orderDate = date("Y-m-d", strtotime($row['order_date']));
            $status = $row['status'];
            $customer_name =$row['customer_name'];
            $customer_contact =$row['customer_contact'];
            $customer_email=$row['customer_email'];
            $customer_address =$row['customer_address'];

            ?>
            <tr>
            <td><?php echo $isbn++; ?></td>
            <td><?php echo $hairType; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $total; ?></td>
            <td><?php echo $orderDate; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo $customer_name; ?></td>
            <td><?php echo $customer_contact; ?></td>
            <td><?php echo $customer_email; ?></td>
            <td><?php echo $customer_address; ?></td>
              <td>
                  <div class="buttonUpDe actions">
                      <a href="updateOrder.php?id=<?php echo $id;?>" class="primary">update</a>
                      <a href="delete_order.php?id=<?php echo $id;?>" class="secondary">Delete</a> 

                  </div>
                </td>
          
          </tr>
          <?php

          }
        }
        else{
          echo "No data in database";
        }

        

     }
     ?>
    




<!-- 
    </tbody> -->
  </table>

</div>


    



 <footer>Copy right </footer> 


    
</body>
</html>
 