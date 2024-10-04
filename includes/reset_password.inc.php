<?php

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset_password_submit"])) {

        require_once("../config/database.php");
        // Process the result
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $pwd = filter_var($_POST["pwd"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pwd_repeat = filter_var($_POST["pwd_repeat"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(empty($pwd) || empty($pwd_repeat)) {

            require_once("../config/database.php");
            redirect(SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=empty");
            exit();

        } elseif($pwd !== $pwd_repeat) {

            redirect(SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=pwddonotmatch");
            $conn->close();
            exit();

        }

        $currentDate = date("U");

        $sql = " SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ? ;";
        // $stmt = $conn->init();
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {

            header("location:" . SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=error");
            exit();

        } else {

            mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            if(!$row) {

                $_SESSION["error"] = "You need to re-submit your reset request";
                header("location:" . SITE_URL . "create_new_password.php");
                exit();

            } else {

                $tokenBin = hex2bin($validator);
                $db_token = $row["pwdResetToken"];
                $tokenCheck = password_verify($tokenBin, $db_token);

                if($tokenCheck == false) {

                    $_SESSION["error"] = "You need to re-submit your reset request";
                    header("location:" . SITE_URL . "create_new_password.php");
                    exit();

                } elseif($tokenCheck == true) {

                    $tokenEmail = $row["pwdResetEmail"];

                    // run sqli statement
                    $sql2 = " SELECT * FROM users WHERE email = ? ;";
                    $stmt2 = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt2, $sql2)) {

                        header("location:" . SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=dberror");
                        exit();

                    } elseif(mysqli_stmt_prepare($stmt2, $sql2)) {

                        mysqli_stmt_bind_param($stmt2, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt2);

                        $result2 = mysqli_stmt_get_result($stmt2);

                        $row2 = mysqli_fetch_assoc($result2);

                        if(!$row2) {

                            $_SESSION["error"] = "There was an error!, while proccessing your request. Please Contact the Admin";
                            header("location:" . SITE_URL . "create_new_password.php");
                            exit();

                        } elseif ($row2 == true) {

                            $db_user_password = $row2["password"];

                            $sql3 = " UPDATE users SET password = ? WHERE email = ? ;";

                            $stmt3 = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt3, $sql3)) {

                                header("location:" . SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=dberror");
                                exit();

                            } elseif(mysqli_stmt_prepare($stmt3, $sql3) === true) {

                                $new_password_hashed = password_hash($pwd, PASSWORD_BCRYPT);

                                mysqli_stmt_bind_param($stmt3, "ss", $new_password_hashed, $tokenEmail);
                                mysqli_stmt_execute($stmt3);

                                $sql4 = " DELETE * FROM pwdreset WHERE pwdResetEmail = ? ;";
                                $stmt4 = mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt4, $sql4)) {

                                    header("location:" . SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=dberror");
                                    exit();

                                } elseif(mysqli_stmt_prepare($stmt4, $sql4) == true) {

                                    mysqli_stmt_bind_param($stmt4, "s", $tokenEmail);
                                    $res4 = mysqli_stmt_execute($stmt4);

                                    if($res4 == true) {

                                        $_SESSION["success"] = "Your Password Has Been Reset";
                                        header("location:" . SITE_URL . "signin.php");
                                        exit();

                                    } else {

                                        header("location:" . SITE_URL . "create_new_password.php?selector=". $selector . "&validator=" . $validator . "&newpwd=dberror");
                                        exit();

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    } else {

        // Redirect the the person to the homepage or index.php
        require_once("../config/database.php");
        redirect(SITE_URL . "signin.php");
        exit();

    }