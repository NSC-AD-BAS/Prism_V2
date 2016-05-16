<?php

//Includes
include "page_builder.php";
include "query_db.php";

render_header('', false);
render_nav('Create New Company');
$out = '
    <div class="wrapper">
    <div class="detail_table">
    <table>
    <form action="add_company.php" method="post">
    <tr><td>Company Name</td></tr>
    <td><input class="textbox" type="text" placeholder="Company Name" name="name"></td></tr>
    <tr><td>Company Description</td></tr>
    <td><input class="textbox" type="text" placeholder="Company Description" name="desc"></td></tr>
    </table>
    <div class="lower_nav">
        <input type="submit" class="form_button" value="Add"></td></tr>
        <a class="button" href="list.php"><div>Cancel</div></a></td></tr>
    </div>
    </form>
    </div>
    </div>
';

echo $out;

render_footer();
?>
