<?php

    # Database connection
    require("../config/database.php");

    // session_start();
    # Unset or Delete the user session
    session_unset();

    # Destroy the user session
    session_destroy();

    # Redirect the user to signin page
    header("location: " . SITE_URL . "signin.php" );

    # Die or Exist from the database connection process
    die();

