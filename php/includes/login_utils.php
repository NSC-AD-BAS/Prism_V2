<?php

# starts and ensures the variables of this session, if session is invalid,
# will redirect to logout.php which correctly destroys the session
# I wanted this session management code in the utils but it was unhappy :()

/*
functions:
get_user_details()
is_logged_in()
to_login()

*/
/*function start_ensure_session() {
    session_start();

    if (!is_logged_in()) {
        to_login();
    }
}*/

# call this function BEFORE you populate the list_view element
function get_user_details() {
    #print user details in banner
    return "<span id=\"userinfo\"><strong>" . $_SESSION["user_type"] . "</strong>" .
        "&emsp;" . $_SESSION["name"] . " -- " . $_SESSION["username"] . "</span>";
}

#is_logged_in returns whether or not the user is logged in by checking session vars
function is_logged_in() {
	return (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"])
        && isset($_SESSION["username"]) && isset($_SESSION["name"]));
}

#sends the user to "login.html" & kills the current page
function to_login() {
	header("Location: ../login/logout.php");
	die();
}
?>