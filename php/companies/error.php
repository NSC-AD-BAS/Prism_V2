<?php

/*
    error.php - A somewhat helpful error page.  Error message is passed along as a URL string and decoded to be displayed.
    There is almost certainly a more elegant way to do this.
*/

//Includes
include "../render/page_builder.php";
include "db/query_db.php";

//TODO: Better Translation and/or method of passing of error codes.
render_header('Error', false);
render_nav('Something has gone terribly wrong!  :( ');

//Fetch and decode the error message passed along in the URL
$out = '
    <p class="alert">' . urldecode($_SERVER['QUERY_STRING']) . '</p>
    <hr>
    <a class="button" href="list.php"><div>OK</div></a>
';
echo $out;
render_footer();

?>
