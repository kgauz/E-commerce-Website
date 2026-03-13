<?php include("header.php")?>

<body>
<!-- 
cart page -->
<!-- Slide-in Cart Panel -->
 
<div class="cart-panel" id="cartPanel">
  <span class="close-panel" id="closeCart">&times;</span>
  <h2>Your Cart</h2>
  <div id="cartItems"></div>
  <div class="cart-total">Total: R<span id="total">0</span></div>
  <button class="checkout-btn" id="checkoutBtn">Checkout</button>
</div>

<section class="product-section">
  <br><br><br>
  <?php

  if(isset($_GET['q']))
  {
    ?>
     <h2><?php echo $_GET['q'] ; ?></h2>
     <?php

  }
  else{
    ?>
     <h2>Nothing has been searched </h2>
     <?php
  }
  ?>
  
 
    
  <div class="product-grid shop">
    <?php

if(isset($_GET['q'])) {
    // Get the search input and escape it
    $q = mysqli_real_escape_string($conn, $_GET['q']);

    // SQL query with LIKE for title or description
    $sql = "SELECT * FROM table_hair 
            WHERE title LIKE '%$q%' 
               OR description LIKE '%$q%'";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $price = $row['price'];
            $imageName = $row['image_name'];
            $description = $row['description'];
            ?>
            <div class="product-card"  
                 data-id="<?php echo $row['id']; ?>"
                 data-name="<?php echo htmlspecialchars($title); ?>"  
                 data-price="<?php echo htmlspecialchars($price); ?>"  
                 data-img="<?php echo ($imageName != "") ? 'category/' . htmlspecialchars($imageName) : 'images/placeholder.jpg'; ?>">

                <div class="image-container">
                    <img src="category/<?php echo htmlspecialchars($imageName); ?>" alt="<?php echo htmlspecialchars($title); ?>">    
                    <br><br><button class="add-cart-btn">Add to cart</button>
                </div>

                <div class="prices">
                    <p>R<?php echo $price; ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No products found for '$q'.</p>";
    }
}
?>

  
  </div>
</section>


<?php include("footer.php")?>


<!--  IT Girl Section  -->

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="script.js"></script>



</body>
</html>
