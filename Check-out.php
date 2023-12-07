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
    <label for="name">Name:</label>
    <input type="text" id="name" placeholder="John Doe" required>

    <label for="email">Email:</label>
    <input type="email" id="email" placeholder="john@example.com" required>

    <label for="address">Address:</label>
    <input type="text" id="address" placeholder="123 Main St" required>

    <label for="card">Credit Card:</label>
    <input type="text" id="card" placeholder="**** **** **** 1234" required>

    <label for="expiry">Expiry Date:</label>
    <input type="text" id="expiry" placeholder="MM/YY" required>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" placeholder="123" required>

    <button onclick="submitForm()">Submit</button>
  </section>
  </main>
  <script src="script.js"></script>
  
 

</body>

