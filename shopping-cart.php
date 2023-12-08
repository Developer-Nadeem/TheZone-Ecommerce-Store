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
    <?php include('..\TheZone\\navbar.php') ?>
    <!--Navbar End-->

    <main>
        <div class="shoppingcart-container">
            <h2 class="text-center">Your Cart</h2>
            <ul id="cart-items">
                <!-- Cart items will be dynamically added here@khizzer -->
            </ul>
            <p class="text-center">Total: £<span id="cart-total">0.00</span></p>
            <!-- change the above to display total price of products -->
            <div style="text-align: center;">
                <button class="shoppingcart-button" type="submit" name="checkout-button" onclick="checkout()">Check Out</button>
            </div>

        </div>

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
        //  make changes where needed@khizzer
    </script>
</body>

</html>