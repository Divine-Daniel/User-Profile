

<!-- ================================================ Sign Up Starts Here ============================================ -->

<?php

$connection = require_once('../config/database.php');

global $conn;

// ============================ SIGNUP BEGINS HERE ================================

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS);
    $cpwd = filter_var($_POST['cpwd'], FILTER_SANITIZE_SPECIAL_CHARS);
    $pp = $_FILES['pp'];


    // validate input values

    if(!$username) {

        $_SESSION["signup"] = " Please Enter Your Username ";

    } elseif (!$email) {

        $_SESSION["signup"] = " Please Enter Your Email ";

    }  elseif (!$phone) {

        $_SESSION["signup"] = " Please Enter Your Phone Number ";

    } elseif (!$pwd) {

        $_SESSION["signup"] = " Please Enter Your Password ";

    } elseif (!$cpwd) {

        $_SESSION["signup"] = " Please Re_Type Your Confirm Password ";

    } elseif (!$pp) {

        $_SESSION["signup"] = " Please Select Your Profile ";

    } elseif (strlen($pwd) < 8 || strlen($cpwd) < 8) {

        $_SESSION["signup"] = " Please Password Should Be Eight Plus (8+) Characters ";

    } else {

        if($pwd !== $cpwd) {

            $_SESSION["signup"] = " Password Don`t Match ";

        } else {

            $hash_password = password_hash($pwd, PASSWORD_BCRYPT);

            // check if the username orthe email already exist in the database 
            $user_check_query = " SELECT * FROM users WHERE username = '$username' OR email = '$email' ";
            $user_check_result = $conn->query($user_check_query);

            $count = mysqli_num_rows($user_check_result);

            if($count > 0) {

                $_SESSION["signup"] = " Username or Email Already Exist ";

            } else {

                $rename_image = 'user_image_'.rand(000, 999);
                $image_tmp_name = $pp['tmp_name'];
                $allowed_files = ['png', 'jpg', 'jpeg', 'gif'];
                $extension1 = explode('.', $pp['name']);
                $extension = end($extension1);
                $image_name = $rename_image.'.'.$extension;
                $image_destination = '../uploads/'.$image_name;


                if(in_array($extension, $allowed_files)) {

                    // make sure image is not too large (1mb+)

                    if($pp['size'] < 2000000) {

                        // Upload the image
                        move_uploaded_file($image_tmp_name, $image_destination);

                    } else {

                        $_SESSION["signup"] = " Image size is too big, Should be less than 1 mb ";

                    }

                } else {

                    $_SESSION["signup"] = " Image should be png, jpg, jpeg or gif ";

                }

            }

        }

    }

    if($_SESSION['signup']) {

        $_SESSION['signup_data'] = $_POST;
        
        header("location: " . SITE_URL . "signup.php");
        die();

    } else {

        // insert new user in users table

        $sql = " INSERT INTO users (username, email, phone, image, password) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $phone, $image_name, $hash_password);
        $stmt->execute();

        if($stmt == true) {

            $_SESSION['success'] = "Registration Successful, Please Sign in";

            #Redirect to login page
            header("location: " . SITE_URL . "signin.php");
            die();

        } else {

            $_SESSION['signup'] = "Failed to Register";

            // header("location: " . SITE_URL . "signup.php");
            die();

        }

    }
    

} else {

    // Bounce back to signup page

    header("location: " . SITE_URL . "signup.php");
    die();

}

// ============================ SIGNUP ENDS HERE ===============================

?>
