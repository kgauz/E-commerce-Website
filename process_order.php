
<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<style>
   .msg-wrapper {
  max-width: 600px;
  width: 90%;
  margin: 8vh auto;
  padding: 24px 22px;
  border-radius: 12px;
  text-align: center;
  box-sizing: border-box;
  font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
  margin-top:40vh;
}

/* Success */
.msg-wrapper.success {
  background: #f6fffa;          /* soft green */
  border-left: 5px solid #2e7d32;
  color: #1b5e20;
}

/* Error */
.msg-wrapper.error {
  background: #fff5f5;          /* soft red */
  border-left: 5px solid #c62828;
  color: #7f1d1d;
}

.msg-wrapper h2 {
  margin: 0 0 8px;
  font-size: 22px;
  font-weight: 600;
}

.msg-wrapper p {
  margin: 4px 0 0;
  font-size: 20px;
  line-height: 1.5;
}

/* Mobile */
@media (max-width: 480px) {
  .msg-wrapper {
    padding: 18px;
  }

  .msg-wrapper h2 {
    font-size: 19px;
  }
}

</style>
<?php

include("confi.php"); // DB connection

// // Get credentials (better from env vars, not hardcoded)
// $clientId = "Adu197XJphORzM1Yll7UVjDLt5ERsEgCuHxOvT1g1Xk63dYp16z05DG9bAkBXyyGXBOKQrnV2h_9C2Zl";
// $clientSecret = "EE2YiVmIYJssfTPupezMXVd9JwISEaJzXYjWkqYvKWFfS6gpg_n6dZbGs9kL7bdUaNQPMhWEjhWPtzn0";
// $paypalApi = "https://api-m.paypal.com"; // live endpoint

$clientId = "AVeH1_2CawyQJhwcJ40ZghjCKnv-idjNvqw7MGt4kYqxuO70-oRY6-dpU2HVfAVNyG1vsB-jNnTrz189";
$clientSecret = "ELqfxxdaWHJB-dEsFqyHNk2UW5q7fM7xb4WL1zBBMA2ikr7PIW87WHyXXoG7E9U_kEwUUiH3_OSAreBi";
$paypalApi = "https://api-m.sandbox.paypal.com"; 

//  curl -v -u "Adu197XJphORzM1Yll7UVjDLt5ERsEgCuHxOvT1g1Xk63dYp16z05DG9bAkBXyyGXBOKQrnV2h_9C2Zl:EE2YiVmIYJssfTPupezMXVd9JwISEaJzXYjWkqYvKWFfS6gpg_n6dZbGs9kL7bdUaNQPMhWEjhWPtzn0" \
//    https://api-m.paypal.com/v1/oauth2/token \
//    -d "grant_type=client_credentials"
// curl -v -u "AYYRbJXxNp_6yDJ36tzciihnW9bvPEoaBfRJj1B70u1wucs8RDnYsl2EBVwErm:ECA6lGZgf4H_2PAmtUgpwRltV5c_Ok1oAqij0B-3MU_l_-AmEtM2bwgf2ts8LE-Thl0323Z_4VHG-f3JzErm:ECA6lGZgf4H_2PAmtUgpwRltV5c_Ok1oAqij0B-3MU_l_-AmEtM2bwgf2ts8LE-Thl0323Z_4VHG-f3J" \
// https://api-m.sandbox.paypal.com/v1/oauth2/token \
// -d "grant_type=client_credentials"



// Collect POST data
$orderID    = htmlspecialchars(trim($_POST['orderID'] ?? ''));
$cart       = json_decode($_POST['cartData'] ?? '[]', true);
$firstName  = htmlspecialchars(trim($_POST['first_name'] ?? ''));
$lastName   = htmlspecialchars(trim($_POST['last_name'] ?? ''));
$email      = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone      = htmlspecialchars(trim($_POST['phone'] ?? ''));
$address    = htmlspecialchars(trim($_POST['address'] ?? ''));
$customerName = $firstName . ' ' . $lastName;

if (!$orderID || !$firstName || !$lastName || !$email || !$phone || !$address) {
    die('
<div class="msg-wrapper error">
  <h2>Error</h2>
  <p>Missing required details.</p>
</div>
');

}

// --- STEP 1: Get PayPal access token ---
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$paypalApi/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/json","Accept-Language: en_US"]);
curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

if (curl_errno($ch)) { die("cURL error: " . curl_error($ch)); }
$json = json_decode($result, true);
$accessToken = $json['access_token'] ?? '';
curl_close($ch);

if (!$accessToken) { die('
<div class="msg-wrapper error">
  <h2>Payment Error</h2>
  <p>Could not connect to PayPal. Please try again.</p>
</div>
');
 }

// --- STEP 2: Capture the order ---
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$paypalApi/v2/checkout/orders/$orderID/capture");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

if (curl_errno($ch)) { die("cURL error: " . curl_error($ch)); }
$orderData = json_decode($result, true);
curl_close($ch);

// --- STEP 3: Verify payment status ---
$status = $orderData['status'] ?? '';
if ($status !== 'COMPLETED') {
    die('
<div class="msg-wrapper error">
  <h2>Payment Error</h2>
  <p>Something went wrong. Please try again.</p>
</div>
');

}
else
{
    if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

}


// --- STEP 4: Save order to DB ---
$paymentStatus = 'Paid';
$stmt = $conn->prepare("
    INSERT INTO table_order
    (hairType, price, quantity, total, status, customer_name, customer_contact, customer_email, customer_address)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

foreach ($cart as $item) {
    $totalItem = $item['price'] * $item['qty'];

    // bind_param: s = string, d = double, i = integer
    $stmt->bind_param(
        "sdidsssss",
        $item['name'],   // s
        $item['price'],  // d
        $item['qty'],    // i
        $totalItem,      // d
        $paymentStatus,  // s
        $customerName,   // s
        $phone,          // s
        $email,          // s
        $address         // s
    );

    $stmt->execute();
}

$stmt->close();
$conn->close();
echo '
<div class="msg-wrapper success">
  <h2>Payment Successful</h2>
  <p>Thank you <strong>' . htmlspecialchars($customerName) . '</strong>.</p>
  <p>Your payment was captured and your order has been placed.</p>
</div>
';

?>
