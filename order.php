<?php
    session_start();
    
    require("connectiondb.php");
    
    //if (isset($_POST['checkout'])) {
        $shopping_cart = $_COOKIE['shopping_cart'];

        if (!isset($shopping_cart)) {
            echo "Shopping cart is empty";
            exit;
        }

        $shopping_cart = unserialize($shopping_cart);

        $total_price = 0;

        echo $_SESSION['email'];

        $stmt = $db->query("SELECT UserID FROM useraccounts WHERE Email = '" . $_SESSION['email'] . "'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['UserID'];


        foreach($shopping_cart as $item => $itemArray) {
            list($product_id, $size) = explode('|', $item);
            $quantity = $itemArray['quantity'];

            $stmt = $db->query("SELECT Price FROM inventory WHERE ProductID = $product_id");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $total_price += $row['Price'];
        }

        if (isset($_COOKIE['discount_code'])) {
            $stmt = $db->prepare("SELECT * FROM discount_codes WHERE LOWER(discount_code) = LOWER(:discountCode)");
            $stmt->bindValue(':discountCode', $_COOKIE['discount_code']);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $discount_percentage = $row['discount_percentage'];

            $total_price = $total_price - ($total_price * ($discount_percentage / 100));
        }

        $date_time = date("Y-m-d H:i:s");

        $stmt = $db->prepare("INSERT INTO orders (UserID, OrderTime, OrderStatus, TotalAmount) VALUES (:userid, :ordertime, :orderstatus, :totalamount)");
        $stmt->bindValue(':userid', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':ordertime', $date_time);
        $stmt->bindValue(':orderstatus', "Pending");
        $stmt->bindValue(':totalamount', $total_price, PDO::PARAM_INT);
        $stmt->execute();

        $order_id = $db->lastInsertId();

        foreach($shopping_cart as $item => $itemArray) {
            list($product_id, $size) = explode('|', $item);
            $quantity = $itemArray['quantity'];

            $stmt = $db->query("SELECT Price FROM inventory WHERE ProductID = $product_id");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $price = $row['Price'];
            
            $stmt = $db->prepare("INSERT INTO orderitems (OrderID, ProductID, Quantity, SubTotal) VALUES (:order_id ,:product_id, :quantity, :sub_total)");
            $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindValue(':sub_total', $quantity * $price, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("
            SELECT stock_table.* 
            FROM stock_table 
            INNER JOIN sizes_table ON stock_table.SizeID = sizes_table.SizeID 
            WHERE stock_table.ProductID = :product_id AND sizes_table.SizeName = :size
            ");

            $stmt->execute([':product_id' => $product_id, ':size' => $size]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rows as $row) {
                $newStock = $row['Quantity'] - $quantity;

                $stmt = $db->prepare("UPDATE stock_table SET Quantity = :stock WHERE StockID = :stock_id");
                $stmt->execute([':stock' => $newStock, ':stock_id' => $row['StockID']]);
            }
        };

        setcookie('shopping_cart', serialize(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
        setcookie('shopping_cart_json', json_encode(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
    //}
?>

<html>
    
</html>