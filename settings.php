<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: emailLogin.php");
    exit;
}
?>

<?php include("header_order.php")?>
  
<?php include("logoutInfor.php");?>


<div class="rap">

<div class="header5">
<p > Settings</p> 
</div>
<div class="settings">

    <div class="signOut">
        <div class="log">
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#ECB576"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
        <p>Sign out everywhere</p>
    </div>
        <p>If you've lost a device or have security concerns, <br>
             log out everywhere to ensure the security <br>of your account.</p>
    </div>

    <div class ="link-signout">
        <div class="linkSign"><a href="signOut.php" >Sign out everywhere</a></div>
        <p> You'll also be signed out on this device.</p>
    </div>
</div>
</div>

</body>









<script src="script.js"></script>
