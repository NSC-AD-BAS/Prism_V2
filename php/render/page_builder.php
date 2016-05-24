<?php

/*
    Generic page building functions - header, nav and footer
*/

//includes
include_once("../login/login_utils.php");

//Render the page header.  $header and $isDetail are used to title the window/tab
function render_header($header, $isDetail) {
    $out = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <title>PRISM - ' . $header . ($isDetail == "true" ? " Detail" : " List") . '</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../style/site.css">
        </head>
        <body>
    ';
    echo $out;
}

//Render the nav bar, the search box and the $page_name in an h1 element
function render_nav($page_name = "", $searchUrlBase = "") {
    //Only show the search form if we've implemented search for the page and passed in the searchUrlBase.
    $form = $searchUrlBase === "" ? "" : '
        <form target="$searchUrlBase">
            <input id="searchbox" type="text" name="q" placeholder=" Search" />
        </form>
        ';
    //Pages may be added or re-ordered by adjusting this array
    $nav_pages = ["Internships", "Companies", "Students"];
    if (isAdmin()) {
        //Only Admins should see link to Admin page.
        array_push($nav_pages, "Users");
        array_push($nav_pages, "Changelog");
    }
    $out = '<nav><ul>';
    foreach ($nav_pages as $page) {
        $out .= '<li class="left"><a href="../' . strtolower($page) . '/list.php">' . $page . '</a></li>';
    }
    $user_details = get_user_details();
    $out .= $user_details;
    $out .= '<li class="right"><a href="../login/logout.php">Logout</a></li></ul></nav>
        <main>
            ' . $form . '
        <h1>' . $page_name . '</h1>
    ';
    echo $out;
}

//Render the page footer.  This function closes the main element opened by render_nav();
function render_footer() {
    //Close the main opened in render_nav()
    $out = '
        </main>
        </br>
        <footer>
        <p>North Seattle College - PRISM &copy; 2016</p>
        </footer>
        </body>
        </html>
    ';
    echo $out;
}

?>
