<?php
	require_once("../includes/login_utils.php");

    session_start();
    if (!is_logged_in()) {
        to_login();
    }
?>