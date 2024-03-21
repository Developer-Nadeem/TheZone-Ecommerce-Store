<?php
    require("connectiondb.php");

    $product_id = $_POST['product_id'];
    $quantity_change = $_POST['quantity_change'];

    // Update the quantity of the product in the shopping cart
    $shopping_cart = $_COOKIE['shopping_cart'];
    $shopping_cart = unserialize($shopping_cart);

    if (array_key_exists($product_id, $shopping_cart)) {
        $shopping_cart[$product_id] += $quantity_change;
        // Ensure quantity doesn't go below 0
        if ($shopping_cart[$product_id] < 0) {
            $shopping_cart[$product_id] = 0;
        }
    } else {
        $shopping_cart[$product_id] = max(0, $quantity_change); // Ensure quantity doesn't go below 0
    };

    if ($shopping_cart[$product_id] == 0) {
        unset($shopping_cart[$product_id]);
        header('Content-Type: application/json');
        echo json_encode(0);

        setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); // 86400 = 1 day
        setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/");
        return;
    };

    setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); // 86400 = 1 day
    setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/");

    header('Content-Type: application/json');
    echo json_encode($shopping_cart[$product_id]);
?>