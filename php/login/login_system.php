<?php
include_once("../login/login_utils.php");
#Author: Kellan Nealy

# accepts POST form data from "login.html", logs in the user, & redirects
# to "student_landing.php", "faculty_landing.php", or "admin_landing.php"
# DOES NOT output any html content

#IMPORTANT: If you try to login to an existing session it will send you
#back to login after destroying that session.  No errors passed yet

session_start();
if (!is_logged_in()) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    # initial validation of login information using regex
    validate($username, $password);
    #connect to and query DB to check passed username/password
    $mysqli = get_db_connection();
    $user_exists = false; 
    #store user info from the query
    $user_info = array();
    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT UserId, TypeId, UserName, FirstName
                                FROM users
                                WHERE UserName = \"$username\"
                                    AND UserPassword = \"$password\";")) {
        foreach ($result as $row) {
            foreach ($row as $element) {
                if ($element) {
                    # DEBUG: echo $element . "<br />";
                    $user_exists = true;
                    $user_info[] = $element;
                }
            }
        }
        /* close result set */
        $result->close();
    }
    # what happens when the query didnt find user
    if (!$user_info) {
        $user_exists = false;
        echo "user credentials query failed";
        to_login();
    }
    # DEBUG: echo $user_exists;
    # DEBUG: print_r($user_info);
    
    #set the session variables (user_id, user_type, username, name)
//    print_r($user_info);
    $_SESSION["user_id"] = $user_info[0];
    $type_id = $user_info[1];
    $_SESSION["user_type"] = get_user_type($type_id);
    $_SESSION["username"] = $user_info[2];
    $_SESSION["name"] = $user_info[3];

    #store cookie so we can see time of last visit! this is an extra feature
    $time_expire = time() + 60*60*24*7;
    setcookie("last_visit", date("D y M d, g:i:s a", $time_expire));
    
    # can greet the user at landing page if session variables stored!!
    # redirect to list page
    to_list_page();
    
} else {
    # user already has a session, so lets assume they
    # want to end it and login again
    session_destroy();
    session_regenerate_id(true);
    to_login();
}

#validate uses regular expressions to validate input, redirects to start if invalid
function validate($username, $password) {
    #At least one letter or number for each regex
    $name_regex = "/^[a-z|0-9|A-Z]+$/";
    $password_regex = "/^[a-z|0-9|A-Z]+$/";
    if (preg_match($name_regex, $username) != 1 || preg_match($password_regex, $password) != 1) {
        to_login();
    }
}

#Gets the user_type as a string from the typeIDs stored in the DB
function get_user_type($TypeId) {
    if ($TypeId == 1) {
        return "Student";
    } else if ($TypeId == 2) {
        return "Admin";
    } else if ($TypeId == 3) {
        return "Faculty";
    } else {
        return "";
    }
}

#sends the user to the correct list page & kills the current page
function to_list_page() {

    if ($_SESSION["user_type"] == "Student") {
        
        header("Location: ../internships/list.php");
        
    } else if ($_SESSION["user_type"] == "Admin") {

        header("Location: ../students/list.php");
    
    } else if ($_SESSION["user_type"] == "Faculty") {
            
        header("Location: ../students/list.php");
    } 

	die();
}

#uses internally stored credentials to create and return DB connection
#as a Mysqli PHP object.  For use on prism.tekbot.net unless you hard-code.
function get_db_connection() {
    include '../lib/db_connect.php';
    //create and verify connection
    $mysqli_obj = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli_obj->connect_error) {
        die('DB Connection Error: ' . $mysqli_obj->connect_errno . $mysqli_obj->connect_error);
    }
    return $mysqli_obj;
}
?>
