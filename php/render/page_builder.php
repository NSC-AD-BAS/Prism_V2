<?php

/*
    Generic page building functions - header, nav and footer
*/

//includes
include_once("../login/login_utils.php");

//Render the page header.  $header and $isDetail are used to title the window/tab
function render_header($header = "", $isDetail = false) {
    $out = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <title>PRISM - ' . $header . ($isDetail == "true" ? " Detail" : "") . '</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../style/site.css">
        </head>
        <body>
    ';
    echo $out;
}

function build_search_form($searchActionUrl) {
    $searchFormFormat = '
        <form method="GET" action="%s">
            <input id="searchbox" type="text" name="q" placeholder=" Search" />
        </form>';
    
    if ($searchActionUrl === "")
        return "";
    return sprintf($searchFormFormat, $searchActionUrl);
}

//Render the nav bar, the search box and the $page_name in an h1 element
function render_nav($page_name = "", $searchActionUrl = "") {
    //Only show the search form if we've implemented search for the page and passed in the searchUrlBase.
    $form = build_search_form($searchActionUrl);

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
    // Profile button -- Added by Austin
    $out .= '
        <li class="right"><a href="../profile/detail.php">Profile</a></li>
        <li class="right"><a href="../login/logout.php">Logout</a></li></ul></nav>
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
        <footer>
        <p>North Seattle College - PRISM &copy; ' . date('Y') . '</p>
        </footer>
        </body>
        </html>
    ';
    echo $out;
}

//Changelog helper method
function buildListItemFromChangeLog($changeLog) {
    $listItemFormat =
            "<li>
                <ul class='inner'>
                    <li>%s</li>
                    <li>%s</li>
                    <li>%s</li>
                </ul>
            </li>";
        return sprintf($listItemFormat
            , dbOut($changeLog['Name'])
            , dbOut($changeLog['LogTime'])
            , dbOut($changeLog['Message']));
}

?>
