<?php

require_once("connection.php");

session_start();

require_once("function.php");

$conn = mysqli_connect( $server, $username, $password, $database);

if ($conn->connect_error) {
    die("connection Error" . $conn->connect_error);
}