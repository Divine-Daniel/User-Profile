<?php 

require_once("config/database.php");
require_once("check.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>

    * {
      scrollbar-width: thin !important;
      scrollbar-color: #15172b black !important;
    }

    body {
      align-items: center;
      background-color: #000;
      display: flex;
      justify-content: center;
      /* height: 100vh; */
    }

    .form {
      background-color: #15172b;
      border-radius: 20px;
      /* box-sizing: border-box; */
      min-height: 500px;
      padding: 20px;
      width: 400px;
      margin: 50px 0 !important;
    }

    .title {
      color: #eee;
      font-family: sans-serif;
      font-size: 36px;
      font-weight: 600;
      margin-top: 30px;
      text-align: center;
    }
    
    .subtitle {
      color: #eee;
      font-family: sans-serif;
      font-size: 16px;
      font-weight: 600;
      margin-top: 10px;
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
      margin-top: 38px;
      margin-bottom: 30px;
      outline: 0;
      text-align: center;
      width: 100%;
    }

    .submit:active {
      background-color: #06b;
    }

    .error {
      color: black;
      background-color: red;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      font-size: 18px;
      height: 100%;
      outline: 0;
      padding: 20px 10px 20px 28px;
      margin-top: 25px;
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

  </style>

</head>

<body>

  <form action="<?= SITE_URL; ?>includes/register_proccess.php" method="POST" enctype="multipart/form-data">

    <div class="form">

      <div class="title">Welcome</div>

      <div class="subtitle">Let's create your account!</div>

      <?php

        if(isset($_SESSION["signup"])) :
         
      ?>

        <div class="error">
          <?= $_SESSION["signup"]; ?>
        </div>

      <?php 

        unset($_SESSION["signup"]);
        endif;

      ?>

      <div class="input-container ic2">

        <input id="lastname" class="input" type="text" name="username" value="<?= $username; ?>" placeholder=" "/>

        <div class="cut"></div>

        <label for="lastname" class="placeholder">Username</label>

      </div>


      <div class="input-container ic2">

        <input id="email" class="input" type="text" name="email" value="<?= $email; ?>" placeholder=" " />

        <div class="cut cut-short"></div>
        
        <label for="email" class="placeholder">Email</>

      </div>


      <div class="input-container ic2">

        <input id="phone" class="input" type="tel" name="phone" value="<?= $phone; ?>" placeholder=" " />

        <div class="cut cut-short"></div>
        
        <label for="phone" class="placeholder">Phone No</>

      </div>


      <div class="input-container ic2">

        <input id="pwd" class="input" type="password" name="pwd" value="<?= $pwd; ?>" placeholder=" " />

        <div class="cut"></div>

        <label for="pwd" class="placeholder">Password</>

      </div>


      <div class="input-container ic2" style="margin-bottom: 8%;">

        <input id="cpwd" class="input" type="password" name="cpwd" value="<?= $cpwd; ?>" placeholder=" " />

        <div class="cut"></div>

        <label for="cpwd" class="placeholder">Confirm</>

      </div>
      

      <div class="input-container ic2">

        <input type="file" name="pp" id="file" class="input profile" value="<?= $pp; ?>"/>
        
      </div>

      <button type="text" class="submit" name="submit">Submit</button>

      <div class="already">Already have an account <a href="<?= SITE_URL ?>signin.php"> Sign in</a></div>

    </div>

  </form>

</body>

</html>