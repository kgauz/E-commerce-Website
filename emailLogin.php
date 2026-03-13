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
  padding:25px;
  overflow:hidden;
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

.centerLogin input{
     padding:15px 15px;
     border-radius: 10px;
     border: 1px solid blue;
     width: 100%;
     outline:none;
     border-color:blue;
     
}
input:focus{
  border-color:blue;
}

.btn{
 background-color:#0408f1;
  color:#fff;
  border:none;
}
.btn:hover{
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
  margin-top:20px;
}
.log p{
  color:grey;
}

@media screen and (min-width: 630px), print{

.emailLogin {
  width: 55%;
  height: 350px;
  max-height: 5000px;
  padding:30px;
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
              <!-- <img src="logo4.png" alt="Krowned Logo" class="logo-img" /> -->
               <h2>Krowned Hair</h2>
            </div>
            <div class="log">
            <h3>Sign in </h3>
            <p>Please sign in with your email address. A verification code will be sent to you.</p>
            
            <div class="centerLogin">
            <input type="email" name="email" placeholder="Email" required>
            <input type ="submit" class="btn" name="submit" value="Submit" requred>
            

            </div>
</div>

        </form>
    </div>



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    
       $api_key = '27e6c3c8149a43e19fb26e30117a3261'; //  AbstractAPI key

    // Step 1: Validate email with Abstract API
    // $url = "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=" . urlencode($email);
   // $url = "https://emailreputation.abstractapi.com/v1/?api_key=27e6c3c8149a43e19fb26e30117a3261&email=" . urlencode($email);
    $url ="https://emailreputation.abstractapi.com/v1/?api_key=03a09b73da2d4a15a24b494f3f4f1525&email=".urlencode($email);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    $result = json_decode($response, true);
  
 
   $deliverability = strtolower(trim($result['email_deliverability']['status'] ?? 'unknown'));
    $score = $result['email_quality']['score'] ?? '0';



    if (($deliverability )!= 'deliverable') {
         echo "<script>
        alert('Invalid or non-existent email. Please try again.');
    </script>";
        exit;
    }
   
   
    
    
    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);

    // Save OTP and email in session
    $_SESSION['otp1'] = $otp;
    $_SESSION['email'] = $email;
    $datetime= new DATETIME();


$sql = $conn->query("UPDATE UserProfile SET uniqueCode='$otp' WHERE Email='$email'");

if ($conn->affected_rows === 0) {
    $conn->query("INSERT INTO UserProfile (Email, uniqueCode) VALUES ('$email', '$otp')");
}

    
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kgauzatheprogrammingtutor1@gmail.com'; 
        $mail->Password   = 'qdbl mjow rrcq eeeh';   // Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('Krowned@gmail.com', 'Krowned Hair Extensions');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is <b>$otp</b>. It will expire in 5 minutes.";

        $mail->send();
        // Redirect user to OTP verification page
        header("Location: verify_otp.php");
        exit;
    } catch (Exception $e) {
        echo "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


  

</body>

</html>






