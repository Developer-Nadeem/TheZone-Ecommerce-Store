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

    <style>
        .sample-product {
            border: 2px solid #000; 
            border-radius: 10px;
            padding: 10px; 
            margin-top: 10px; 
            text-align: left; 
            width: 100%;
            margin-left: auto;
            margin-right: auto; /* margin left and right set to auto to centre align the product container */
            overflow: hidden;
            position: relative;
        }

        .sample-product h3 {
            margin: 15px; 
            font-size: 20px;
        }

        .sample-product img {
            width: 120px; /* setting a fixed width for the image for consistency */
            height: auto; 
            border: 3px solid #000; 
            border-radius: 10px;
            margin: 15px;

        }

        .sample-product button {
            background-color: #ff0000; 
            border-radius: 5px;
            color: #fff; 
            border: none; 
            margin: 15px;
            padding: 5px 10px; 
            cursor: pointer; 
            transition: background-color 0.2s ease, color 0.2s ease; /* transition of colour upon hover */
            position: absolute; /* positioning the button absolutely so that it can be on the bottom right*/
            bottom: 0; 
            right: 0; 
        }

        .sample-product button:hover {
            background-color: #fff; /* changing background color on hover */
            color: #ff0000;
            border: 2px solid #ff0000;
            padding: 5px 10px; 
        }
    </style>


</head>

<body>
    <!--Navbar Start-->
    <?php include('..\TheZone\\navbar.php') ?>
    <!--Navbar End-->

    <main>
        <div class="shoppingcart-container">
            <h2 class="text-center">Your Cart</h2>
            <ul id="cart-items" style="padding-left: 10px; padding-right: 10px">
                <!-- Cart items will be dynamically added here@khizzer -->
                <?php
                    $shopping_cart = isset($_COOKIE['shopping_cart']) ? $_COOKIE['shopping_cart'] : array();
                    foreach(unserialize($shopping_cart) as $item) {
                        echo '<div class="sample-product">';
                        echo'<h3>'. $item .'</h3>';
                        echo '<h3>£10.99</h3>';
                        echo '<img src="..\TheZone\images\\' . $item. '.webp" alt="Sample Product Image">';
                        echo '<button onclick="removeProduct()">Remove</button>';
                        echo '</div>';
                    }
                ?>
            </ul>
            <p class="text-center">Total: £<span id="cart-total">0.00</span></p>
            <!-- change the above to display total price of products -->
            <div style="text-align: center;">
                <button class="shoppingcart-button" type="submit" name="checkout-button" onclick="checkout()">Check Out</button>
            </div>

        </div>

        <!-- div section for a product with its name, price and product image -->

    </main>


    <script>
        function checkout() {
            // Redirect to check out page
            window.location.href = 'check-out.php';
        }

        // Render the cart
        function renderCart() {
            // ...

            // Render the cart items
            for (let item of cart.items) {
                // ...

                // Add a remove button
                li.innerHTML += `
            <button class="remove-btn" data-itemid="${item.id}">Remove</button>
        `;
            }

            // ...
        }
        // Event listeners
        document.getElementById('cart').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-btn')) {
                // Remove the item from the cart
                const itemId = event.target.dataset.itemid;
                cart.removeItem(itemId);

                // Re-render the cart
                renderCart();
            }
        });

        // Cart constructor
        function Cart() {
            // ...

            // Add a method to remove an item from the cart
            this.removeItem = function(itemId) {
                this.items = this.items.filter(function(item) {
                    return item.id !== itemId;
                });

                // Save the updated cart to local storage
                this.saveToLocalStorage();
            };

            // ...
        }

        function removeProduct() {
            // function to remove product from cart page

        }
        //  make changes where needed@khizzer
    </script>
    <!-- needed for drop down menu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>