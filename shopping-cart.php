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
      <main>
    <p>hello</p>
    <section id="cart">

        <h2>Your Cart</h2>
        <ul id="cart-items"></ul>
        <p>Total: $<span id="total">0.00</span></p>
        <button onclick="checkout()">Checkout</button>
    </section>

    <section id="products">
        <h2>Products</h2>
        <ul id="product-list">
            <!-- Product items will be dynamically added here -->
        </ul>
    </section>
  </main>
  </body>
