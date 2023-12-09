<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TheZone - Products</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <!--Navbar Start-->
  <?php include('..\TheZone\\navbar.php') ?>
  <!--Navbar End-->

  <div class="container container-pos">
  <h2>Contact Us</h2>

    <form method="post" action="contacts.php">
      <label class="name-label" for="name">Name:</label>
      <input class="name inputs" type="text" id="name" name="name" required><br>

      <label class="email-label" for="email">Email:</label>
      <input class="email inputs" type="email" id="email" name="email" required><br>

      <label class="message-label" for="message">Message:</label>
      <textarea class="message inputs" id="message" name="message" rows="4" required></textarea><br>
      <input class="submit-btn" type="submit" value="Submit">
      <input type="hidden" name="submitted" value="true">
    </form>
  </div>
 <!-- needed for drop down menu -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
<?php
include("connectiondb.php");
if(isset($_POST["submitted"]) && !empty(isset($_POST["message"]))&& !empty(isset($_POST["email"]))&& !empty(isset($_POST["name"]))){
  try{
    
    date_default_timezone_set('UTC');
    $currentDateTime = date('Y-m-d H:i:s');

    $query = $db->prepare("INSERT INTO contactrequests VALUES ('',:name,:email,:message,:Timestamp) ");
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $query->bindParam(':name',$name);
    $query->bindParam(':email',$email);
    $query->bindParam(':message',$message);
    $query->bindParam(':Timestamp',$currentDateTime);
    $query->execute();



  }catch(PDOException $ex){




}


}





?>


























