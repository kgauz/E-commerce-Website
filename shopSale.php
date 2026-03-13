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
    <h2 class="page-name sales">Home ><span>NEW SALES</span></h2>

  <div class="product-grid shop">
    <?php
      
      $sql = "SELECT * FROM Sales WHERE active='Yes'";
      $result = mysqli_query($conn, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $title = $row['title'];
          $newPrice = $row['newPrice'];
          $oldPrice = $row['OldPrice'];
          $imageName = $row['ImageName'];
          $inches = $row['inches'];
          $description = $row['description'];
    ?>
          <div class="product-card"  
               data-id="<?php echo $row['id']; ?>"
               data-name="<?php echo htmlspecialchars($title); ?>"  
               data-price="<?php echo htmlspecialchars($newPrice); ?>"  
               data-img="<?php echo ($imageName != "") ? 'category/' . htmlspecialchars($imageName) : 'images/placeholder.jpg'; ?>">

            <div class="image-container">
              <img src="category/<?php echo htmlspecialchars($imageName); ?>" alt="<?php echo htmlspecialchars($title); ?> ">    
              <a href="shop.php?id=<?php echo $row['id']; ?>" class="new">sale</a>
            </div>

            <div class="prices">
              <p><?php echo $inches; ?>" R<?php echo $newPrice; ?></p>
              <p>WAS <span class="was">R<?php echo $oldPrice; ?></span></p>
            </div>
             <button class="add-cart-btn">Add to cart</button>
          </div>
    <?php
        }
      } else {
        echo "<p>No active products available right now.</p>";
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
