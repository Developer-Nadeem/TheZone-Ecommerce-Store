<?php
session_start();
include('../TheZone/connectiondb.php');
if (isset($_POST['submitted'])) {
    $error = "";
    if (!empty(trim($_POST['ProductName'])) && !empty(trim($_POST['Description'])) && !empty(trim($_POST['Price'])) && !empty(trim($_POST['Quantity'])) && isset($_SESSION['CSRF_Token'])&& !empty(trim($_POST['ProductID'])) && $_SESSION['CSRF_Token']=== $_POST['csrftoken'] ) {
    
        try {
            $productName = trim($_POST['ProductName']);
            $description = trim($_POST['Description']);
            $price = trim($_POST['Price']);
            $quantity = trim($_POST['Quantity']);
            $productID = trim($_POST['ProductID']);
            $finalprice = preg_replace("/[^0-9]/", "", $price);

          
    
            $updatevals = $db->prepare("UPDATE inventory SET ProductName=:productName, ProductDescription=:description, Price=:price, StockQuantity=:stock WHERE ProductID = :productID");
            $updatevals->bindParam(':productName', $productName);
            $updatevals->bindParam(':description', $description);
            $updatevals->bindParam(':price', $finalprice);
            $updatevals->bindParam(':stock', $quantity);
            $updatevals->bindParam(':productID', $productID);
            $updatevals->execute();

            header("Location: ../TheZone/admin-inventory.php");
            
        } catch (PDOException $ex) {
            echo "<p> Sorry, a database error occured.</p>". $ex->getMessage();
        }
    }
    else{

    
        if (empty(trim($_POST['ProductName']))) {
            $error .= "please enter a product name.<br>";
          }
          if (empty(trim($_POST['Description']))) {
            $error .= "please enter a description.<br>";
          }
          if (empty(trim($_POST['Price']))) {
            $error .= "please enter a price.<br>";
          }
          if (empty(trim($_POST['StockQuantity']))) {
            $error .= "please enter quantity number.<br>";
          }
         
          echo $error;
    }


}




?>