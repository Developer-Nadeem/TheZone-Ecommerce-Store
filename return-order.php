<?php
session_start();
include('../TheZone/connectiondb.php');

if (isset($_POST['submitted'])) {
        $orderID = $_POST['OrderID'];
        try {
            $email = $_SESSION['email'];

            $stmt = $db->prepare("SELECT orders.OrderID, orders.OrderTime, orders.OrderStatus, orders.TotalAmount FROM orders WHERE orders.UserID IN (SELECT UserID FROM useraccounts WHERE Email = ?) AND orders.OrderID = $orderID");
            $stmt->execute([$email]);
            $orders = $stmt->fetch(PDO::FETCH_ASSOC);

            print_r($orders);

            if($orders['OrderStatus'] != 'Shipped'){
                echo "<p> Not shipped.</p>";
                $stmt = $db->prepare("DELETE  FROM orders WHERE orders.UserID IN (SELECT UserID FROM useraccounts WHERE Email = ?) AND orders.OrderID = $orderID");
                $stmt->execute([$email]);
                echo "<p> Order Returned.</p>";
            } else{
                echo "Sorry, unable to cancel an order that has already been shipped.";
            }
            header("Location: user-order.php");

        } catch (PDOException $ex) {
            echo "<p> Sorry, a database error occurred.</p>" . $ex->getMessage();
        }
    }

