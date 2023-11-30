<?php
function connectToDatabase() {
    try {
        $dbname = 'thezonedb'; 
        $dbhost = 'localhost';
        $username = 'root';
        $password = '';
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (Exception $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}

// Function to check the login details making sure they are correct
function validateLogin($entered_email, $entered_password) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$entered_email]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_password = $row['PasswordHash'];

        if (password_verify($entered_password, $stored_password)) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $entered_email = $_POST['email'];
        $entered_password = $_POST['password'];

        if (validateLogin($entered_email, $entered_password)) {
            echo 'Login successful!';
        } else {
            echo 'Invalid email or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      
    body {
    background-image: url('images/login_page_background.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

.header-container {
    position: absolute;
    top: 0;
    width: 100%; /* this makes sure the header reaches the entire width */
}

.wrapper {
    overflow: hidden;
    max-width: 390px;
    background: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
    margin-top: 20px;
}   
    </style>
</head>

<body>
<!--Navbar Start-->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img class="img-fluid logo" src="../TheZone/images/logo-tp.png"
                        alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">Login</a>
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

    <main>
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">Login/Signup</div>
                <div class="title signup">Signup Form</div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login">Login</label>
                    <label for="signup" class="slide signup">Signup</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form action="#" class="login">
                        <div class="field">
                            <input type="text" placeholder="Email Address" required>
                        </div>
                        <div class="field">
                            <input type="password" placeholder="Password" required>
                        </div>
                        <div class="pass-link"><a href="#">Forgot password?</a></div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login" name="login">
                        </div>
                        <div class="signup-link">Dont have an account? <a href="">Signup now</a></div>
                    </form>
                    <form action="#" class="signup">
                        <div class="field">
                            <input type="text" placeholder="Email Address" required>
                        </div>
                        <div class="field">
                            <input type="password" placeholder="Password" required>
                        </div>
                        <div class="field">
                            <input type="password" placeholder="Confirm password" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Signup" name="signup">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (()=>{
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (()=>{
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (()=>{
            signupBtn.click();
            return false;
        });
    </script>
</main>