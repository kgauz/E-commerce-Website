<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
/* .navbar {
  background:#111; color:#fff;
  padding: 15px 20px; display:flex; justify-content: space-between; align-items: center;
} */
.cart-icon { position: relative; cursor: pointer; }
.cart-icon svg { width: 35px; height:35px; fill:#fff; }
.cart-badge {
  position: absolute; top:-5px; right:-5px;
  background:red; color:#fff; border-radius:50%;
  width:20px; height:20px; font-size:12px;
  text-align:center; line-height:20px; font-weight:bold;
}

/* Slide-in Cart Panel */
.cart-panel {
  position: fixed; top: 60px; right: -380px;
  width: 350px; height: 400px; background: #fff;
  box-shadow: -3px 0 15px rgba(0,0,0,0.3);
  padding: 15px; transition: right 0.3s ease; z-index:1000;
  border-radius:8px; overflow-y:auto;
}
.cart-panel.open { right: 20px; }
.cart-panel h2 { margin-top:0; }
.cart-item { display:flex; align-items:center; margin:10px 0; border-bottom:1px solid #ccc; padding-bottom:5px; }
.cart-item img { width:50px; height:50px; border-radius:5px; object-fit:cover; }
.cart-item-details { flex:1; margin-left:10px; }
.qty-controls { display:flex; gap:5px; margin-top:5px; }
.qty-btn { padding:3px 7px; border:none; background:#111; color:#fff; cursor:pointer; border-radius:4px; }
.remove-btn { background:red; }

/* Product Listing */
.products { display:flex; flex-wrap:wrap; gap:15px; padding:15px; }
.product-card { border:1px solid #ccc; padding:10px; width:140px; text-align:center; border-radius:5px; }
.product-card img { width:100%; border-radius:5px; }
.add-cart-btn { margin-top:5px; padding:5px 10px; border:none; background:#111; color:#fff; border-radius:4px; cursor:pointer; }

.checkout-btn { width:100%; margin-top:10px; padding:8px; background:green; color:#fff; border:none; cursor:pointer; border-radius:4px; }
.close-panel { position:absolute; top:10px; right:15px; font-size:20px; cursor:pointer; font-weight:bold; }
</style>
</head>
<body>

<div class="navbar">
  <div class="cart-icon" id="cartBtn">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 4h-2l-1 2h16l-3 9h-11l-1-2h-2v2h2l3 9h10v-2h-9l-2-6h12l3-9h-18v2z"/></svg>
    <div class="cart-badge" id="cartBadge">0</div>
  </div>
</div>

<!-- Slide-in Cart Panel -->
<div class="cart-panel" id="cartPanel">
  <span class="close-panel" id="closeCart">&times;</span>
  <h2>Your Cart</h2>
  <div id="cartItems"></div>
  <div class="cart-total">Total: R<span id="total">0</span></div>
  <button class="checkout-btn" id="checkoutBtn">Checkout</button>
</div>

<!-- Product Listing -->
<div class="products">
  <div class="product-card" data-name="Frontal" data-price="350" data-img="images/image1-removebg-preview.png">
    <img src="images/image1-removebg-preview.png" alt="Frontal">
    <p>Frontal</p>
    <p>R350</p>
    <button class="add-cart-btn">Add to Cart</button>
  </div>
  <div class="product-card" data-name="Curls" data-price="700" data-img="images/photo_2025-07-04_02-24-56-removebg-preview.png">
    <img src="images/photo_2025-07-04_02-24-56-removebg-preview.png" alt="Curls">
    <p>Curls</p>
    <p>R700</p>
    <button class="add-cart-btn">Add to Cart</button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const cartBtn = document.getElementById('cartBtn');
  const cartPanel = document.getElementById('cartPanel');
  const closeCart = document.getElementById('closeCart');
  const cartItemsContainer = document.getElementById('cartItems');
  const totalDisplay = document.getElementById('total');
  const cartBadge = document.getElementById('cartBadge');

  // Load cart from localStorage if exists
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function updateCart() {
    cartItemsContainer.innerHTML = '';
    let total = 0;
    cart.forEach((item,index) => {
      total += item.qty * item.price;
      const div = document.createElement('div');
      div.classList.add('cart-item');
      div.innerHTML = `
        <img src="${item.img}" alt="${item.name}">
        <div class="cart-item-details">
          <p>${item.name}</p>
          <p>R${item.qty * item.price}</p>
          <div class="qty-controls">
            <button class="qty-btn minus" data-index="${index}">−</button>
            <span class="quantity">${item.qty}</span>
            <button class="qty-btn plus" data-index="${index}">+</button>
            <button class="qty-btn remove remove-btn" data-index="${index}">×</button>
          </div>
        </div>
      `;
      cartItemsContainer.appendChild(div);
    });
    totalDisplay.textContent = total;
    cartBadge.textContent = cart.reduce((sum,item)=>sum+item.qty,0);
    localStorage.setItem('cart', JSON.stringify(cart));
  }

  // Open/close panel
  cartBtn.addEventListener('click', ()=>cartPanel.classList.toggle('open'));
  closeCart.addEventListener('click', ()=>cartPanel.classList.remove('open'));

  // Handle clicks
  document.addEventListener('click', (e)=>{
    if(e.target.classList.contains('add-cart-btn')){
        const product = e.target.parentElement;
        const name = product.dataset.name;
        const price = parseFloat(product.dataset.price);
        const img = product.dataset.img;
        const existing = cart.find(i=>i.name===name);
        if(existing) existing.qty+=1;
        else cart.push({name, price, qty:1, img});
        updateCart();

        // OPEN CART PANEL AUTOMATICALLY
        cartPanel.classList.add('open');
    }

    if(e.target.classList.contains('plus')){
        const index = e.target.dataset.index;
        cart[index].qty+=1;
        updateCart();
    }
    if(e.target.classList.contains('minus')){
        const index = e.target.dataset.index;
        if(cart[index].qty>1) cart[index].qty-=1;
        updateCart();
    }
    if(e.target.classList.contains('remove')){
        const index = e.target.dataset.index;
        cart.splice(index,1);
        updateCart();
    }
});


  document.getElementById('checkoutBtn').addEventListener('click', ()=>{
    if(cart.length===0){ alert('Your cart is empty!'); return; }
    let summary='Checkout Summary:\n';
    cart.forEach(item => summary+=`${item.name} *${item.qty} = R${item.qty*item.price}\n`);
    summary+=`Total: R${cart.reduce((sum,item)=>sum+item.qty*item.price,0)}`;
    alert(summary);
  });

  // Initial load
  updateCart();
});
</script>

</body>
</html>
