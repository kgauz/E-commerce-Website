<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

// Load cart from session (optional fallback)
$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach($cart as $item) $total += $item['price']*$item['qty'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Checkout</title>

<script src="script.js"></script>
<style>
    * {
  box-sizing: border-box; /* ensures padding doesn't add overflow */
}

html, body {
  margin: 0;
  padding: 0;
  overflow-x: hidden; /* prevent horizontal scroll */
}

body{font-family:Arial,sans-serif;background:#f9f9f9;margin:0;padding:0;}
.container{
    display:block;
    max-width:900px;
    top:0;
    padding:20px;
    background:#fff;
    border-radius:6px;
    box-shadow:0 0 15px rgba(0,0,0,0.1); 
    width:100%;
    position:cover;
    overflow:hidden;
}
.checkout-form{margin-right:20px;}
.checkout-form h2{
    margin-bottom:15px;
}
.checkout-form label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}
.checkout-form input{
    width:100%;
    max-width:700px;
    padding:10px;
    margin-bottom:15px;
    border-radius:4px;
    border:1px solid #ccc;
}
.cart-summary{
    background:#f1f1f1;
    padding:15px;
    border-radius:6px;
}
.cart-summary h2{
    margin-top:0;
}
.cart-summary table{
    width:100%;
    left:0;
}
.cart-summary th, .cart-summary td{
    padding:8px;
    text-align:left;
    border-bottom:1px solid #ddd;
}
.cart-summary strong{
    display:block;
    margin-top:10px;
    font-size:18px;
}
.radio input{
  display: flex;
  margin-left: 80px;
  margin-top:-20px;
}
.cartStuff{
    display:none;
}

/*Query for Tablet
Viewport */
 @media screen and (min-width: 630px), print{
   
.container{
    display:flex;
    max-width:5000px;
    top: 0; 
    gap:30px;
}
.checkout-form{
    flex:2;
    margin-right:20px; 
    padding:15px;
}
.checkout-form h2{margin-bottom:15px; margin-top:0;}
.checkout-form label{display:block;margin-bottom:5px;font-weight:bold;}
.checkout-form input{width:100%;padding:10px;margin-bottom:15px;border-radius:4px;border:1px solid #ccc;}
.cart-summary{flex:1;background:#f1f1f1;padding:15px;border-radius:6px;}
.cart-summary h2{margin-top:0;}
.cart-summary table{border-collapse:collapse;}
.cart-summary th, .cart-summary td{}
.cart-summary strong{font-size:20px;}
/* 
.radio input{
  display: flex;
  margin-left: -80px;
  margin-top:-20px;
} */
} 



/* 
/* Media
Query for Desktop
Viewport */
@media screen and (min-width: 1015px), print { 
     
.container{
    display:flex;
        max-width:10000px;
}
} 

</style>
</head>
<body>

 <!-- <script src="https://www.paypal.com/sdk/js?client-id=Adu197XJphORzM1Yll7UVjDLt5ERsEgCuHxOvT1g1Xk63dYp16z05DG9bAkBXyyGXBOKQrnV2h_9C2Zl&currency=ZAR"></script> -->

 <script src="https://www.paypal.com/sdk/js?client-id=AVeH1_2CawyQJhwcJ40ZghjCKnv-idjNvqw7MGt4kYqxuO70-oRY6-dpU2HVfAVNyG1vsB-jNnTrz189&currency=USD"></script>
<div class="container">

      <div class="cart-summary">
        <h2>Cart Summary</h2>
        <div id="cartContainer">
            <p>Loading cart...</p>
        </div>
    </div>
    <!-- Delivery Form -->
    <div class="checkout-form">
        <h2>Delivery Details</h2>
        <form id="deliveryForm">
            <label>First Name</label>
            <input type="text" name="first_name" required>
            <label>Last Name</label>
            <input type="text" name="last_name" required>
            <label>Address</label>
            <input type="text" name="address" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Phone</label>
            <input type="tel" name="phone" required>
            <label>Shipping(choose from three type of shipping)</label>
            <br>
            <div class="radiobutton">

            <div class="radio">
            <label>Overnight(Non-risky areas)</label>
            <input type="radio" name="delivery" value="155" required>
            </div>

            <div class="radio">
            <label>overnight(Risky areas)</label>
            <input type="radio" name="delivery" value="200" required>
            </div>
            
            <div class="radio">
            <label>Standard</label>
            <input type="radio" name="delivery" value="150" required>
            </div> 

            </div>
            <p id="selectedPrice"><strong>You selected: </strong> None</p>

            <div id="paypal-button-container" style="min-height:50px;"></div>
            
        </form>

    </div>

    <!-- Cart Summary -->
    <div class="cart-summary cartStuff">
        <h2>Cart Summary</h2>
        <div id="cartContainer">
            <p>Loading cart...</p>
        </div>
    </div>

</div>

<!-- PayPal SDK MUST be loaded first -->
<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let subtotal = cart.reduce((sum,item)=>sum+item.price*item.qty,0);
let shipping = 0; // track selected shipping cost
let total = subtotal;

function renderCart(){
    const container = document.getElementById('cartContainer');
    if(cart.length === 0){
        container.innerHTML = '<p>Your cart is empty.</p>';
        return;
    }
    let html = `<table>
        <tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>`;
    cart.forEach(item=>{
        html += `<tr>
            <td>${item.name}</td>
            <td>${item.qty}</td>
            <td>R${item.price.toFixed(2)}</td>
            <td>R${(item.price*item.qty).toFixed(2)}</td>
        </tr>`;
    });
    html += `</table>
        <strong>Subtotal: R${subtotal.toFixed(2)}</strong><br>
        <strong>Shipping: R${shipping.toFixed(2)}</strong><br>
        <strong>Total: R${total.toFixed(2)}</strong>`;
    container.innerHTML = html;
}

renderCart();

// --- Shipping radio buttons ---
const radios = document.querySelectorAll('input[name="delivery"]');
const display = document.getElementById('selectedPrice');

radios.forEach(radio => {
    radio.addEventListener('change', function () {
        let label = this.parentNode.textContent.trim();
        shipping = parseFloat(this.value);
        total = subtotal + shipping;
        display.innerHTML = `<strong>You selected: </strong> ${label} – R${this.value}`;
        renderCart();
    });
});

// --- PayPal Buttons ---
paypal.Buttons({
    createOrder: function(data, actions) {
        if(cart.length === 0) { alert('Your cart is empty!'); return; }
        if(shipping === 0) { alert('Please select a shipping option.'); return; }
        return actions.order.create({
            purchase_units: [{
                amount: { value: total.toFixed(2) },
                description: "Hair Shop Order"
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'process_order.php';
            const f = document.getElementById('deliveryForm');

            form.innerHTML = `
                <input type="hidden" name="orderID" value="${data.orderID}">
                <input type="hidden" name="first_name" value="${f.first_name.value}">
                <input type="hidden" name="last_name" value="${f.last_name.value}">
                <input type="hidden" name="address" value="${f.address.value}">
                <input type="hidden" name="email" value="${f.email.value}">
                <input type="hidden" name="phone" value="${f.phone.value}">
                <input type="hidden" name="paypal_status" value="completed">
                <input type="hidden" name="delivery" value="${shipping}">
                <input type="hidden" name="cartData" value='${JSON.stringify(cart)}'>
            `;
            document.body.appendChild(form);
            form.submit();
        });
    },
    onCancel: function(data) { alert('Payment cancelled.'); },
    onError: function(err) { alert('Payment error: ' + err); }
}).render('#paypal-button-container');

const form = document.getElementById('deliveryForm');
let paypalActions = null;

// Check form validity
function checkForm() {
    if (!form) return;
    if (form.checkValidity() && document.querySelector('input[name="delivery"]:checked')) {
        paypalActions && paypalActions.enable();
    } else {
        paypalActions && paypalActions.disable();
    }
}

// Watch all inputs
form.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', checkForm);
    input.addEventListener('change', checkForm);
});
</script>


<script src="script.js"></script>
 
</body>
</html>
