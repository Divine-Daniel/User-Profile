
    <div class="container my-5 bg-black text-white contain">

        <br>

        <?php

            if(isset($_SESSION["update"])) {

                ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style=" background-color:  #ff000086; border: none; color: rgb(221, 220, 220); ">
                        <?php echo $_SESSION['update']; // Display message ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php

                unset($_SESSION["update"]);

            }

            if(isset($_SESSION['update_success'])) :

            ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border: none; background-color: rgb(22, 175, 55); color: rgb(221, 220, 220); ">
                    <?php echo $_SESSION['update_success']; // Display message ?>.
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php

            unset($_SESSION['update_success']);

            endif;

        ?>

        <h2 class="mt-3">Edit Profile</h2>
        <form id="editProfileForm" action="<?= SITE_URL; ?>includes/edit.php" enctype="multipart/form-data" method="POST">
            

            <div class="mb-5">
                <label class="form-label d-block mt-5 mb-4">Current Image</label>
                <img src="<?= SITE_URL ?>uploads/<?= $image; ?>" alt="profile image" style="border-radius: 50%; width: 150px; height: 150px;">
            </div>


            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="name" value="<?= $username; ?>" placeholder="John Doe">
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= $email; ?>" placeholder="john.doe@example.com">
            </div>


            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" class="form-control" id="phone" value="<?= $phone; ?>" placeholder="+1 234 567 8900">
            </div>


            <div class="mb-3">
                <label for="new_image" class="form-label">Select Image</label>
                <input type="file" name="new_image" class="form-control" id="new_image">
            </div>

            <input type="hidden" name="old_image" value="<?= $image; ?>">
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <button type="submit" name="edit_user" class="btn btn-primary me-3 mt-3 mb-2">Save Changes</button>
            <a href="<?= SITE_URL; ?>" class="btn btn-outline-secondary mt-3 mb-2">Back</a>
        </form>
    </div>
