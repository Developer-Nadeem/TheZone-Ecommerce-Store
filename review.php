<?php
session_start();

if (isset($_POST['submitted'])) {
  require("connectiondb.php");

  $description = trim($_POST['description']);
  $rating = $_POST['rating'];
  $email = $_SESSION['email'];
  $product = $_POST['product-id'];

  if (empty($description)) {
    $_SESSION['noDesc'] = 'Please write a review';
    header("Location: product-page.php?product_id=$product");
    exit;
  }

  if (empty($rating)) {
    $_SESSION['noRating'] = 'Please give a rating';
    header("Location: product-page.php?product_id=$product");
    exit;
  }

  //Gets the userid from the email
  $stmt = $db->prepare("SELECT UserID FROM useraccounts WHERE Email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $userID = $stmt->fetchColumn();

  try {
    $stmt = $db->prepare("INSERT INTO reviews (ProductID, Rating, Description, UserID) VALUES (:product, :rating, :description, :userID)");
    $stmt->bindParam(':product', $product);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    $_SESSION['reviewSubmit'] = 'Review submitted';
    header("Location: product-page.php?product_id=$product");
    exit;
  } catch (PDOException $e) {
    echo "Sorry, failed to submit review! <br>";
    echo "Error details: <em>" . $e->getMessage() . "</em>";
  }
}
