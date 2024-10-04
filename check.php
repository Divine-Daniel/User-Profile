<?php

$username = $_SESSION["signup_data"]["username"] ?? null;
$email = $_SESSION["signup_data"]["email"] ?? null;
$phone = $_SESSION["signup_data"]["phone"] ?? null;
$pwd = $_SESSION["signup_data"]["pwd"] ?? null;
$cpwd = $_SESSION["signup_data"]["cpwd"] ?? null;
$pp = $_SESSION["signup_data"]["pp"] ?? null;

unset($_SESSION["signup_data"]);

?>