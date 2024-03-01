<?php
session_start();
include('../TheZone/connectiondb.php');

if (isset($_POST['removeProductID'])) {
    try {
        $productID = $_POST['removeProductID'];
        $deleteProduct = $db->prepare("DELETE FROM inventory WHERE ProductID = :productID");
        $deleteProduct->bindParam(':productID', $productID);
        $deleteProduct->execute();
    
        header("Location: ../TheZone/admin-inventory.php");
        exit();
    } catch (PDOException $ex) {
        echo "<p>Sorry, a database error occurred.</p>". $ex->getMessage();
    }
}
