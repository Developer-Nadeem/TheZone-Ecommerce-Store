<?php
session_start();
include('../TheZone/connectiondb.php');
if (isset($_POST['submitted'])) {
  $error = "";

  echo $_POST['EditCatID'];
  if ($_POST['EditCatID'] != 4) {
    echo 'Clothing category detected';

    echo empty($_POST['ProductName']) . "<br>";
    echo empty($_POST['Description']) . "<br>";
    echo empty($_POST['Price'])  . "<br>";
    echo empty($_POST['QuantityXS'])  . "<br>";
    echo empty($_POST['QuantityS'])  . "\n";
    echo empty($_POST['QuantityM'])  . "\n";
    echo empty($_POST['QuantityL'])  . "\n";
    echo empty($_POST['QuantityXL'])  . "\n";
    echo isset($_SESSION['CSRF_Token']) . "\n";
    echo empty($_POST['ProductID'])  . "\n";
    echo $_SESSION['CSRF_Token']  . "\n";
    echo $_POST['csrftoken'];

    if (!isset($_POST['ProductName'])) return;
    if (!isset($_POST['Description'])) return;
    if (!isset($_POST['Price'])) return;
    if (!isset($_SESSION['CSRF_Token'])) return;
    if (!isset($_POST['ProductID'])) return;
    if (!isset($_POST['csrftoken'])) return;



    if (isset($_POST['QuantityXS']) && isset($_POST['QuantityS']) && isset($_POST['QuantityM']) && isset($_POST['QuantityL']) && isset($_POST['QuantityXL'])) {

      echo 'Hello world';
      try {
        $productName = trim($_POST['ProductName']);
        $description = trim($_POST['Description']);
        $price = trim($_POST['Price']);
        $quantityXS = trim($_POST['QuantityXS']);
        $quantityS = trim($_POST['QuantityS']);
        $quantityM = trim($_POST['QuantityM']);
        $quantityL = trim($_POST['QuantityL']);
        $quantityXL = trim($_POST['QuantityXL']);
        $productID = trim($_POST['ProductID']);
        $finalprice = preg_replace("/[^0-9]/", "", $price);

        //Echo the above
        echo $productName . "<br>";
        echo $description . "<br>";
        echo $price . "<br>";
        echo $quantityXS . "<br>";
        echo $quantityS . "<br>";
        echo $quantityM . "<br>";
        echo $quantityL . "<br>";
        echo $quantityXL . "<br>";
        echo $productID . "<br>";
        echo $finalprice . "<br>";




        $updatevals = $db->prepare("UPDATE inventory SET ProductName=:productName, ProductDescription=:description, Price=:price WHERE ProductID = :productID;");
        $updatevals->bindParam(':productName', $productName);
        $updatevals->bindParam(':description', $description);
        $updatevals->bindParam(':price', $finalprice);
        $updatevals->bindParam(':productID', $productID);
        $updatevals->execute();

        $updatevals = $db->prepare("UPDATE stock_table 
                           SET Quantity = CASE SizeID 
                                            WHEN 1 THEN :quantityXS 
                                            WHEN 2 THEN :quantityS 
                                            WHEN 3 THEN :quantityM 
                                            WHEN 4 THEN :quantityL 
                                            WHEN 5 THEN :quantityXL 
                                        END 
                           WHERE ProductID = :productID;");

        $updatevals->bindParam(':quantityXS', $quantityXS);
        $updatevals->bindParam(':quantityS', $quantityS);
        $updatevals->bindParam(':quantityM', $quantityM);
        $updatevals->bindParam(':quantityL', $quantityL);
        $updatevals->bindParam(':quantityXL', $quantityXL);
        $updatevals->bindParam(':productID', $productID);
        $updatevals->execute();


        header("Location: ../TheZone/admin-inventory.php");
      } catch (PDOException $ex) {
        echo "<p> Sorry, a database error occured.</p>" . $ex->getMessage();
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
  } else {

    echo 'Shoe category detected';
    #IF ITS OF SHOE CATEGORY
    try {
      $productName = trim($_POST['ProductName']);
      $description = trim($_POST['Description']);
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
      
      $productID = trim($_POST['ProductID']);
      $finalprice = preg_replace("/[^0-9]/", "", $price);




      $updatevals = $db->prepare("UPDATE inventory SET ProductName=:productName, ProductDescription=:description, Price=:price WHERE ProductID = :productID;");
      $updatevals->bindParam(':productName', $productName);
      $updatevals->bindParam(':description', $description);
      $updatevals->bindParam(':price', $finalprice);
      $updatevals->bindParam(':productID', $productID);
      $updatevals->execute();

      // Update the stock table based on the new quantities

      $updatevals = $db->prepare("UPDATE stock_table 
                           SET Quantity = CASE SizeID 
                                            WHEN 6 THEN :quantityA 
                                            WHEN 7 THEN :quantityB 
                                            WHEN 8 THEN :quantityC 
                                            WHEN 9 THEN :quantityD 
                                            WHEN 10 THEN :quantityE 
                                            WHEN 11 THEN :quantityF 
                                            WHEN 12 THEN :quantityG 
                                            WHEN 13 THEN :quantityH 
                                            WHEN 14 THEN :quantityI 
                                            WHEN 15 THEN :quantityJ 
                                            WHEN 16 THEN :quantityK 
                                            WHEN 17 THEN :quantityKK 
                                            WHEN 18 THEN :quantityLS 
                                            WHEN 19 THEN :quantityMS 
                                            WHEN 20 THEN :quantityN 
                                            WHEN 21 THEN :quantityO 
                                            WHEN 22 THEN :quantityP 
                                            WHEN 23 THEN :quantityQ 
                                            WHEN 24 THEN :quantityR 
                                            WHEN 25 THEN :quantitySSHOE 
                                            WHEN 26 THEN :quantityT 
                                            WHEN 27 THEN :quantityU 
                                            WHEN 28 THEN :quantityV 
                                            WHEN 29 THEN :quantityW 
                                            WHEN 30 THEN :quantityX 
                                            WHEN 31 THEN :quantityY 
                                            WHEN 32 THEN :quantityZ 
                                        END 
                           WHERE ProductID = :productID;");
      $updatevals->bindParam(':quantityA', $quantityA);
      $updatevals->bindParam(':quantityB', $quantityB);
      $updatevals->bindParam(':quantityC', $quantityC);
      $updatevals->bindParam(':quantityD', $quantityD);
      $updatevals->bindParam(':quantityE', $quantityE);
      $updatevals->bindParam(':quantityF', $quantityF);
      $updatevals->bindParam(':quantityG', $quantityG);
      $updatevals->bindParam(':quantityH', $quantityH);
      $updatevals->bindParam(':quantityI', $quantityI);
      $updatevals->bindParam(':quantityJ', $quantityJ);
      $updatevals->bindParam(':quantityK', $quantityK);
      $updatevals->bindParam(':quantityKK', $quantityKK);
      $updatevals->bindParam(':quantityLS', $quantityLS);
      $updatevals->bindParam(':quantityMS', $quantityMS);
      $updatevals->bindParam(':quantityN', $quantityN);
      $updatevals->bindParam(':quantityO', $quantityO);
      $updatevals->bindParam(':quantityP', $quantityP);
      $updatevals->bindParam(':quantityQ', $quantityQ);
      $updatevals->bindParam(':quantityR', $quantityR);
      $updatevals->bindParam(':quantitySSHOE', $quantitySSHOE);
      $updatevals->bindParam(':quantityT', $quantityT);
      $updatevals->bindParam(':quantityU', $quantityU);
      $updatevals->bindParam(':quantityV', $quantityV);
      $updatevals->bindParam(':quantityW', $quantityW);
      $updatevals->bindParam(':quantityX', $quantityX);
      $updatevals->bindParam(':quantityY', $quantityY);
      $updatevals->bindParam(':quantityZ', $quantityZ);

      $updatevals->bindParam(':productID', $productID);
      $updatevals->execute();


      header("Location: ../TheZone/admin-inventory.php");
    } catch (PDOException $ex) {
      echo "<p> Sorry, a database error occured.</p>" . $ex->getMessage();
    }
  }
}
