<?php

    $connection = require_once('../config/database.php');

    global $conn;

    // ============================ LOGIN START HERE ===============================

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {

        $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        if(!$username_email) {

            $_SESSION['signin_error'] = "Username or Email Required";
            
        } elseif(!$password) {
            
            $_SESSION['signin_error'] = "Password Required";

        } else {

            $fetch_user_query = " SELECT * FROM users WHERE username=? OR email=? ";
            $stmt = $conn->prepare($fetch_user_query);
            $stmt->bind_param("ss", $username_email, $username_email);
            $stmt->execute();
            $count = $stmt;

            if($count == 1) {

                $result = $stmt->get_result();
                $user_record = $result->fetch_assoc();
                $db_password = $user_record['password'];

                if(password_verify($password, $db_password)) {

                    #Set session for user
                    $_SESSION['user_id'] = $user_record['id'];

                    #session message to be display
                    $_SESSION['signed_in'] = "Sign In Successfull.";

                    #redirect to homepage
                    header("location: " . SITE_URL);
                    die();

                } else {

                    $_SESSION['signin_error'] = " Please Check Your Input. ";

                }

            } else {

                $_SESSION['signin_error'] = " User Not Found. ";

            }

        }

        if($_SESSION['signin_error']) {

            $_SESSION['signin_data'] = $_POST;

            header("location: " . SITE_URL . "signin.php");
            die();

        }

    } else {

        header('location: ' . SITE_URL . 'signin.php');
        die();

    }

    // ============================ LOGIN ENDS HERE ================================




?>