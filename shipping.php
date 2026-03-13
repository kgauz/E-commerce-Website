<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Policies</title>
  <style>
  
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      margin-bottom:20px;

    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .accordion {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      overflow: hidden;
      margin-bottom: 10px;
    }

    .accordion-header {
      padding: 15px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
      border-bottom: 1px solid #eee;
      transition: background 0.3s ease;
    }

    .accordion-header:hover {
      background: #f1f1f1;
    }

    .accordion-header span {
      transition: transform 0.3s ease;
    }

    .accordion-header.active span {
      transform: rotate(90deg);
    }

    .accordion-body {
      padding: 15px;
      display: none;
      background: #fafafa;
      color: #333;
      line-height: 1.6;
    }

    .accordion-body ul {
      padding-left: 20px;
    }
    .contact-info{
        display:block;
        text-align: center;
    }
   
  </style>
</head>
<body>
  <h2>Shipping / Returns / Refund / Cancellation Policy</h2>

  <!-- Section 1 -->
   
  <div class="accordion">
    <div class="accordion-header">1. General <span>▶</span></div>
    <div class="accordion-body">
      <p>All orders are subject to stock availability.</p>
      <p>We maintain accurate stock counts, but occasionally discrepancies may occur.</p>
      <p>If a product is out of stock, we will fulfill the available items and contact you to decide whether you’d like to wait for restock or receive a refund.</p>
    </div>
  </div>

  <!-- Section 2 -->
  <div class="accordion">
    <div class="accordion-header">2. Shipping <span>▶</span></div>
    <div class="accordion-body">
      <p><strong>Shipping Costs</strong></p>
      <ul>
        <li>Overnight Delivery (non-risky areas): R155 (next-day delivery).</li>
        <li>Overnight Delivery (risky areas): R200 (next-day delivery with extra security).</li>
        <li>Standard Delivery: R150 (2–3 days).</li>
      </ul>
      <p><strong>Dispatch Time</strong>: Orders are usually dispatched within 3–5 business days after payment. We operate Monday – Friday during business hours (excluding national holidays).</p>
      <p><strong>Special Addresses</strong>:</p>
      <ul>
        <li>P.O. Box: Only via postal services.</li>
        <li>Military Addresses: Only via USPS (no courier service available).</li>
      </ul>
      <p>If delivery exceeds the estimated time, please contact us for investigation.</p>
    </div>
  </div>

  <!-- Section 3 -->
  <div class="accordion">
    <div class="accordion-header">3. Parcels Damaged or Lost in Transit <span>▶</span></div>
    <div class="accordion-body">
      <p>If damaged upon delivery, refuse the parcel and notify our customer service.</p>
      <p>If already delivered while you were absent, contact customer service immediately.</p>
      <p>Refunds or replacements will be processed once the courier completes their investigation.</p>
    </div>
  </div>

  <!-- Section 4 -->
  <div class="accordion">
    <div class="accordion-header">4. Duties & Taxes <span>▶</span></div>
    <div class="accordion-body">
      <p>Sales tax is already included in displayed prices.</p>
      <p>Import duties and taxes for international shipments are prepaid, so customers won’t face extra charges upon delivery.</p>
    </div>
  </div>

  <!-- Section 5 -->
  <div class="accordion">
    <div class="accordion-header">5. Returns <span>▶</span></div>
    <div class="accordion-body">
      <p>Returns are accepted if goods are damaged or faulty due to processing.</p>
      <p>Requests must be made within 5 days of receipt.</p>
      <p>Items must be unused, in original packaging, and in resalable condition.</p>
      <p>Return shipping costs are the responsibility of the customer.</p>
    </div>
  </div>

  <!-- Section 6 -->
  <div class="accordion">
    <div class="accordion-header">6. Refunds <span>▶</span></div>
    <div class="accordion-body">
      <p>Once a return is accepted, refunds will be issued as store credit for future purchases.</p>
      <p>Refunds do not cover original shipping charges.</p>
    </div>
  </div>

  <!-- Section 7 -->
  <div class="accordion">
    <div class="accordion-header">7. Cancellation <span>▶</span></div>
    <div class="accordion-body">
      <p>Orders may be cancelled anytime before processing begins.</p>
      <p>Once processing has started or the order has been dispatched, cancellation is no longer possible.</p>
      <p>For dispatched orders, please follow the refund/return policy.</p>
    </div>
  </div>

<section class="contact-info">
  <h2>Contact Us</h2>
  <p>Email: <a href="mailto:krown@gmail.com">krown@gmail.com</a></p>
  <p>Contact: <a href="tel:+2787767656">+27 656556756</a></p>
</section>

  

  <script>
    // Accordion logic
    document.querySelectorAll(".accordion-header").forEach(header => {
      header.addEventListener("click", () => {
        header.classList.toggle("active");
        const body = header.nextElementSibling;
        if (body.style.display === "block") {
          body.style.display = "none";
        } else {
          body.style.display = "block";
        }
      });
    });
  </script>
</body>
</html>
