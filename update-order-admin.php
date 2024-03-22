<?php
session_start();
include('../TheZone/connectiondb.php');

if(isset($_POST['submitted'])) {
    if (!empty(trim($_POST['orderStatus'])) && !empty(trim($_POST['orderID']))) {
        try {
            $orderStatus = $_POST['orderStatus'];
            $orderID =  $_POST['orderID'];
            
            

            $updateStatus = $db->prepare("UPDATE orders SET OrderStatus =:status WHERE orderID =:ID ");

            $updateStatus->bindParam(':status', $orderStatus);
            $updateStatus->bindParam(':ID', $orderID);
           
            $updateStatus->execute();
            

            header("Location: admin-panel.php");
            exit();
        } catch (PDOException $ex) {
            echo "<p> Sorry, a database error occurred.</p>". $ex->getMessage();
          
        }
    }
}
