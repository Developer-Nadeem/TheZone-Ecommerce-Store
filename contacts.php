<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TheZone - Products</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <!--Navbar Start-->
  <?php include('navbar.php') ?>
  <!--Navbar End-->

  <h2 class="text-center">Contact Us</h2>
  <div class="container container-pos">
    <div class="contact-container">
      <form method="post" action="contacts.php" class="contact-form">
        <label for="name" class="contact-label">Name:</label>
        <input type="text" name="name" class="contact-input cfield" required><br>

        <label for="email" class="contact-label">Email:</label>
        <input type="email" name="email" class="contact-input cfield" required><br>

        <label for="message" class="contact-label">Message:</label>
        <textarea name="message" rows="4" class="contact-input cfield" required></textarea><br>
        <input class="contact-input-submit" type="submit" value="Submit">
        <input type="hidden" name="submitted" value="true">
      </form>
    </div>
  </div>


  <!-- needed for drop down menu -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


  <?php include("footer.php"); ?>
</body>

<style>
  .contact-container {
    width: 300px;
    max-width: 600px;
    margin: 0 auto;
    margin-top: 20px;
    margin-bottom: 90px;
  }

  .contact-container form {
    background: rgb(230, 230, 230);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .contact-label {
    display: block;
    margin-bottom: 5px;
  }

  .contact-input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .contact-input-submit {
    background-color: #333;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .contact-input-submit:hover {
    background-color: #555;
  }
</style>

</html>
<?php
include("connectiondb.php");
if (isset($_POST["submitted"]) && !empty(isset($_POST["message"])) && !empty(isset($_POST["email"])) && !empty(isset($_POST["name"]))) {
  try {

    date_default_timezone_set('UTC');
    $currentDateTime = date('Y-m-d H:i:s');

    $query = $db->prepare("INSERT INTO contactrequests VALUES ('',:name,:email,:message,:Timestamp) ");
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':message', $message);
    $query->bindParam(':Timestamp', $currentDateTime);
    $query->execute();
  } catch (PDOException $ex) {
  }
}
?>