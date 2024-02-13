<?php
// If the form has been submitted
if (isset($_POST['submitted'])) {
  // Checks if the fields have data inputted
  if (!isset($_POST['email'], $_POST['password'])) {
    exit('Please fill both the email and password fields!');
  }

  require("connectiondb.php");

  try {
    // Checks the database for the matching password and email
    $stmt = $db->prepare('SELECT Pass, isAdmin FROM useraccounts WHERE Email = ?');
    $stmt->execute(array($_POST['email']));

    // Fetch the result row and check 
    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch();

      if (password_verify($_POST['password'], $row['Pass'])) {
        session_start();
        $_SESSION["email"] = $_POST['email'];
        $_SESSION["isAdmin"] = $row['isAdmin'];

        // Depending on the account level, it sets the access level to the session
        if ($row['isAdmin'] == 1) {
          $_SESSION['isAdmin'] = 1; 
        } else {
          $_SESSION['isAdmin'] = 0; 
        }

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
      // Else display an error
      echo "<p style='color:red'>Error logging in, Username not found </p>";
    }
  } catch (PDOException $e) {
    echo ("Failed to connect to the database.<br>");
    echo "Error details: <em>" . $e->getMessage() . "</em>";
    exit;
  }
}
