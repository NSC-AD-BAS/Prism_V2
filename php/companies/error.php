<?php

//Includes
include "../render/page_builder.php";
include "db/query_db.php";

//TODO: Better Translation and/or method of passing of error codes.
render_header('Error', false);
render_nav('Something has gone terribly wrong!  :( ');

$out = '
    <p class="alert">' . urldecode($_SERVER['QUERY_STRING']) . '</p>
    <hr>
    <a class="button" href="list.php"><div>OK</div></a>
';

echo $out;

render_footer();
?>
