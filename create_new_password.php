<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Your Password</title>

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

  </style>

</head>

<body>

    <?php 
    
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(empty($selector) || empty($validator)) {

            require_once("config/database.php");
            $_SESSION["error_message"] = "Could not validate your request";
            redirect(SITE_URL . "reset_password.php");
            exit();
            
        } else {

            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator)) {

                ?>

                <form action="includes/reset_password.inc.php" method="POST">

                    <div class="container">

                        <div class="brand-title">Enter Your New Password</div>

                        <!-- if input is empty -->
                        <?php

                            if(isset($_GET['newpwd']) && $_GET["newpwd"] == "empty") :

                        ?>

                            <div class="error">
                                Please This Can`t Be Empty!.
                            </div>

                        <?php

                            endif;

                        ?>

                        <!-- if password don`t match -->
                        <?php

                            if(isset($_GET['newpwd']) && $_GET["newpwd"] == "pwddonotmatch") :

                        ?>

                            <div class="error">
                                Password Do Not Match, Please Check Your Input.
                            </div>

                        <?php

                            endif;

                        ?>

                        <!-- if there is an error while preparing the connection to database -->
                        <?php

                            if(isset($_GET['newpwd']) && $_GET["newpwd"] == "error") :

                        ?>

                            <div class="error">
                            There was an error while proccessing your request, Please contact the Admin.
                            </div>

                        <?php

                            endif;

                        ?>

                        <!-- if there is an error while preparing the connection to database -->
                        <?php

                            if(isset($_SESSION["error"])) :

                        ?>

                            <div class="error">
                                <?= $_SESSION["error"]; ?>
                            </div>

                        <?php

                            unset($_SESSION["error"]);
                            endif;

                        ?>

                        <div class="inputs">

                            <input type="hidden" name="selector" value="<?= $selector ?>">
                            <input type="hidden" name="validator" value="<?= $validator ?>">

                            <label>Password</label>

                            <input type="password" name="pwd" placeholder="Enter a new password..." />

                            <label>Re-Type Password </label>

                            <input type="password" name="pwd_repeat" placeholder="Repeat new password..." />

                            <button type="submit" name="reset_password_submit">Reset Password</button>

                        </div>

                    </div>

                </form>


                <?php

            }

        }
    
    ?>

</body>

</html>