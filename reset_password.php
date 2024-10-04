<?php 

require_once("config/database.php");

$userEmail = $_SESSION["keep_input"]["userEmail"] ?? null;

unset($_SESSION["keep_input"]);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgotten Password</title>

  <style>

    * {
      scrollbar-width: thin !important;
      scrollbar-color: #15172b black;
    }

    body {
      align-items: center;
      background-color: #000;
      display: flex;
      justify-content: center;
      height: 100vh;
    }

    .form {
      background-color: #15172b;
      border-radius: 20px;
      /* box-sizing: border-box; */
      min-height: 350px;
      padding: 20px;
      width: 100%;
      margin: 50px 0 !important;
    }

    .title {
      color: #eee;
      font-family: sans-serif;
      font-size: 36px;
      font-weight: 600;
      margin-top: 20px;
      text-align: center;
    }
    
    .subtitle {
      color: #eee;
      font-family: sans-serif;
      font-size: 16px;
      font-weight: 600;
      margin-top: 20px;
      text-align: center;
    }

    .input-container {
      height: 50px;
      position: relative;
      width: 100%;
    }

    .ic1 {
      margin-top: 40px;
    }

    .ic2 {
      margin-top: 30px;
    }

    .input {
      background-color: #303245;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      color: #eee;
      font-size: 18px;
      height: 100%;
      outline: 0;
      padding: 4px 20px 0;
      width: 100%;
    }

    .profile {
      background-color: #303245;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      color: #eee;
      font-size: 18px;
      height: 100%;
      outline: 0;
      padding-top: 18px;
      padding-bottom: 40px;
      width: 100%;
      cursor: pointer;
    }

    .cut {
      background-color: #15172b;
      border-radius: 10px;
      height: 20px;
      left: 20px;
      position: absolute;
      top: -20px;
      transform: translateY(0);
      transition: transform 200ms;
      width: 76px;
    }

    .cut-short {
      width: 50px;
    }

    .input:focus~.cut,
    .input:not(:placeholder-shown)~.cut {
      transform: translateY(8px);
    }

    .placeholder {
      color: #65657b;
      font-family: sans-serif;
      left: 20px;
      line-height: 14px;
      pointer-events: none;
      position: absolute;
      transform-origin: 0 50%;
      transition: transform 200ms, color 200ms;
      top: 20px;
    }

    .input:focus~.placeholder,
    .input:not(:placeholder-shown)~.placeholder {
      transform: translateY(-30px) translateX(10px) scale(0.75);
    }

    .input:not(:placeholder-shown)~.placeholder {
      color: #808097;
    }

    .input:focus~.placeholder {
      color: #dc2f55;
    }

    .submit {
      background-color: #08d;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      color: #eee;
      cursor: pointer;
      font-size: 18px;
      height: 50px;
      margin-top: 28px;
      margin-bottom: 30px;
      outline: 0;
      text-align: center;
      width: 100%;
    }

    .submit:active {
      background-color: #06b;
    }

    .error {
      color: red;
      box-sizing: border-box;
      font-size: 18px;
      padding: 15px 10px 0px 18px;
      width: 100%;
    }

    .already {
      text-align: center;
      color: white;
      margin-bottom: 15px;
      font-size: 18px;
    }

    .already a {
      color: gray;
      text-decoration: none;
    }

    .err {
      background-color: red;
      color: white;
      padding: 20px;
      margin-top: 25px;
      margin-bottom: 0;
      border: none;
      border-radius: 5px;
    }

    .success {
      background-color: green;
      color: white;
      padding: 20px;
      margin-top: 25px;
      margin-bottom: 0;
      border: none;
      border-radius: 5px;
    }

  </style>

</head>

<body>

  <form action="<?= SITE_URL; ?>includes/reset_request.inc.php" method="POST">

    <div class="form">

      <div class="title">Enter Your Email</div>

      <div class="subtitle">An Email Will Be Sent To you To Reset Your Password</div>

      <!-- Error Message -->
      <?php

        if(isset($_SESSION["error_message"])) :

      ?>

        <div class="err">
          <?= $_SESSION["error_message"]; ?>
        </div>

      <?php

        unset($_SESSION["error_message"]);
        endif;

      ?>


      <!-- Success Message -->
      <?php

        if(isset($_GET["reset_password"]) && $_GET["reset_password"] == "success") :

      ?>

        <div class="success">
          Please Check Your E-mail Address
        </div>

      <?php

        unset($_GET['success']);
        endif;

      ?>

      <div class="input-container ic2">

        <input id="lastname" class="input" type="email" name="userEmail" value="<?= $userEmail; ?>" placeholder=" "/>

        <div class="cut"></div>

        <label for="lastname" class="placeholder">Enter Email</label>

      </div>

      <?php 
      
        if(isset($_SESSION["invalid_email"])) :

      ?>

        <div class="error">

          <?= $_SESSION["invalid_email"]; ?>
            
        </div>

      <?php

        unset($_SESSION["invalid_email"]);
        endif;

      ?>

      
      <button type="text" class="submit" name="reset_request_submit">Recover</button>

      <div style="margin-bottom: 20px; margin-top: 10px;">
        <a href="<?= SITE_URL ?>signin.php" style="padding: 12px 28px; border-radius: 8px; background-color: #dc2f55; color: white; text-decoration: none; margin-bottom: 20px; font-size: 20px; font-weight: 600; letter-spacing: 1.5px;">Back </a>
      </div>

    </div>

  </form>

</body>

</html>