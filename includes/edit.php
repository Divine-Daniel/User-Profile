<?php


    require_once("../config/database.php");
    global $conn;

    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit_user"])) {

        $user_id = filter_var($_POST["user_id"], FILTER_SANITIZE_NUMBER_INT);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_SPECIAL_CHARS);
        $old_image = $_POST["old_image"];

        // validate the inputs

        if(!$username) {

            $_SESSION["update"] = " Username is required ";

        } elseif(!$email) {

            $_SESSION["update"] = " Email is required ";

        } elseif(!$phone) {

            $_SESSION["update"] = " Phone number is required ";

        } else {

            if(isset($_FILES["new_image"]["name"])) {

                $image_name = $_FILES["new_image"]["name"];

                if($image_name != "") {

                    $rename = "user_image_" . rand(000, 999);
                    $ext_1 = explode(".", $image_name);
                    $ext = end($ext_1);
                    $array = ["jpg", "png", "jpg", "gif"];
                    $image_name = $rename.".".$ext;

                    if(in_array($ext, $array)) {

                        if($_FILES["new_image"]["size"] > 1200000) {

                            $_SESSION["update"] = " Image should not be more than 1mb ";

                        } else {

                            $src_path = $_FILES["new_image"]["tmp_name"];
                            $dest_path = "../uploads/".$image_name;
                            
                            $upload = move_uploaded_file($src_path, $dest_path);

                            if($upload == false) {

                                $_SESSION["update"] = " Failed To Upload Image ";

                            }

                            if($old_image != "") {

                                $remove_path = "../uploads/".$old_image;
                                $remove = unlink($remove_path);

                                if($remove == false) {

                                    $_SESSION["update"] = " Failed To Remove Image ";

                                }

                            }

                        }

                    } else {

                        $_SESSION["update"] = " Image should be JPG, PNG, JPEG, or GIF ";

                    }

                } else {

                    $image_name = $old_image;

                }

            } else {

                $image_name = $old_image;

            }

        }


        if($_SESSION["update"]) {

            redirect(SITE_URL . "edit_profile.php");
            exit();

        } else {

            $sql = " UPDATE users SET 
            username = ?,
            email = ?,
            phone = ?,
            image = ? WHERE id = ?
            ;";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $email, $phone, $image_name, $user_id);
            $result = $stmt->execute();

            if($result == true) {

                $_SESSION["update_success"] = " Profile Updated Successfully ";
                redirect(SITE_URL . "edit_profile.php");
                exit();

            } else {

                $_SESSION["update"] = " Fialed To Update Profile ";
                redirect(SITE_URL . "edit_profile.php");
                exit();

            }

        }

    } else {

        redirect(SITE_URL . "edit_profile.php");
        exit();

    }


?>