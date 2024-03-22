
<?php
session_start();
// If the form has been submitted
if (isset($_POST['submitted'])) {
  // Checks if the fields have data inputted
  if (empty($_POST['email']) && empty($_POST['password'])) {
    $_SESSION['noInputError'] = "Please fill out both Email and Password fields!";
    header("Location: login-signup-page.php");
    exit();
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
        $_SESSION['passwordError'] = 'Password is invalid';
        header("Location: login-signup-page.php");
        exit();
      }
    } else {
      $_SESSION['emailError'] = 'Email is invalid';
      header("Location: login-signup-page.php");
      exit();
    }
  } catch (PDOException $e) {
    echo ("Failed to connect to the database.<br>");
    echo "Error details: <em>" . $e->getMessage() . "</em>";
    exit;
  }
}
