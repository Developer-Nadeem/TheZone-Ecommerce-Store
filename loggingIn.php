<?php
    // Establish a database connection (replace these values with your actual database credentials)
    // to be added later on once the database and tables have been created
    $servername = "server_name";
    $username = "username";
    $password = "password";
    $dbname = "db_name";

    $db = new mysqli($servername, $username, $password, $dbname);

    // Checking if the connection is established with the database
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Santizingg user input (to avoid Cross-Site Scripting)
    function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retreiving data using POST
        $email = sanitizeInput($_POST["email"]);
        $password = sanitizeInput($_POST["password"]);

        // SQL query to retreive user data
        $stmt = $db->prepare("SELECT UserID, Email, Pass FROM User_table WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with the given email exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userID, $dbEmail, $dbPassword);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $dbPassword)) {
                // Session is started given the the password matches
                session_start();

                // Store user information in the session
                $_SESSION["userID"] = $userID;
                $_SESSION["email"] = $dbEmail;

                // Redirect to a page upon successful login
                header("Location: index.php");
                exit();
            } else {
                // Password is incorrect
                $_SESSION["error_message"] = "Invalid password";
                header("Location: login.php");
                exit();
            }
        } else {
            // The given email does not exist in the table
            $_SESSION["error_message"] = "User not found";
            header("Location: login.php");
            exit();
        }

        // Close the database connection
        $stmt->close();
        $db->close();
    }
?>
