<?php

session_start();

// Checks if the user is logged in, if not it redirects you to the login/signup page
if (!isset($_SESSION['email'])) {
    header("Location: login-signup-page.php");
    exit();
}

// Preforms another check to see if the logged in account is an admin, if not, it doesn't allow the user to access the page
if ($_SESSION['isAdmin'] !== 1) {
    echo '<h1 style="color:red;">Forbidden Access</h1>
    <p>You don\'t have permission to access this page</p>';
    exit();
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone</title>
    <link rel="stylesheet" href="../TheZone/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        h2 {
            margin: 5px;
        }
        .container {
            display: flex;
            flex-direction: column;
            height: 100%;
            margin: 10px;
            margin-left: auto;
            margin-right: auto;
        }
        .row {
            display: flex;
            flex: 1;
        }
        .section {
            flex: 1;
            border: 5px solid black;
            padding: 20px;
            border-radius: 5px;
            margin: 10px;
            overflow-y: auto; 
            height: calc(50% - 22px);
        }
    </style>
</head>

<body>

    <!-- navbar -->
    <?php include('../TheZone/adminnavbar.php') ?>
    <!-- navbar end -->

    <main>
    <div class="container">

        <div class="row">

            <div class="section">
                <h2>Recent Purchases</h2>
                <p>To show recent purchases made, could show something else</p>
                
            </div>

            <div class="section">
                <h2>Current Orders</h2>
                <p>To show the current orders that require processing</p>
            </div>

        </div>

        <div class="section">
            <h2>Stock Levels</h2>
            <p>showing products and their stock levels</p>
        </div>

    </div>

    </main>


</body>