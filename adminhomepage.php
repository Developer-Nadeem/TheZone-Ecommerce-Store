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
        body {
            background-color: lightgrey;
        }

        .column {
            flex: 1;
            height: 100vh;
            width: 33%;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            text-align: center;
            border: solid 5px black;
            margin: 10px;
            border-radius: 10px;
        }

        .panel {
            flex: 1;
            display: flex;
            justify-content: center;
            width: 95%;
            color: white;
            border: solid 5px black;
            border-radius: 10px;
            margin:10px;
            margin-left: auto;
            margin-right: auto;
        }

        .panel-button {
            margin-top: 5%;
            margin-bottom: 5%;
            font-size: 30px;
            font-weight: bold;
            padding: 20px;
            background-color: white;
            color: #000;
            border: none;
            border-radius: 5px;
            width: 35%;
        }

        .panel-button:hover {
            background-color: rgb(140,140,140);
            color: #fff;
        }

        .button {
            margin-top: 8%;
            font-size: 28px;
            font-weight: bold;
            padding: 20px;
            background-color: white;
            color: #000;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-radius: 5px;
        }

        .button:hover {
            background-color: rgb(140, 140, 140);
            color: #fff;
        }

        #column1 {
            background-image: url('images/box_new.png');
        }

        #column2 {
            background-image: url('images/group.png');
        }

        #column3 {
            background-image: url('images/tracking.png');
        }

        #column4 {
            background-image: url('images/envelope.png')
        }

        @media screen and (min-width: 768px) {
            .column {
                width: 33.33%;
            }
        }
    </style>
    <script>
        // Function to handle button click and redirect
        function redirectToPage(pageUrl) {
            window.location.href = pageUrl;
        }
    </script>
</head>

<body>

    <!-- navbar -->
    <?php include('../TheZone/adminnavbar.php') ?>
    <!-- navbar end -->

    <main>

        <!-- Admin Panel Button -->
        <div class="panel">
            <button style="margin-top: auto, margin-bottom: auto;" class="panel-button" onclick="redirectToPage('admin-panel.php')">ADMIN PANEL</button>
        </div>

        <div style="display: flex;">

            <div id="column1" class="column">
                <button class="button" onclick="redirectToPage('admin-inventory.php')">INVENTORY</button>
            </div>

            <div id="column2" class="column">
                <button class="button" onclick="redirectToPage('admin-customers.php')">CUSTOMERS</button>
            </div>

            <div id="column3" class="column">
                <button class="button" onclick="redirectToPage('admin-order.php')">ORDERS</button>
            </div>

            <div id="column4" class="column">
                <button class="button" onclick="redirectToPage('admin-contacts.php')">CONTACT</button>
            </div>
        </div>

    </main>


</body>