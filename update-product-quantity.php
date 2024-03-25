<?php
    require("connectiondb.php");

    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $quantity_change = $_POST['quantity_change'];

    $shopping_cart = $_COOKIE['shopping_cart'];
    $shopping_cart = unserialize($shopping_cart);

    $productKey = $product_id . '|' . $size;

    if (array_key_exists($productKey, $shopping_cart)) {
        $shopping_cart[$productKey]['quantity'] += $quantity_change;
        // Ensure quantity doesn't go below 0
        if ($shopping_cart[$productKey]['quantity'] < 0) {
            $shopping_cart[$productKey]['quantity'] = 0;
        }
    } else {
        $shopping_cart[$productKey]['quantity'] = max(0, $quantity_change);
    };

    if ($shopping_cart[$productKey]['quantity'] == 0) {
        unset($shopping_cart[$productKey]);
        header('Content-Type: application/json');
        echo json_encode(0);

        setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); // 86400 = 1 day
        setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/");
        return;
    };

    setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); // 86400 = 1 day
    setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/");

    header('Content-Type: application/json');
    echo json_encode($shopping_cart[$productKey]['quantity']);
?>