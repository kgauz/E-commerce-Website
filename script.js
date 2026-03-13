//login profile code

document.addEventListener("DOMContentLoaded", () => {
 const iconProfile = document.querySelector("#inside svg");
const linkP = document.getElementById("outside");

if (iconProfile && linkP) {
  iconProfile.addEventListener("click", (e) => {
    // Toggle display
    if (linkP.style.display === "block") {
      linkP.style.display = "none";
    } else {
      linkP.style.display = "block";
    }
    e.stopPropagation(); // prevent document click from immediately closing
    console.log("Toggle triggered!");
  });

  // Click anywhere else closes the dropdown
  document.addEventListener("click", () => {
    linkP.style.display = "none";
  });

  // Optional: clicking inside dropdown itself does not close it
  linkP.addEventListener("click", (e) => {
    e.stopPropagation();
  });

} else {
  console.error("Elements not found:", { iconProfile, linkP });
}

  
});






document.addEventListener("DOMContentLoaded", () => {

// mobile code
  const mobileIcon = document.getElementById("mobileIcon");
  const searchBox  = document.getElementById("searchBox");
  const closeBtn   = document.getElementById("closeButton");

  if (mobileIcon && searchBox) {
    mobileIcon.addEventListener("click", () => {
      searchBox.classList.toggle("show");
    });
  }

  if (closeBtn && searchBox) {
    closeBtn.addEventListener("click", () => {
      searchBox.classList.remove("show");
    });
  }


const nav = document.getElementById("menuPanel");
const burgerButton = document.querySelector("#burger");
const menuPage = document.getElementById("closePage");
burgerButton.addEventListener("click", () =>{
  nav.classList.toggle("displaying");
  menuPage.style.display ="block";
   burgerButton.style.display ="none";



});
menuPage.addEventListener("click", () =>{
  nav.classList.remove("displaying");
  burgerButton.style.display ="block";
   menuPage.style.display ="none";
});


  const addToCartButtons = document.querySelectorAll(".add-cart-btn");
  addToCartButtons.forEach(button => {
    button.addEventListener("click", () => {
      cartPanel.classList.add("open");
    });
  });


});


document.addEventListener("DOMContentLoaded", () => {
  

  // Cart Elements
  const cartBtn = document.getElementById("cartBtn");
  const cartPanel = document.getElementById("cartPanel");
  const closeCart = document.getElementById("closeCart");
  const cartItemsContainer = document.getElementById("cartItems");
  const totalDisplay = document.getElementById("total");
  const cartBadge = document.getElementById("cartBadge");

  // Checkout form
  const checkoutForm = document.getElementById("cartCheckoutForm");
  const cartDataInput = document.getElementById("cartData");

  // Load cart from localStorage
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // -----------------------
  // Utility Functions
  // -----------------------
  function getCartTotal() {
    return cart.reduce((sum, item) => sum + item.qty * item.price, 0);
  }

  function renderCart() {
    cartItemsContainer.innerHTML = "";
    let total = 0;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = "<p>Your cart is empty.</p>";
    } else {
      cart.forEach((item, index) => {
        total += item.qty * item.price;
        const div = document.createElement("div");
        div.classList.add("cart-item");
        div.innerHTML = `
          <img src="${item.img}" alt="${item.name}">
          <div class="cart-item-details">
            <p>${item.name}</p>
            <p>R${(item.qty * item.price).toFixed(2)}</p>
            <div class="qty-controls">
              <button class="qty-btn minus" data-index="${index}">−</button>
              <span class="quantity">${item.qty}</span>
              <button class="qty-btn plus" data-index="${index}">+</button>
              <button class="qty-btn remove" data-index="${index}">Remove</button>
            </div>
          </div>
        `;
        cartItemsContainer.appendChild(div);
      });
    }

    totalDisplay.textContent = total.toFixed(2);
    cartBadge.textContent = cart.reduce((sum, item) => sum + item.qty, 0);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderPaypalButton();
  }

  // -----------------------
  // Cart Panel Controls
  // -----------------------
  cartBtn.addEventListener("click", () => cartPanel.classList.toggle("open"));
  closeCart.addEventListener("click", () => cartPanel.classList.remove("open"));

  // -----------------------
  // Add / Update / Remove Items
  // -----------------------
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("add-cart-btn")) {
      const product = e.target.closest(".product-card");
      const name = product.dataset.name;
      const price = parseFloat(product.dataset.price);
      const img = product.dataset.img;

      const existing = cart.find((i) => i.name === name);
      if (existing) existing.qty += 1;
      else cart.push({ name, price, qty: 1, img });

      updateCartAndOpen();
    }

    if (e.target.classList.contains("plus")) {
      const index = e.target.dataset.index;
      cart[index].qty += 1;
      renderCart();
    }

    if (e.target.classList.contains("minus")) {
      const index = e.target.dataset.index;
      if (cart[index].qty > 1) cart[index].qty -= 1;
      renderCart();
    }

    if (e.target.classList.contains("remove")) {
      const index = e.target.dataset.index;
      cart.splice(index, 1);
      renderCart();
    }
  });

  function updateCartAndOpen() {
    renderCart();
    cartPanel.classList.add("open");
  }

  // -----------------------
  // PayPal Integration
  // -----------------------
  function renderPaypalButton() {
  const container = document.getElementById("paypal-button-container");
  container.innerHTML = ""; // Clear existing buttons

  if (cart.length === 0) return;
   renderCart();
  paypal.Buttons({
    createOrder: (data, actions) => {
      return actions.order.create({
        purchase_units: [{
          amount: { value: getCartTotal().toFixed(2) },
          description: "Hair Shop Order",
        }],
      });
    },

    onApprove: (data, actions) => {
      console.log("onApprove called:", data);
      console.log("Order ID:", data.orderID); // This is correct

      // Capture the payment
      return actions.order.capture().then(details => {
        console.log("Payment captured:", details);

        // Collect delivery details
        const firstName = document.querySelector('input[name="first_name"]').value.trim();
        const lastName  = document.querySelector('input[name="last_name"]').value.trim();
        const email     = document.querySelector('input[name="email"]').value.trim();
        const phone     = document.querySelector('input[name="phone"]').value.trim();
        const address   = document.querySelector('input[name="address"]').value.trim();

        // Submit everything to PHP
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "process_order.php";
        form.innerHTML = `
          <input type="hidden" name="orderID" value="${data.orderID}">
          <input type="hidden" name="cartData" value='${JSON.stringify(cart)}'>
          <input type="hidden" name="first_name" value="${firstName}">
          <input type="hidden" name="last_name" value="${lastName}">
          <input type="hidden" name="email" value="${email}">
          <input type="hidden" name="phone" value="${phone}">
          <input type="hidden" name="address" value="${address}">
          <input type="hidden" name="paypal_status" value="completed">
        `;
        document.body.appendChild(form);
        form.submit();
      });
    },

    onCancel: () => alert("Payment cancelled."),
    onError: (err) => alert("Payment error: " + err),
  }).render("#paypal-button-container");




}

  // -----------------------
  // Checkout Button
  // -----------------------
  const checkoutBtn = document.getElementById("checkoutBtn");
  if (checkoutBtn) {
    checkoutBtn.addEventListener("click", () => {
      if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
      }
     // cartDataInput.value = JSON.stringify(cart);
      localStorage.setItem("cart", JSON.stringify(cart));
      
      //checkoutForm.submit();
      window.location.href = "checkout.php";
    });
  }

  // -----------------------
  // Initial Render
  // -----------------------
  renderCart();
});

// backend-code

function updateStatusColor() {
    const select = document.getElementById("orderStatus");
    select.className = "status-dropdown"; // reset
    switch (select.value) {
        case "Paid":
            select.classList.add("status-paid");
            break;
        case "onDelivery":
            select.classList.add("status-onDelivery");
            break;
        case "Delivered":
            select.classList.add("status-delivered");
            break;
        case "Canceled":
            select.classList.add("status-canceled");
            break;
    }
}

// Run on page load
updateStatusColor();

// Update when user changes value
document.getElementById("orderStatus").addEventListener("change", updateStatusColor);

