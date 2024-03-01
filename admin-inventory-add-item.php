<?php
session_start();
include('../TheZone/connectiondb.php');
if (isset($_POST['submitted'])) {
    $error = "";
    if (!empty(trim($_POST['ProductName'])) && !empty(trim($_POST['Description'])) && !empty(trim($_POST['ImageURL'])) && !empty(trim($_POST['Price'])) && !empty(trim($_POST['Quantity'])) && !empty(trim($_POST['CatID'])) && !empty(trim($_POST['GenderID'])) && isset($_SESSION['CSRF_Token']) && $_SESSION['CSRF_Token'] === $_POST['csrftoken'] ) {
    
        try {
            $productName = trim($_POST['ProductName']);
            $description = trim($_POST['Description']);
            $imageURL = trim($_POST['ImageURL']);
            $price = trim($_POST['Price']);
            $quantity = trim($_POST['Quantity']);
            $catID = trim($_POST['CatID']);
            $genderID = trim($_POST['GenderID']);
            $finalprice = preg_replace("/[^0-9]/", "", $price);

          
    
            $updatevals = $db->prepare("INSERT INTO inventory VALUES ( '', :productName, :description, :price, :imageURL, :stock, :catID, :genderID)");
            $updatevals->bindParam(':productName', $productName);
            $updatevals->bindParam(':description', $description);
            $updatevals->bindParam(':price', $finalprice);
            $updatevals->bindParam(':stock', $quantity);
            $updatevals->bindParam(':catID', $catID);
            $updatevals->bindParam(':genderID', $genderID);
            $updatevals->bindParam(':imageURL', $imageURL);
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