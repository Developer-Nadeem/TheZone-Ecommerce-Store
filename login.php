<?php
//if the form has been submitted
if (isset($_POST['submitted'])) {

  //Checks if the fields has data inputted
  if (!isset($_POST['email'], $_POST['password'])) {
    exit('Please fill both the email and password fields!');
  }

  require("connectiondb.php");

  try {
    //checks the database for the matching password and email
    $stmt = $db->prepare('SELECT Pass, isAdmin FROM useraccounts WHERE Email = ?');
    $stmt->execute(array($_POST['email']));


    // fetch the result row and check 
    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();

      if (password_verify($_POST['password'], $row['Pass'])) {
        session_start();
        $_SESSION["email"] = $_POST['email'];

        if ($row['isAdmin'] == 1) {
          header("Location: adminhomepage.php"); 
        } else {
          header("Location: login-success.php"); 
        }
        exit();
      } else {
        echo "<p style='color:red'>Error logging in, password does not match </p>";
      }
    } else {
      //else display an error
      echo "<p style='color:red'>Error logging in, Username not found </p>";
    }
  } catch (PDOException $e) {
    echo ("Failed to connect to the database.<br>");
    echo "Error details: <em>" . $e->getMessage() . "</em>";
    exit;
  }
}
