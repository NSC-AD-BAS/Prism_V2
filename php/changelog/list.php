<?php

require "includes/functions_inc.php";

//Includes
include "../render/page_builder.php";
include "../render/render_company.php";
include "../db/query_db.php";
include_once("../login/login_utils.php");

# Session management
session_start();
if (!is_logged_in()) {
    to_login();
}

//Render the page
render_header('Changelog', false);
render_nav('Changelog');
    /**$out = '<h2 class="alert">Coming soon!</h2>';
    *echo $out;
    */

changeLogList();

render_footer();

?>
