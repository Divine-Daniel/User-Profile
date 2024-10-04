<?php

 if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    require_once("../config/database.php");
    
    $useremail = filter_input(INPUT_POST, "useremail", FILTER_SANITIZE_EMAIL);

    if(!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {

        $_SESSION["invalid_email"] = "Please Enter Valid Email Address";
        
    } else {
        
        $sql = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $sql->bind_param("s", $useremail);
        $res = $sql->execute();
        
        if($res == false) {
            
            $_SESSION["forgot_err"] = "Oops Sorry something went Wrong, Try Again Later";
            // redirect(SITE_URL . "forgotten_pswd.php");
            // die();

        } else {

            $res = $sql->get_result();

            $count = $res->num_rows;

            if($count == 1) {

                // procced
                $row = $res->fetch_object();
                $db_email = $row->email; 

                if($db_email === $useremail) {

                    // proccess the information
                    $code =  uniqid().rand(00000000000, 9999999999);
                    $otp = rand(777777, 999999);
                    $date = date("Y-m-d h:i:s");

                    $sql2 = $conn->prepare("INSERT INTO code ( email, code, otp, date ) VALUES(?, ?, ?, ?)");
                    $sql2->bind_param("ssss", $useremail, $code, $otp, $date);
                    $res2 = $sql2->execute();

                    if($res2 == false) {

                        $_SESSION["forgot_err"] = "Oops sorry something went wrong, Please contact the admin";
                        redirect(SITE_URL . "forgotten_pswd.php");
                        die();

                    } else {

                        $sql3 = $conn->prepare("SELECT code, otp FROM code WHERE email = ?");
                        $sql3->bind_param("s", $useremail);
                        $res3 = $sql3->execute();
                        $get_res = $sql3->get_result();
                        $row3 = $get_res->fetch_object();
                        $random = $row3->otp;
                        $url = $row3->code;

                        $to = $useremail;
                        $from = "skudriodCompany@gmail.com";
                        $subject = "We`ve Send OTP code to You";
                        $message = "Please Copy this code sot that you can change your password";
                        $message .= $random;
                        $message .= "Please Click on this URL to change your password";
                        $message .= "<a href='SITE_URL .get_otp.php?code=.$url'> SITE_URL .get_otp.php?code=.$url </a>";
                        $message .= "This code will expire In the next fifteen minutes";

                        $email_check = mail($to, $subject, $message, $from);

                        if($email_check == false) {

                            $_SESSION["forgot_err"] = "Oops somthing went wrong while sending the code Please, Try again Letter";
                            redirect(SITE_URL . "forgotten_pswd.php");
                            die();

                        } else {

                            $_SESSION["check_email"] = "Please check your email";
                            redirect(SITE_URL . "forgot_success.php");
                            die();

                        }

                    }

                } else {

                    $_SESSION["forgot_err"] = "Please Check Your Input";
                    // redirect(SITE_URL . "forgotten_pswd.php");
                    // die();

                }

            } else {

                $_SESSION["forgot_err"] = "Email Not Found";
                // redirect(SITE_URL . "forgotten_pswd.php");
                // die();

            }

        }

    }

    if(isset($_SESSION["invalid_email"])) {

        $_SESSION["invalid_email_check"] = $_POST;

        redirect(SITE_URL . "forgotten_pswd.php");
        die();

    }

    if(isset($_SESSION["forgot_err"])) {

        $_SESSION["invalid_email_check"] = $_POST;

        redirect(SITE_URL . "forgotten_pswd.php");
        die();

    }

 } else {

    require_once("../config/database.php");
    redirect(SITE_URL . "forgotten_pswd.php");
    die("Error Proccess Creditential" . mysqli_errno($conn) . $conn->connect_error);

 }

 $conn->close();