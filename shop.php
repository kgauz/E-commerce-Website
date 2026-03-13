<?php include("header.php")?>

<body>
 
<div class="cart-panel" id="cartPanel">
  <span class="close-panel" id="closeCart">&times;</span>
  <h2>Your Cart</h2>
  <div id="cartItems"></div>
  <div class="cart-total">Total: R<span id="total">0</span></div>
  <button class="checkout-btn" id="checkoutBtn">Checkout</button>
</div>

<section class="product-section frontal">
  <h2 class="page-name diff">Home ><span>Shop Page</span></h2>
  <br>

  <div class="product-grid shop">
    <?php
      $sql = $conn->query("SELECT * FROM table_hair WHERE featured ='Yes' AND active ='Yes'");

      if ($sql) {
          $count = mysqli_num_rows($sql);
          if ($count > 0) {
              while ($row = mysqli_fetch_assoc($sql)) {
                  $Title = $row['title'];
                  $imageName = $row['image_name'];
                  $price = $row['price'];
                  $description = $row['description'];
                  ?>
                  
                  <div class="product-card"  data-name="<?php echo htmlspecialchars($Title); ?>"  data-price="<?php echo htmlspecialchars($price); ?>" data-img="<?php echo ($imageName != "") ? 'category/' . htmlspecialchars($imageName) : 'images/placeholder.jpg'; ?>">
                      <?php if ($imageName != "") { ?>
                          <img src="category/<?php echo htmlspecialchars($imageName); ?>" 
                               alt="<?php echo htmlspecialchars($Title); ?>">
                      <?php } else { ?>
                          <img src="images/placeholder.jpg" alt="No Image">
                      <?php } ?>

                      <p><?php echo htmlspecialchars($Title); ?></p>
                      <p><?php echo htmlspecialchars($description); ?>
                      R<?php echo htmlspecialchars($price); ?></p>

                      <!-- <a href="#shop" class="shop-btn">Add to cart</a> -->
                       <button class="add-cart-btn">Add to Cart</button>
                  </div>

                  <?php
              }
          } else {
              echo "<p>No products found.</p>";
          }
      }
    ?>
  </div>
</section>

 <!-- <div class="product-card-cart" data-name="Frontal" data-price="350" data-img="images/image1-removebg-preview.png">
    <img src="images/image1-removebg-preview.png" alt="Frontal">
    <p>Frontal</p>
    <p>R350</p>
    <button class="add-cart-btn">Add to Cart</button>
  </div> -->


<section class="cta-section">
  <h2>Not Sure What to Choose?</h2>
  <p>Let us help you find the perfect hair extension for your style and budget.</p>
  <a href="contact.php" class="shop-btn">Get in Touch</a>
</section>

<section class="reviews">
  <h2>What Our Customers Say</h2>
  <div class="review-grid">
    <div class="review-card">
      <p>"The hair is so soft and lasted me months!"</p>
      <span>- Amina M.</span>
    </div>
    <div class="review-card">
      <p>"Fast delivery and amazing quality, will definitely buy again."</p>
      <span>- Kea R.</span>
    </div>
    <div class="review-card">
      <p>"Best hair I've ever used – 100% recommend!"</p>
      <span>- Lerato K.</span>
    </div>
  </div>
</section>

<?php include("footer.php")?>
  <script src="script.js"></script>


</body>
</html>
