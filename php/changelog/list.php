<?php

require "../login/validate_session.php";
require "includes/functions_inc.php";

//Includes
include "../render/page_builder.php";
include "../render/render_company.php";
include "../db/query_db.php";


//Render the page
render_header('Changelog', false);
render_nav('Changelog');
    /**$out = '<h2 class="alert">Coming soon!</h2>';
    *echo $out;
    */

$listContent = changeLogList();

?>

<ul class="outer">
    <li class="tableHead">
        <ul class="inner">
            <li>Name</li>
            <li>Date/Time</li>
            <li>Event</li>
        </ul>
    </li>
    <?=$listContent?>
</ul>

<?php render_footer(); ?>