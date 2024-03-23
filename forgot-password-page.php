<?php
session_start();

// If the user is already logged in, it redirects them to the home page
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$invalidEmail = isset($_SESSION['invalidEmail']) ? $_SESSION['invalidEmail'] : '';
$emailNoExist = isset($_SESSION['emailNoExist']) ? $_SESSION['emailNoExist'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="resetpass-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Forgot Password</title>
</head>

<body>
    <!--Navbar Start-->
    <?php include('navbar.php') ?>
    <!--Navbar End-->

    <main>
        <div style="text-align: center; margin-top: 25px;">
            <h2>Forgot Password?</h2>
        </div>
        <div class="changepass-container">
            <form method="post" action="forgot-password.php">
                <label class="changepass-label" for="email">Email:</label>
                <div class="cfield">
                    <input class="changepass-input" type="text" id="email" name="email" placeholder="Enter your email"><br>
                </div>
                <div style="text-align: center;">
                    <input class="changepass-input-submit" type="submit" value="Submit">
                    <input type="hidden" name="submitted" value="true" />
                </div>
                <div style="color:red ; font-weight: bold;">
                    <?php
                    if (!empty($invalidEmail)) {
                        echo $invalidEmail;
                    }
                    if (!empty($emailNoExist)) {
                        echo $emailNoExist;
                    } ?>
                </div>
                <div style="color:green ; font-weight: bold;">
                    <?php
                    if (!empty($success)) {
                        echo $success;
                    }
                    ?>
                </div>

            </form>
        </div>
    </main>

    <?php
    unset($_SESSION['invalidEmail']);
    unset($_SESSION['emailNoExist']);
    unset($_SESSION['success']);

    ?>
    <!-- needed for drop down menu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- Footer Start -->
    <?php include('footer.php') ?>
    <!-- Footer End -->

</body>
<html>