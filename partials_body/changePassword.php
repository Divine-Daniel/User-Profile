    <div class="container my-5 bg-black text-white contain">

        <br>

        <?php

        if (isset($_SESSION["pswd"])) {

        ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert" style=" background-color:  #ff000086; border: none; color: rgb(221, 220, 220); ">
                <?php echo $_SESSION['pswd']; // Display message 
                ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php

            unset($_SESSION["pswd"]);
        }

        if (isset($_SESSION['pswd_success'])) :

        ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border: none; background-color: rgb(22, 175, 55); color: rgb(221, 220, 220); ">
                <?php echo $_SESSION['pswd_success']; // Display message 
                ?>.
                <button type="button" class="btn-close text-dark" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php

            unset($_SESSION['pswd_success']);

        endif;

        ?>

        <h2 class="mt-3">Change Password</h2>

        <form id="changePasswordForm" action="<?= SITE_URL; ?>includes/change_pwd_proccess.php" method="POST">


            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control" id="currentPassword" placeholder="xxxx xxxx xxxx">
            </div>


            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="xxxx xxxx xxxx">
            </div>


            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" name="comfirm_password" class="form-control" id="confirmPassword" placeholder="xxxx xxxx xxxx">
            </div>

            <input type="hidden" name="pswd_id" value="<?= $user_id; ?>">
            <button type="submit" name="change_password" class="btn btn-outline-primary me-3 mt-3 mb-2">Change Password</button>
            <a href="<?= SITE_URL; ?>" class="btn btn-secondary mt-3 mb-2">Back</a>
        </form>
    </div>