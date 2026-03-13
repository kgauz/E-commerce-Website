<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php


// Load Composer autoloader
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // true enables exceptions

// If manual download, include PHPMailer files:
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';

$success = null;
$errors = [];

function clean($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = clean($_POST['name'] ?? '');
    $email   = clean($_POST['email'] ?? '');
    $subject = clean($_POST['subject'] ?? '');
    $message = clean($_POST['text'] ?? '');

    // Validation
    if (strlen($name) < 2) $errors[] = "Please enter your name.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address.";
    if (strlen($subject) < 3) $errors[] = "Please add a subject.";
    if (strlen($message) < 5) $errors[] = "Message is too short.";

    if (empty($errors)) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Use Gmail SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'kgauzatheprogrammingtutor1@gmail.com'; // <-- Replace with your Gmail
            $mail->Password   = 'qdbl mjow rrcq eeeh';   // <-- Use Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($email); // Your receiving email
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(false);
            $mail->Subject = "Contact form: " . ($subject ?: 'No subject');
            $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message\n\nSent from: localhost at " . date('Y-m-d H:i:s');

            $mail->send();
            $_SESSION['succsess'] = "Thanks — your message was sent successfully. We'll get back to you soon.";
            $success = $_SESSION['succsess'];

            $name = $email = $subject = $message = '';
        } catch (Exception $e) {
            $errors[] = "Sorry — we couldn't send your message. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>

<?php include("header.php")?>

<body>
  <div class="cart-panel" id="cartPanel">
  <span class="close-panel" id="closeCart">&times;</span>
  <h2>Your Cart</h2>
  <div id="cartItems"></div>
  <div class="cart-total">Total: R<span id="total">0</span></div>
  <button class="checkout-btn" id="checkoutBtn">Checkout</button>
</div>
  <section class="contactDetails">
    <h2 class="page-name">Home ><span>Contact Page</span></h2>
    <div class="contact">

    <div class="page phone">
        
        <div class="contact-page">
             <svg  xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="40px" fill="#B89230"><path d="M796-120q-119 0-240-55.5T333-333Q231-435 175.5-556T120-796q0-18.86 12.57-31.43T164-840h147.33q14 0 24.34 9.83Q346-820.33 349.33-806l26.62 130.43q2.05 14.9-.62 26.24-2.66 11.33-10.82 19.48L265.67-530q24 41.67 52.5 78.5T381-381.33q35 35.66 73.67 65.5Q493.33-286 536-262.67l94.67-96.66q9.66-10.34 23.26-14.5 13.61-4.17 26.74-2.17L806-349.33q14.67 4 24.33 15.53Q840-322.27 840-308v144q0 18.86-12.57 31.43T796-120ZM233-592l76-76.67-21-104.66H187q3 41.66 13.67 86Q211.33-643 233-592Zm365.33 361.33q40.34 18.34 85.84 29.67 45.5 11.33 89.16 13.67V-288l-100-20.33-75 77.66ZM233-592Zm365.33 361.33Z"/></svg>
            <div class="details call">
                <label class="label1">Call me</label>
                <br>
                <label class="label">999-888-444</label>
            </div>
       </div>

    <div class="contact-page " id ="icons">
            <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="40px" fill="#B89230"><path d="M796-120q-119 0-240-55.5T333-333Q231-435 175.5-556T120-796q0-18.86 12.57-31.43T164-840h147.33q14 0 24.34 9.83Q346-820.33 349.33-806l26.62 130.43q2.05 14.9-.62 26.24-2.66 11.33-10.82 19.48L265.67-530q24 41.67 52.5 78.5T381-381.33q35 35.66 73.67 65.5Q493.33-286 536-262.67l94.67-96.66q9.66-10.34 23.26-14.5 13.61-4.17 26.74-2.17L806-349.33q14.67 4 24.33 15.53Q840-322.27 840-308v144q0 18.86-12.57 31.43T796-120ZM233-592l76-76.67-21-104.66H187q3 41.66 13.67 86Q211.33-643 233-592Zm365.33 361.33q40.34 18.34 85.84 29.67 45.5 11.33 89.16 13.67V-288l-100-20.33-75 77.66ZM233-592Zm365.33 361.33Z"/></svg>
       <div class="details">
            <label class="label1">Email</label>
            <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="40px" fill="#B89230"><path d="M796-120q-119 0-240-55.5T333-333Q231-435 175.5-556T120-796q0-18.86 12.57-31.43T164-840h147.33q14 0 24.34 9.83Q346-820.33 349.33-806l26.62 130.43q2.05 14.9-.62 26.24-2.66 11.33-10.82 19.48L265.67-530q24 41.67 52.5 78.5T381-381.33q35 35.66 73.67 65.5Q493.33-286 536-262.67l94.67-96.66q9.66-10.34 23.26-14.5 13.61-4.17 26.74-2.17L806-349.33q14.67 4 24.33 15.53Q840-322.27 840-308v144q0 18.86-12.57 31.43T796-120ZM233-592l76-76.67-21-104.66H187q3 41.66 13.67 86Q211.33-643 233-592Zm365.33 361.33q40.34 18.34 85.84 29.67 45.5 11.33 89.16 13.67V-288l-100-20.33-75 77.66ZM233-592Zm365.33 361.33Z"/></svg>
            <br>
            <label class="label">krowned@gmail.com</label>
        </div>
        
    </div>


     <div class="contact-page">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#B89230"><path d="M480.06-486.67q30.27 0 51.77-21.56 21.5-21.55 21.5-51.83 0-30.27-21.56-51.77-21.55-21.5-51.83-21.5-30.27 0-51.77 21.56-21.5 21.55-21.5 51.83 0 30.27 21.56 51.77 21.55 21.5 51.83 21.5ZM480-168q129.33-118 191.33-214.17 62-96.16 62-169.83 0-114.86-73.36-188.1-73.36-73.23-179.97-73.23T300.03-740.1q-73.36 73.24-73.36 188.1 0 73.67 63 169.83Q352.67-286 480-168Zm0 88Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/></svg>
            <div class="details">
                <label class="label1">Location</label>
                <br>
                <label class="label">112 Street Isa-Pretoria</label>
            </div> 
    </div>


    </div> 



    <div class="page">

        <form action="" class="contact-page-left" method="POST">
          <?php if (!empty($errors)): ?>
            <div class="form-messages error">
              <ul>
                <?php foreach ($errors as $e): ?>
                  <li><?php   echo "<script>alert(".json_encode($e).");</script>"; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php elseif (isset($success)): ?>
            <div><?php echo "<script>alert('".addslashes($success)."');</script>"; ?> </div>
          <?php   unset($success); endif; ?>

          <div class="emails-details d">
            <input type="text" name="name" placeholder="Name" required value="<?php echo $name ?? ''; ?>">
            <input class="email2" type="email" name="email" placeholder="Email" value="<?php echo $email ?? ''; ?>">
          </div>

          <div class="emails-details length">
            <input type="text" name="subject" placeholder="Subject" value="<?php echo $subject ?? ''; ?>" required>
          </div>

          <div class="emails-details area">
            <textarea name="text" id="text" cols="0" rows="7" placeholder="Message"><?php echo $message ?? ''; ?></textarea>
          </div>

          <input class="shop-btn bt" type="submit" name="submit" value="Submit">
        </form>

    </div>

    
    </div>
<!-- 
 </div>  contract closer -->
 

    

  </section>

<?php include("footer.php")?>

  <script src="script.js"></script>

  <?php 
  if(isset($_POST['submit']))
  {
        $email = $_POST['email'];
    
       $api_key = '27e6c3c8149a43e19fb26e30117a3261'; //  AbstractAPI key

    // Step 1: Validate email with Abstract API
     $url ="https://emailreputation.abstractapi.com/v1/?api_key=55281df18a1947bda8b87ff0b1beef9c&email= ".urlencode($email);

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
   
  }

?>
</body>
</html>
