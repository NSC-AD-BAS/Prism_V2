<?php
	require_once("../includes/config.php");

    session_start();
    if (!is_logged_in()) {
        to_login();
    }
?>