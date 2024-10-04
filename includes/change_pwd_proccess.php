<?php

    require_once("../config/database.php");
    global $conn;

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change_password"])) {

        $pswd_id = filter_var($_POST["pswd_id"], FILTER_SANITIZE_NUMBER_INT);
        $current_pswd = filter_var($_POST["current_password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $new_pswd = filter_var($_POST["new_password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $comfirm_pswd = filter_var($_POST["comfirm_password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // validate inputs
        if(!$current_pswd) {

            $_SESSION["pswd"] = "Current Password Is Required";
            redirect(SITE_URL . "change_password.php");
            die();

        } elseif(!$new_pswd) {

            $_SESSION["pswd"] = "New Password Is Required";
            redirect(SITE_URL . "change_password.php");
            die();

        } elseif(!$comfirm_pswd) {

            $_SESSION["pswd"] = "Confirm Password Is Required";
            redirect(SITE_URL . "change_password.php");
            die();

        } else {

            if($new_pswd != $comfirm_pswd) {

                $_SESSION["pswd"] = "Password Don`t Match";
                redirect(SITE_URL . "change_password.php");
                die();

            } else {

                $sql = " SELECT * FROM users WHERE id = ? ;";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $pswd_id);
                $count = $stmt->execute();
                

                if($count == 1) {

                    $result = $stmt->get_result();
                    $user_db_pwd = $result->fetch_assoc();

                    if(password_verify($current_pswd, $user_db_pwd["password"]) == true) {

                        $hash_password = password_hash($new_pswd, PASSWORD_BCRYPT);
                        $sql2 = " UPDATE users SET password = ? WHERE id = ? ;";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bind_param("ss", $hash_password, $pswd_id);
                        $result2 = $stmt2->execute();

                        if ($result2 == true) {
                            
                            $_SESSION["pswd_success"] = "Password Updated Successfully.";
                            redirect(SITE_URL . "change_password.php");
                            die();

                        }


                    } else {

                        $_SESSION["pswd"] = "Incorrect Password";
                        redirect(SITE_URL . "change_password.php");
                        die();

                    }

                } else {

                    $_SESSION["pswd"] = "User Does Not Exist";
                    redirect(SITE_URL . "change_password.php");
                    die();

                }

            }

        }

    } else {

        redirect(SITE_URL);
        die();

    }

?>