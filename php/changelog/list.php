<?php

require "../login/validate_session.php";
require_once("../includes/config.php");


//Render the page
//render_header('Changelog', false);
include "../includes/header.php";
//render_nav('Changelog');
    /**$out = '<h2 class="alert">Coming soon!</h2>';
    *echo $out;
    */

changeLogList();
include "../includes/footer.php";
//render_footer();

?>
