<?php

    function last_id() {

        return require_once("database.php");

    }

    function redirect($location) {

       return header("location: " . $location);

    }

?>