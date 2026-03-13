<?php

include("confi.php");
session_start();
?>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Krowned Hair Extensions</title>
  <!-- <link rel="stylesheet" href="style.css"/> -->
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<div class="navbar">
 <nav >
      <div id="burger" class="menu-icon">&#9776;</div>
      <div class="closeMenu" id="closePage">&times;</div>
     <div class="logo-container ">
    <img src="logo4.png" alt="Krowned Logo" class="logo-img" />
  </div>
   <div class="menuLinks" id="menuPanel">
  <ul class="navLinks ">

      <li>
    <a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">
      Home
    </a>
  </li>
  <li>
    <a href="shop.php" class="<?= $currentPage === 'shop.php' ? 'active' : '' ?>">
      Shop hair
    </a>
  </li>
  <li>
    <a href="shopSale.php" class="<?= $currentPage === 'shopSale.php' ? 'active' : '' ?>">
      Sale
    </a>
  </li>
  <li>
    <a href="about.php" class="<?= $currentPage === 'about.php' ? 'active' : '' ?>">
      About
    </a>
  </li>
  
  <li>
    <a href="contact.php" class="<?= $currentPage === 'contact.php' ? 'active' : '' ?>">
      Contact
    </a>
  </li>

  </ul>
 
  <div class="userLogin" id="ProfileLog">
  <svg class="userProfile" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#FFFFFF"><path d="M226-262q59-42.33 121.33-65.5 62.34-23.17 132.67-23.17 70.33 0 133 23.17T734.67-262q41-49.67 59.83-103.67T813.33-480q0-141-96.16-237.17Q621-813.33 480-813.33t-237.17 96.16Q146.67-621 146.67-480q0 60.33 19.16 114.33Q185-311.67 226-262Zm253.88-184.67q-58.21 0-98.05-39.95Q342-526.58 342-584.79t39.96-98.04q39.95-39.84 98.16-39.84 58.21 0 98.05 39.96Q618-642.75 618-584.54t-39.96 98.04q-39.95 39.83-98.16 39.83ZM480.31-80q-82.64 0-155.64-31.5-73-31.5-127.34-85.83Q143-251.67 111.5-324.51T80-480.18q0-82.82 31.5-155.49 31.5-72.66 85.83-127Q251.67-817 324.51-848.5T480.18-880q82.82 0 155.49 31.5 72.66 31.5 127 85.83Q817-708.33 848.5-635.65 880-562.96 880-480.31q0 82.64-31.5 155.64-31.5 73-85.83 127.34Q708.33-143 635.65-111.5 562.96-80 480.31-80Zm-.31-66.67q54.33 0 105-15.83t97.67-52.17q-47-33.66-98-51.5Q533.67-284 480-284t-104.67 17.83q-51 17.84-98 51.5 47 36.34 97.67 52.17 50.67 15.83 105 15.83Zm0-366.66q31.33 0 51.33-20t20-51.34q0-31.33-20-51.33T480-656q-31.33 0-51.33 20t-20 51.33q0 31.34 20 51.34 20 20 51.33 20Zm0-71.34Zm0 369.34Z"/></svg></a>
    <p>Log in</p>
     <div class="full_width">
      <a href="#" aria-label="Instagram" class="social-icon">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="white">
      <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.8-.9a1.1 1.1 0 11-2.2 0 1.1 1.1 0 012.2 0z"/>
    </svg>
  </a>

  <a href="#" aria-label="TikTok" class="social-icon">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="white">
      <path d="M12.6 2h2.1c.3 2.3 1.6 3.7 3.8 3.9v2.2c-1.5.1-2.9-.4-3.8-1v6.1c0 3.1-2.2 5.6-5.4 5.6A5.6 5.6 0 019 7.8a5.5 5.5 0 013.6-.4v2.3a3.2 3.2 0 00-1.5-.2c-1.4.2-2.4 1.4-2.3 2.8a2.8 2.8 0 003.3 2.6c1.2-.3 2-1.4 2-2.6V2z"/>
    </svg>
  </a>
      
</div>



</div>

</div>
 
  <div class="login">
   <div class="search-box" id="searchBox">
   
  <form action="search.php" method="GET">
  <input class="search" type="text" name="q" placeholder="    Search...">
   <!-- <button type="submit"  name="Submit"class="shop-btn">Search</button>  -->
     
</form>
<span class="close-panel" id="closeButton">&times;</span>
    

  </div>
  <div class="mobile-Search-icon" id="mobileIcon" style="cursor: pointer;">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"  fill="#fff">
      <path d="M792-120.67 532.67-380q-30 25.33-69.64 39.67Q423.39-326 378.67-326q-108.44 0-183.56-75.17Q120-476.33 120-583.33t75.17-182.17q75.16-75.17 182.5-75.17 107.33 0 182.16 75.17 74.84 75.17 74.84 182.27 0 43.23-14 82.9-14 39.66-40.67 73l260 258.66-48 48Zm-414-272q79.17 0 134.58-55.83Q568-504.33 568-583.33q0-79-55.42-134.84Q457.17-774 378-774q-79.72 0-135.53 55.83-55.8 55.84-55.8 134.84t55.8 134.83q55.81 55.83 135.53 55.83Z"/>
    </svg> 
    </div> 

  
  <div class="cart-icon" id="cartBtn" style="cursor: pointer;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 4h-2l-1 2h16l-3 9h-11l-1-2h-2v2h2l3 9h10v-2h-9l-2-6h12l3-9h-18v2z"/></svg>
    <div class="cart-badge" id="cartBadge">0</div>
  </div>
   <div class="customerInfor"id="ProfileLog" style="cursor: pointer;">
  <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#FFFFFF"><path d="M226-262q59-42.33 121.33-65.5 62.34-23.17 132.67-23.17 70.33 0 133 23.17T734.67-262q41-49.67 59.83-103.67T813.33-480q0-141-96.16-237.17Q621-813.33 480-813.33t-237.17 96.16Q146.67-621 146.67-480q0 60.33 19.16 114.33Q185-311.67 226-262Zm253.88-184.67q-58.21 0-98.05-39.95Q342-526.58 342-584.79t39.96-98.04q39.95-39.84 98.16-39.84 58.21 0 98.05 39.96Q618-642.75 618-584.54t-39.96 98.04q-39.95 39.83-98.16 39.83ZM480.31-80q-82.64 0-155.64-31.5-73-31.5-127.34-85.83Q143-251.67 111.5-324.51T80-480.18q0-82.82 31.5-155.49 31.5-72.66 85.83-127Q251.67-817 324.51-848.5T480.18-880q82.82 0 155.49 31.5 72.66 31.5 127 85.83Q817-708.33 848.5-635.65 880-562.96 880-480.31q0 82.64-31.5 155.64-31.5 73-85.83 127.34Q708.33-143 635.65-111.5 562.96-80 480.31-80Zm-.31-66.67q54.33 0 105-15.83t97.67-52.17q-47-33.66-98-51.5Q533.67-284 480-284t-104.67 17.83q-51 17.84-98 51.5 47 36.34 97.67 52.17 50.67 15.83 105 15.83Zm0-366.66q31.33 0 51.33-20t20-51.34q0-31.33-20-51.33T480-656q-31.33 0-51.33 20t-20 51.33q0 31.34 20 51.34 20 20 51.33 20Zm0-71.34Zm0 369.34Z"/></svg>
</div>

</div>
</nav>
<!-- <script>
  const navLinks = document.querySelectorAll(".navLinks li a");
 console.error("hello");
  navLinks.forEach(link => {
    link.addEventListener("click", () => {
      navLinks.forEach(l => l.classList.remove("active"));
       console.error("hello here");
      link.classList.add("active");
    });
  });
</script>  -->
<script>

  const email = <?php echo json_encode( $_SESSION['email']) ?>;

  document.addEventListener("DOMContentLoaded", () => {
    const profile = document.querySelectorAll("#ProfileLog");

  profile.forEach(profileIcon => {
    profileIcon.addEventListener("click", () => {
        if((email === "" || email === null) )
        {
           window.location.href = "emailLogin.php";
        }
        else{
           window.location.href = "userPage.php";
        }
    });
  });
    
  
  });
 </script>
 


</div>


