<!DOCTYPE html>
<html lang="en">
  <?php 
  include("confi.php");
  session_start();
  
  ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Krowned Hair Extensions</title>
  <!-- <link rel="stylesheet" href="style.css"/> -->
 <style>

*{
    padding:0;
    margin:0;
      box-sizing: border-box;
}
#otpInput {
  padding-left: 15px;
  height: 45px;
}

#otpInput::placeholder {
  font-size: 14px;
  color: #999;
}

.emailLogin {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
  border: 1px solid #fff;
  width: 100%;
  height: 330px;
  max-height: 500px;
  background: white;
  flex-direction: column;
  padding:30px;
  overflow:hidden;
}
#expired {
  display: none;
  color: red;
  font-size: 14px;
  margin-top: 8px;
}
span{
  font-size:14px;
  max-width: 100%;
  word-break: break-word;
  overflow-wrap: anywhere;
}

#difLog{
  margin-top:4px;
}
 #difLog a{
  color:blue;
   text-decoration: none;
   font-size:14px;

}
body{
     background-color: #f5f5f5;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      display:flex;
      overflow:hidden;


}
.centerLogin{
  margin-top: 20px;
  display:flex;
  flex-direction:column;
  gap:10px;
}

.centerLogin input, button{
     padding:15px 80px;
     border-radius: 10px;
     border: 1px solid blue;
     width: 100%;
     outline:none;
     
     
}
.centerLogin input{
   border-color:grey;
}

input:focus{
  border-color:blue;
}
button{
  background-color:#0408f1;
  color:#fff;
  border:none;
  outline:none;
}
button:hover{
  background-color: #020353;
  transition: 0.5s;
}
.logo-container h2{
  align-items:center;
  display:flex;
  justify-content:center;
  margin-top:5px;
  font-weight: normal;

  
}
h3{
  font-weight:bolder;
}
.logo-container img{
   width:50%;
   height:200px;
}
.log{
  display:flex;
  margin-top:20px;
  flex-direction:column;
  align-items:flex-start;
  justify-content:flex-start;
 
}
.log p{
  color:grey;
}

#incorrectDigits{
  display:none;
  color:red;
  margin-top:5px;
  margin-bottom:5px;
  font-size:14px;
}
@media screen and (min-width: 630px), print{

.emailLogin {
  width: 55%;
  height: 350px;
  max-height: 5000px;
  padding:25px;
}
.centerLogin input{
     border-radius: 10px;
     
}
}


/* 
/* Media
Query for Desktop
Viewport */
@media screen and (min-width: 1015px), print { 

.emailLogin {
  width: 35%;
  height: 350px;
  max-height: 5000px;
  padding:30px;
}
    
}


    </style>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>


<body>
    <div class = "emailLogin">
        <form  action ="" method="POST">
             <div class="logo-container">
               <h2>Krowned Hair</h2>
            </div>
            <div class="log">
            <h3>Enter code </h3>
                     <?php
    if(isset($_SESSION['email']))
    {
         ?>
          <span><p >Sent to <?php echo $_SESSION['email']; ?></p></span>

         <?php
    }
    ?>
    </div>
            
            <div class="centerLogin">
             <input type="text"   id="otpInput" name="otp" placeholder="6-digit code" required>
       
            <?php if (!empty($_SESSION['otp_expired'])): ?>
              <p id="expired" style="display:block;">OTP has expired, try again</p>
              <?php unset($_SESSION['otp_expired']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['otp_invalid'])): ?>
  <p id="incorrectDigits" style="display:block;">Enter the correct 6-digit code</p>
  <?php unset($_SESSION['otp_invalid']); ?>
<?php endif; ?>
            
           <button type="submit" name="verify">Submit</button>  
        <p id ="difLog" ><a href="emailLogin.php" > Sign in with a different email </a> </p>

            </div>

        </form>
    </div>




<?php
  date_default_timezone_set('Africa/Johannesburg');

if (isset($_POST['verify'])) {
    $user_otp = trim($_POST['otp']);
     $email = $_SESSION['email'];

     $realOTP = $_SESSION['otp1'];

   

    // Fetch OTP & timestamp from DB
    $stmt = $conn->prepare("SELECT uniqueCode, otpCreatedAt FROM UserProfile WHERE Email=? ");
    $stmt->bind_param("s", $email);
    $stmt->execute(); 
   


    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        $dbToken = trim($row['uniqueCode']);
        $createdAt = new DateTime($row['otpCreatedAt']);
        $now = new DateTime();

        $otpExpiryMinutes = 5;

        $interval = $createdAt->diff($now);
        $minutesPassed =
            ($interval->days * 24 * 60) +
            ($interval->h * 60) + $interval->i;
     
   
        if ($minutesPassed > $otpExpiryMinutes) {
          $_SESSION['otp_expired'] = true;
             header("Location: verify_otp.php");
            exit;
        }

        if ($user_otp === $dbToken) {

            $_SESSION['loggedIn'] = true; 
            header("Location: userPage.php");
            exit;
        } else {
       
            $_SESSION['otp_invalid'] = true;
            unset($_SESSION['loggedIn']); 

            header("Location: verify_otp.php");
            exit;
        
    }
}
}
?>
<script>
  document.addEventListener("DOMContentLoaded", () => {
  const otpInput = document.getElementById("otpInput");

  if (document.getElementById("incorrectDigits")?.style.display === "block" ||
      document.getElementById("expired")?.style.display === "block") {
    otpInput.style.border = "1px solid red";
    otpInput.focus();
  }
});

  </script>

</body>

</html>
