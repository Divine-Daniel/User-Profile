
<div class="container mt-5">
    
    <div class="row">
        
        <div class="col-md-6 m-auto my-5">

            <div class="card bg-dark w-75">

                <img class="card-img-top mx-auto mt-3" src="<?= SITE_URL; ?>uploads/<?= $image; ?>" alt="Profile pic" style="border-radius: 50%; width: 90%; height: 23em;"/>

                <div class="card-body bg-dark ms-2">

                    <h5 class="card-title text-white mt-3" style="color: coral !important;"><span class="text-black">Username:</span> <?= $username; ?></h5>
                    <h5 class="card-title text-white my-3" style="color: coral !important;"><span class="text-black">Email:</span>  <?= $email; ?></h5>
                    <h5 class="card-title text-white" style="color: coral !important;"><span class="text-black">Phone:</span>  <?= $phone; ?></h5>
                    <!-- <p class="card-text">Software Developer</p> -->
                </div>
                <!-- <ul class="list-group list-group-flush bg-dark"> -->
                    <!-- <li class="list-group-item bg-dark text-white"></li> -->
                    <!-- <li class="list-group-item bg-dark text-white"></li> -->
                    <!-- <li class="list-group-item">Phone: +1 234 567 8900</li> -->
                    <!-- <li class="list-group-item">Location: New York, USA</li> -->
                <!-- </ul> -->
                <div class="card-body bg-dark ms-2 mb-3">
                    <a href="<?= SITE_URL; ?>change_password.php?user_id=<?= $user_id ?>" class="card-link btn btn-secondary">Change Password</a>
                    <a href="<?= SITE_URL; ?>edit_profile.php?user_id=<?= $user_id ?>" class="card-link btn btn-outline-primary">Edit Profile</a>
                    <a href="<?= SITE_URL; ?>includes/logout.php" class="card-link btn btn-outline-danger float-end position-absolute">Log Out</a>
                </div>
            </div>
        </div>

    </div>
</div>