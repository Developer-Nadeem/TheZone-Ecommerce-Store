<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone - Products</title>
    <link rel="stylesheet" href="../THEZONE/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="img-fluid logo" src="../TheZone/images/logo-tp.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Products
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Mens</a></li>
                <li><a class="dropdown-item" href="#">Womens</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Kids</a></li>
              </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contacts.php">Contact Us</a>
            </li>
            

          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>
           <div>
        <button>Shopping</button> 
      </div>
        </div>
      <!-- adding in shopping cart button/icon then this will redirect page to basket and view all items
    will have the following: increase and decrease quanitity, remove item, continue shopping, proceed to checkout, personal details
  choose to login or continue as a guest. Also, Create a drop down menu when hovering over cart to view products or go to checkout and enter personal details. -->
      
       

      </div>
    </nav>
  </header>
    <?php
        // if ($SERVER[] == "Post") {
        //     $name = $_POST["name please"];
        //     $email = $_POST["this is the email"];
        //     $message = $_POST["any messages here please"];
    
    
        //     $adminEmail = "admins email";
    
           
        //     $email = "name $name\n";
        //     $email = "email $email\n";
        //     $email = "message $message\n";
    
           
        //     mail($adminEmail, $subject, $emailMessage);
    
            
        //     echo "<p>Thank you for your request, we will get back to you shortly</p>";
        // }
   ?>
    
    <h2>Contact Us</h2>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
    
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea><br>
    
        <input type="submit" value="Submit">
    </form>
    
    </body>
    </html>
    


