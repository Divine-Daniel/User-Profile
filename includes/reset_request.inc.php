<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset_request_submit"])) {
        
        require_once("../config/database.php");

        $selector = bin2hex(random_bytes(10));
        $token = random_bytes(36);
        
        $url = SITE_URL . "create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token) ;
        
        $expries = date("U") + 1800;

        $userEmail = filter_input(INPUT_POST, "userEmail", FILTER_SANITIZE_EMAIL);

        if(!filter_input(INPUT_POST, "userEmail", FILTER_VALIDATE_EMAIL)) {

            $_SESSION["invalid_email"] = "Please Input A Valide Email Address.";
            $_SESSION["keep_input"] = $_POST;
            redirect(SITE_URL . "reset_password.php");
            exit();

        }

        $sql = "DELETE FROM pwdreset WHERE pwdResetEmail = ? ;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION["error_message"] = "There was an error while proccessing your request";
            $_SESSION["keep_input"] = $_POST;
            redirect(SITE_URL . "reset_password.php");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);

        }

        $sql2 = " INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUE(?, ?, ?, ?) ;";
        $stmt2 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt2, $sql2)) {

            $_SESSION["error_message"] = "There was an error while proccessing your request";
            redirect(SITE_URL . "reset_password.php");
            exit();

        } else {

            $hashedToken = password_hash($token, PASSWORD_BCRYPT);
            mysqli_stmt_bind_param($stmt2, "ssss", $userEmail, $selector, $hashedToken, $expries);
            mysqli_stmt_execute($stmt2);

        }

        // $stmt2->close();
        // mysqli_stmt_close($stmt2);
        // mysqli_close();

        $to = $userEmail;
        $subject = "Reset Your Password From Skudriod Company";

        $message = '<p>We recieved a password reset request. The link to reset your password is below. If you do not make this request, You can ignore this email</p>';
        $message .= '<p>Here is your password reset link: </br>';
        $message .= '<a href="' . $url . '"> ' . $url . ' </a> </p>';

        $headers = "From: SkudriodCompany <glord23456@gmail.com>\r\n";
        $headers .= "Reply-To: glord23456@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        $mailSuccess = mail($to, $subject, $message, $headers);

        if($mailSuccess == true) {

            redirect(SITE_URL . "reset_password.php?reset_password=success");
            exit();
            
        } elseif($mailSuccess == false) {

            $_SESSION["error_message"] = "There was a problem while sending the email to you";
            $_SESSION["keep_input"] = $_POST;
            redirect(SITE_URL . "reset_password.php");
            exit();

        }

    } else {

        require_once("../config/database.php");
        redirect(SITE_URL . "signin.php");
        die();

    }