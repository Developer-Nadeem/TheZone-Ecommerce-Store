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

// Function to create a new user when signing up
function createUser($new_email, $new_password) {
    $conn = connectToDatabase();

    // Hash the password before storing it in the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Insert the data into the database using prepared statements
    $sql = "INSERT INTO users (Email, PasswordHash) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$new_email, $hashed_password])) {
        return true;
    } else {
        return false;
    }
}

$signupMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $new_email = $_POST['signupEmail'];
    $new_password = $_POST['signupPassword'];

    // Perform validation before creating a new user (e.g., check if email is unique)
    if (createUser($new_email, $new_password)) {
        $signupMessage = 'Account created successfully!';
    } else {
        $signupMessage = 'Error creating account.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone - Signup</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url('images/login_page_background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Style for the success message */
        .success-message {
            display: none;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
    </style>
</head>

<body>
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
            </div>
        </nav>
    </header>

    <main>
        <div class="page-container">
            <div class="login-container">
                <!-- Display success message if it exists -->
                <?php if (!empty($signupMessage)): ?>
                    <div class="success-message"><?= $signupMessage ?></div>
                <?php endif; ?>

                <form class="login-form" id="signupForm" action="signup.php" method="post">
                    <label for="signupEmail">Email:</label>
                    <input type="email" id="signupEmail" name="signupEmail" required>

                    <label for="signupPassword">Password:</label>
                    <div class="password-container">
                        <input type="password" id="signupPassword" name="signupPassword" required>
                        <span class="show-password" onclick="togglePassword()">Show</span>
                    </div>

                    <input type="submit" name="signup" value="Signup">
                    <p class="links"><a href="login.php">Already have an account? Login</a></p>
                </form>
            </div>
        </div>

        <script>
    function togglePassword() {
        const passwordInput = document.getElementById('signupPassword');
        const showPasswordSpan = document.querySelector('.show-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordSpan.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            showPasswordSpan.textContent = 'Show';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.querySelector('.success-message');

        if (successMessage.textContent.trim() !== '') {
            successMessage.style.display = 'block';

            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 3000);
        }
    });
</script>
    </main>
</body>

</html>
