<?php

require_once("config/database.php");

$username_email = $_SESSION['signin_data']['username_email'] ?? null;
$password = $_SESSION['signin_data']['password'] ?? null;

unset($_SESSION["signin_data"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= SITE_URL; ?>assets/css/style.css">
  <title>Document</title>

  <style>

    .error {
      color: black;
      background-color: red;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      font-size: 18px;
      outline: 0;
      margin-top: 13px;
      margin-bottom: 0 !important;
      padding: 15px 0 15px 15px;
      text-align: left;
      width: 100%;
    }

    .success {
      color: white;
      background-color: green;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      font-size: 18px;
      outline: 0;
      margin-top: 13px;
      margin-bottom: 0 !important;
      padding: 15px 0 15px 15px;
      text-align: left;
      width: 100%;
    }

    .forget {
      float: right;
      margin: 6px 15px 10px 0;
    }

  </style>

</head>

<body>

  <form action="<?= SITE_URL ?>includes/signin_proccess.php" method="POST">

    <div class="container">

      <div class="brand-logo"></div>

      <div class="brand-title">Welcome Back</div>

      <?php

        if(isset($_SESSION['signin_error'])) :

      ?>

        <div class="error">
          <?= $_SESSION['signin_error']; ?>
        </div>

      <?php

        unset($_SESSION['signin_error']);
        endif;

      ?>

        <!-- success message -->
      <?php

        if(isset($_SESSION['success'])) :

      ?>

        <div class="success">
          <?= $_SESSION['success']; ?>
        </div>

      <?php

        unset($_SESSION['success']);
        endif;

      ?>

      <div class="inputs">

        <label>Email or username</label>

        <input type="text" value="<?= $username_email; ?>" name="username_email" placeholder="exa@gmail.com or Username" />

        <label>Password</label>

        <input type="password" value="<?= $password; ?>" name="password" placeholder="xxxxxxxxxx" />

        <a href="<?= SITE_URL; ?>reset_password.php" class="forget"><p>Forgotten Password</p></a>

        <button type="submit" name="signin">Sign In</button>

      </div>

      <div class="check"> Don`t have an account<a href="<?= SITE_URL; ?>signup.php"> Sign up</a> </div>

    </div>

  </form>

</body>

</html>