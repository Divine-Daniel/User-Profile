<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

        require_once("../config/database.php");
        $userEmail = filter_input(INPUT_POST, "useremail", FILTER_SANITIZE_EMAIL);

        if(empty($userEmail)) {

            $_SESSION["invalid_email"] = "Please Email can be empty";
            $_SESSION["invalid_email_check"] = $_POST;
            redirect(SITE_URL . "signin.php");
            exit();


        } elseif(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {

            $_SESSION["invalid_email"] = "Please Input valid email";
            $_SESSION["invalid_email_check"] = $_POST;
            redirect(SITE_URL . "signin.php");
            exit();


        } else {

            $sql = "SELECT email FROM users WHERE email = ? ;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $userEmail);
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res->fetch_assoc();

            if($row != 1) {

                $_SESSION["forgot_err"] = "Email Does Not Exist";
                $_SESSION["invalid_email_check"] = $_POST;
                redirect(SITE_URL . "signin.php");
                exit();

            } elseif($row == 1) {

                // $date = NOW();
                $code = uniqid(true);
                $sql2 = "INSERT INTO passwordReset (code, email, data) VALUES(?, ?, ?) ";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("sss", $code, $userEmail, $date);
                $execute2 = $stmt2->execute();

                if($execute2 == false) {

                    $_SESSION["forgot_err"] = "Error Ocurred";
                    $_SESSION["invalid_email_check"] = $_POST;
                    redirect(SITE_URL . "signin.php");
                    exit();

                } elseif($execute2 == true) {

                    require_once("forgot_mailer.php");

                }

            }

        }

    } else {

        require_once("../config/database.php");
        redirect(SITE_URL . "signin.php");
        exit();

    }