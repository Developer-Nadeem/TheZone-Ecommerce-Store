<?php
session_start();

if (!isset($_COOKIE['shopping_cart'])) {
  setcookie('shopping_cart', serialize(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
  setcookie('shopping_cart_json', json_encode(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
}

if (isset($_POST['add-to-cart'])) {
  $productId = $_POST['product-id'];

  $shoppingCart = isset($_COOKIE['shopping_cart']) ? unserialize($_COOKIE['shopping_cart']) : array();

  array_push($shoppingCart, $productId);

  setcookie('shopping_cart', serialize($shoppingCart), time() + (86400), "/"); //Shopping cart cookie expires in a day

  setcookie('shopping_cart_json', json_encode($shoppingCart), time() + (86400), "/"); //Shopping cart cookie expires in a day
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body>
    <!--Navbar Start-->
    <?php include('navbar.php') ?>
    <!--Navbar End-->


    <main>
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">

                    <h1>Your Account</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light text-dark" onclick="redirectToPage('Your Orders')">
                                <div class="card-body" style="height: 150px;">
                                    <h5 class="card-title">Your Orders</h5>
                                    <ul class="list-unstyled">
                                        <li>Track, return, cancel an order</li>
                                        <li>Send invoice to email</li>
                                        <li>Buy again</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light text-dark" onclick="redirectToPage('Login and Security')">
                                <div class="card-body" style="height: 150px;">
                                    <h5 class="card-title">Login and Security</h5>
                                    <ul class="list-unstyled">
                                        <li>Manage password</li>
                                        <li>Email</li>
                                        <li>Mobile number</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light text-dark" onclick="redirectToPage('Your Address')">
                                <div class="card-body" style="height: 150px;">
                                    <h5 class="card-title">Your Address</h5>
                                    <ul class="list-unstyled">
                                        <li>Edit</li>
                                        <li>Set default</li>
                                        <li>Remove</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light text-dark" onclick="redirectToPage('Your Payment Details')">
                                <div class="card-body" style="height: 150px;">
                                    <h5 class="card-title">Your Payment Details</h5>
                                    <ul class="list-unstyled">
                                        <li>Edit</li>
                                        <li>Set default</li>
                                        <li>Remove</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
    </main>
    <script>
    var pageUrls = {
        "Your Orders": "user-order.php",
        "Login and Security": "user-login-details.php",
        "Your Address": "user-address-details.php",
        "Your Payment Details": "user-payment-details.php"

    };


    function redirectToPage(title) {

        var url = pageUrls[title];
        if (url) {

            window.location.href = url;
        } else {
            console.error("URL not found for title:", title);
        }
    }
    </script>

    <!-- Footer Start -->
    <?php include('footer.php') ?>
    <!-- Footer End -->

</body>

</html>