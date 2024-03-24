<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping cart</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <!--Navbar Start-->
  <?php include('navbar.php') ?>
  <!--Navbar End-->

  <main>
    <h1 class="text-center">Checkout Page</h1>
    
    <div class="checkout-container">
      <form action="" method="post">
        <label class="checkout-label" for="cardholderName">Cardholder Name:</label>
        <div class="cfield">
          <input class="checkout-input-field" type="text" id="cardholderName" placeholder="Card holder name" required>
        </div>

        <label class="checkout-label" for="cardNumber">Card Number:</label>
        <div class="cfield">
          <input class="checkout-input-field" id="cardNumber" placeholder="1111 2222 3333 4444" required>
        </div>

        <label class="checkout-label" for="expiryDate">Expiry Date:</label>
        <div class="cfield">
          <input class="checkout-input-field" type="text" id="expiryDate" placeholder="MM/YY" required>
        </div>

        <label class="checkout-label" for="cvv">CVV:</label>
        <div class="cfield">
          <input class="checkout-input-field" type="text" id="cvv" placeholder="123" required>
        </div>

        <div style="text-align: center;">
          <input id='checkout-btn' class="checkout-input-submit" type="submit" value="Check Out" name="checkout-button" onclick="submitForm()">
          <input type="hidden" name="submitted" value="true" />
        </div>
      </form>
    </div>
  </main>



  <script>
    //on document load
    document.addEventListener('DOMContentLoaded', () => {
      function validateCardholderName() {
        const name = document.getElementById('cardholderName').value;
        if (name.length < 3) {
          alert('Invalid Cardholder Name');
          return false;
        }
        return true;
      }

      function formatCardNumber(input) {
        let value = input.value.replace(/\D/g, "");
        value = value.slice(0, 16);
        value = value.replace(/(\d{4})/g, "$1-");
        value = value.replace(/-$/, "");
        input.value = value;
      }

      document.getElementById('cardNumber').addEventListener('input', (inputElement) => {
        formatCardNumber(inputElement.target);
      });

      function validateCardNumber() {
        const number = document.getElementById('cardNumber').value;
        if (number.length !== 19) {
          alert('Invalid Card Number');
          return false;
        }
        if (!number.match(/^\d{4}-\d{4}-\d{4}-\d{4}$/)) {
          alert('Invalid Card Number');
          return false;
        }
        return true;
      }

      function validateExpiryDate() {
        const date = document.getElementById('expiryDate').value;
        if (date.length !== 5 || date.indexOf('/') !== 2) {
          alert('Invalid Expiry Date');
          return false;
        }
        return true;
      }

      document.getElementById('expiryDate').addEventListener('input', (inputElement) => {
        let value = inputElement.target.value;
        value = value.replace(/\D/g, "");
        value = value.slice(0, 4);
        value = value.replace(/(\d{2})/, "$1/");
        value = value.replace(/\/$/, "");
        inputElement.target.value = value;
      });

      function validateCVV() {
        const cvv = document.getElementById('cvv').value;
        if (cvv.length !== 3) {
          alert('Invalid CVV');
          return false;
        }
        return true;
      }

      function submitForm() {
        if (validateCardholderName() && validateCardNumber() && validateExpiryDate() && validateCVV()) {
          fetch('order.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'checkout=' + encodeURIComponent(true)
          }).then((res) => {
            console.log('Response')
            alert('Payment successful!');
          // Simulate a payment process
            setTimeout(() => {
              alert('Transaction completed. Thank you for shopping with us!');
            }, 2000);
            
          }).catch((err) => {
            console.log(err);
          })
        }
      }

      document.getElementById('checkout-btn').addEventListener('click', (e) => {
        e.preventDefault();
        submitForm();
      });
    })
  </script>
  <!-- needed for drop down menu -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>