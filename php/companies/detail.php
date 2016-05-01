<?php

//Includes
include "page_builder.php";
include "query_db.php";

//Stuff specific to rendering *this* page
function render_body($data) {
    //We don't know the company name until we have the $data back from the db.  Specifically for page/tab title...
    render_detail_header($data[0]['Company']);

    //Render company detail
    echo "<main>";
    echo "<input id=\"searchbox\" type=\"text\" placeholder=\" Search\" />";
    foreach ($data as $d) {
        echo "<h1>" . $d['Company'] . "</h1>";
    }


    echo "</main>";
}


//Company ID
$id = $_GET['id'];

//Is Edit Mode?
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
} else {
    $edit = false;
}

//Build the page
render_nav();
render_body(get_company_detail($id));
render_footer();

?>
