<?php
    require("connectiondb.php");

    $shopping_cart = $_COOKIE['shopping_cart'];

    if (!isset($shopping_cart)) {
        echo "Shopping cart is empty";
        exit;
    }

    $shopping_cart = unserialize($shopping_cart);

    $total_price = 0;

    foreach($shopping_cart as $product_id => $quantity) {
        $stmt = $db->query("SELECT Price FROM inventory WHERE ProductID = $product_id");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_price += $row['Price'] * $quantity;
    }

    if (isset($_COOKIE['discount_percentage'])) {
        $discount_percentage = $_COOKIE['discount_percentage'];
        $total_price = $total_price - ($total_price * ($discount_percentage / 100));
    }

    header('Content-Type: application/json');
    echo json_encode($total_price);
?>