    <!-- this php file is to be used to access the database and reset the password of the user -->
    <!-- this file takes data from the reset password form in resetpass.php -->

    <?php
    session_start();

    // Check if the form is submitted
    if (isset($_POST['submitted'])) {
        require("connectiondb.php");

        // Retrieve user input from the form
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['invalidEmail'] = "Please enter a valid email address.";
            header("Location: forgot-password-page.php");
            exit;
        }

        //Checks if the email entered has been registered into the database
        $checkEmail = $db->prepare("SELECT Email FROM useraccounts WHERE Email = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();
        $emailExists = $checkEmail->fetchColumn();

        if (!$emailExists) {
            $_SESSION['emailNoExist']="The email has not been registered";
            header("Location: forgot-password-page.php");
            exit;
        }

        if($emailExists){
            $_SESSION['success'] = "A link to reset password has been sent to the email address";
            header("Location: forgot-password-page.php");
            exit;
        }

    }

    ?>