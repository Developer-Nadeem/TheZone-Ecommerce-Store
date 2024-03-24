<?php
session_start();
include('../TheZone/connectiondb.php');
if (isset($_POST['submitted'])) {
  $error = "";
  if (!empty(trim($_POST['ProductName'])) && !empty(trim($_POST['Description'])) && !empty(trim($_POST['ImageURL'])) && !empty(trim($_POST['Price']))  && !empty(trim($_POST['GenderID'])) && isset($_SESSION['CSRF_Token']) && $_SESSION['CSRF_Token'] === $_POST['csrftoken']) {
    if ($_POST['AddCatID'] != 4) {
      try {
        $productName = trim($_POST['ProductName']);
        $description = trim($_POST['Description']);
        $imageURL = trim($_POST['ImageURL']);
        $price = trim($_POST['Price']);
        $quantityXS = trim($_POST['QuantityXS']);
        $quantityS = trim($_POST['QuantityS']);
        $quantityM = trim($_POST['QuantityM']);
        $quantityL = trim($_POST['QuantityL']);
        $quantityXL = trim($_POST['QuantityXL']);
        $catID = trim($_POST['AddCatID']);
        $genderID = trim($_POST['GenderID']);
        $finalprice = preg_replace("/[^0-9]/", "", $price);



        $updatevals = $db->prepare("INSERT INTO inventory (ProductID,ProductName,ProductDescription,Price,ImageURL,CategoryID,GenderID) VALUES ( '', :productName, :description, :price, :imageURL,:catID, :genderID)");
        $updatevals->bindParam(':productName', $productName);
        $updatevals->bindParam(':description', $description);
        $updatevals->bindParam(':price', $finalprice);
        $updatevals->bindParam(':catID', $catID);
        $updatevals->bindParam(':genderID', $genderID);
        $updatevals->bindParam(':imageURL', $imageURL);
        $updatevals->execute();

        $productID = $db->lastInsertId();
        $XS = 1;
        $S = 2;
        $M = 3;
        $L = 4;
        $XL = 5;

        $updatevals = $db->prepare("INSERT INTO stock_table VALUES ( '', :ProductID, :SizeID, :Quantity)");
        $updatevals->bindParam(':ProductID', $productID);
        $updatevals->bindParam(':SizeID', $XS);
        $updatevals->bindParam(':Quantity', $quantityXS);
        $updatevals->execute();

        $updatevals = $db->prepare("INSERT INTO stock_table VALUES ( '', :ProductID, :SizeID, :Quantity)");
        $updatevals->bindParam(':ProductID', $productID);
        $updatevals->bindParam(':SizeID', $S);
        $updatevals->bindParam(':Quantity', $quantityS);
        $updatevals->execute();

        $updatevals = $db->prepare("INSERT INTO stock_table VALUES ( '', :ProductID, :SizeID, :Quantity)");
        $updatevals->bindParam(':ProductID', $productID);
        $updatevals->bindParam(':SizeID', $M);
        $updatevals->bindParam(':Quantity', $quantityM);
        $updatevals->execute();

        $updatevals = $db->prepare("INSERT INTO stock_table VALUES ( '', :ProductID, :SizeID, :Quantity)");
        $updatevals->bindParam(':ProductID', $productID);
        $updatevals->bindParam(':SizeID', $L);
        $updatevals->bindParam(':Quantity', $quantityL);
        $updatevals->execute();

        $updatevals = $db->prepare("INSERT INTO stock_table VALUES ( '', :ProductID, :SizeID, :Quantity)");
        $updatevals->bindParam(':ProductID', $productID);
        $updatevals->bindParam(':SizeID', $XL);
        $updatevals->bindParam(':Quantity', $quantityXL);
        $updatevals->execute();

        header("Location: ../TheZone/admin-inventory.php");
      } catch (PDOException $ex) {
        echo "<p> Sorry, a database error occured.</p>" . $ex->getMessage();
      }
    } else {
      #shoe sizes
      try {
        $productName = trim($_POST['ProductName']);
        $description = trim($_POST['Description']);
        $imageURL = trim($_POST['ImageURL']);
        $price = trim($_POST['Price']);
        $quantityA = trim($_POST['QuantityA']);
        $quantityB = trim($_POST['QuantityB']);
        $quantityC = trim($_POST['QuantityC']);
        $quantityD = trim($_POST['QuantityD']);
        $quantityE = trim($_POST['QuantityE']);
        $quantityF = trim($_POST['QuantityF']);
        $quantityG = trim($_POST['QuantityG']);
        $quantityH = trim($_POST['QuantityH']);
        $quantityI = trim($_POST['QuantityI']);
        $quantityJ = trim($_POST['QuantityJ']);
        $quantityK = trim($_POST['QuantityK']);
        $quantityKK = trim($_POST['QuantityKK']);
        $quantityLS = trim($_POST['QuantityL-shoe']);
        $quantityMS = trim($_POST['QuantityM-shoe']);
        $quantityN = trim($_POST['QuantityN']);
        $quantityO = trim($_POST['QuantityO']);
        $quantityP = trim($_POST['QuantityP']);
        $quantityQ = trim($_POST['QuantityQ']);
        $quantityR = trim($_POST['QuantityR']);
        $quantitySSHOE = trim($_POST['QuantityS-shoe']);
        $quantityT = trim($_POST['QuantityT']);
        $quantityU = trim($_POST['QuantityU']);
        $quantityV = trim($_POST['QuantityV']);
        $quantityW = trim($_POST['QuantityW']);
        $quantityX = trim($_POST['QuantityX']);
        $quantityY = trim($_POST['QuantityY']);
        $quantityZ = trim($_POST['QuantityZ']);
        $catID = trim($_POST['AddCatID']);
        $genderID = trim($_POST['GenderID']);
        $finalprice = preg_replace("/[^0-9]/", "", $price);



        
        

        //Get the highest Product ID in the table
        $getProductID = $db->prepare("SELECT MAX(ProductID) FROM inventory");
        $getProductID->execute();
        $productID = $getProductID->fetchColumn();
        $productID++;

        $Zero = 6;
        $ZeroHalf = 7;
        $One = 8;
        $OneHalf = 9;
        $Two = 10;
        $TwoHalf = 11;
        $Three = 12;
        $ThreeHalf = 13;
        $Four = 14;
        $FourHalf = 15;
        $Five = 16;
        $FiveHalf = 17;
        $Six = 18;
        $SixHalf = 19;
        $Seven = 20;
        $SevenHalf = 21;
        $Eight = 22;
        $EightHalf = 22;
        $Nine = 24;
        $NineHalf = 25;
        $Ten = 26;
        $TenHalf = 27;
        $Eleven = 28;
        $ElevenHalf = 29;
        $Twelve = 30;
        $TwelveHalf = 31;
        $Thirteen = 32;

        $sizeId_quantity_map = [
          $Zero => $quantityA,
          $ZeroHalf => $quantityB,
          $One => $quantityC,
          $OneHalf => $quantityD,
          $Two => $quantityE,
          $TwoHalf => $quantityF,
          $Three => $quantityG,
          $ThreeHalf => $quantityH,
          $Four => $quantityI,
          $FourHalf => $quantityJ,
          $Five => $quantityK,
          $FiveHalf => $quantityKK,
          $Six => $quantityLS,
          $SixHalf => $quantityMS,
          $Seven => $quantityN,
          $SevenHalf => $quantityO,
          $Eight => $quantityP,
          $EightHalf => $quantityQ,
          $Nine => $quantityR,
          $NineHalf => $quantitySSHOE,
          $Ten => $quantityT,
          $TenHalf => $quantityU,
          $Eleven => $quantityV,
          $ElevenHalf => $quantityX,
          $Twelve => $quantityW,
          $TwelveHalf => $quantityY,
          $Thirteen => $quantityZ
        ];

        foreach($sizeId_quantity_map as $sizeId => $quantity) {
          echo $sizeId . "\n";

          $updatevals = $db->prepare("INSERT INTO stock_table VALUES ( '', :ProductID, :SizeID, :Quantity)");
          $updatevals->bindParam(':ProductID', $productID);
          $updatevals->bindParam(':SizeID', $sizeId);
          $updatevals->bindParam(':Quantity', $quantity);
          $updatevals->execute();
        }

        $updatevals = $db->prepare("INSERT INTO inventory (ProductID,ProductName,ProductDescription,Price,ImageURL,CategoryID,GenderID) VALUES ( :productID, :productName, :description, :price, :imageURL,:catID, :genderID)");
        $updatevals->bindParam(':productID', $productID);
        $updatevals->bindParam(':productName', $productName);
        $updatevals->bindParam(':description', $description);
        $updatevals->bindParam(':price', $finalprice);
        $updatevals->bindParam(':catID', $catID);
        $updatevals->bindParam(':genderID', $genderID);
        $updatevals->bindParam(':imageURL', $imageURL);
        $updatevals->execute();

        
        header("Location: ../TheZone/admin-inventory.php");
      } catch (PDOException $ex) {
        echo "<p> Sorry, a database error occured.</p>" . $ex->getMessage();
      }
    }
  } else {


    if (empty(trim($_POST['ProductName']))) {
      $error .= "please enter a product name.<br>";
    }
    if (empty(trim($_POST['Description']))) {
      $error .= "please enter a description.<br>";
    }
    if (empty(trim($_POST['Price']))) {
      $error .= "please enter a price.<br>";
    }
    

    echo $error;
  }
}
