<?php

    require_once("config/database.php");
    global $conn;

    if($_SESSION['user_id']) {

        $_SESSION['user_id'];
        $user_id = $_SESSION['user_id'];

        $sql = " SELECT * FROM users WHERE id=? ;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $result = $stmt->execute();

        if($result == true) {

            // user exist
            $check = $stmt->get_result();
            $rows = $check->fetch_assoc();

            $id = $rows['id'];
            $username = $rows['username'];
            $email = $rows['email'];
            $phone = $rows['phone'];
            $image = $rows['image'];
            
        }

    } else {

        redirect(SITE_URL . "signin.php");;
        exit();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            scrollbar-width: thin !important;
            scrollbar-color: coral black !important;
        }
        body {
            background-color: black;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>

</head>
<body>