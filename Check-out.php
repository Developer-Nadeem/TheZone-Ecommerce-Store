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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="checkout-page.css">
</head>

<body>
  <!--Navbar Start-->
  <?php include('..\TheZone\\navbar.php')?>
  

  <!--Navbar End-->

  <header>
    <h1>Checkout Page</h1>
  </header>
 
 <main>
</main>
 
<section>
    <label for="cardholderName">Cardholder Name:</label>
    <input type="text" id="cardholderName" placeholder="Hamza Abdullah" required>

    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" placeholder="1111 2222 3333 4444-" required>

    <label for="expiryDate">Expiry Date:</label>
    <input type="text" id="expiryDate" placeholder="MM/YY" required>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" placeholder="123" required>

    <button onclick="submitForm()">Submit</button>
  </section>

  <script src="script.js">
function validateCardholderName() {
 const name = document.getElementById('cardholderName').value;
 if (name.length < 3) {
    alert('Invalid Cardholder Name');
    return false;
 }
 return true;
}

function validateCardNumber() {
 const number = document.getElementById('cardNumber').value;
 if (number.length !== 19 || !number.includes('-')) {
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
    alert('Payment successful!');
    // Simulate a payment process
    setTimeout(() => {
      alert('Transaction completed. Thank you for shopping with us!');
      // Clear the shopping cart and update the view
    }, 2000);
 }
}

  </script>
</body>

  </main>
  
</html>