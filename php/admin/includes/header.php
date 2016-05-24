<!DOCTYPE html>
<!-- author Joe McLaughlin -->
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../style/site.css">
<?php

    //require("../lib/db_connect.php");
    require '../../lib/db_connect.php';
    require 'includes/functions_inc.php';

    //Current page name, stripped of folder pathing
    define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); 
    //define('SITE_URL', "http://www.joesarchive.com/sandbox/prism/");
    //Below are page specific variables/settings.    
    switch(THIS_PAGE)
    {
        case 'list.php':        
            $title = "PRISM - Users List";
            $header = "PRISM - Users List";
            break;
        case 'detail.php':        
            $title = "PRISM - Users View";
            $header = "PRISM - Users View";
            break;
        case 'edit.php':        
            $title = "PRISM - Users Edit";
            $header = "PRISM - Users Edit";
            break;
        case 'add.php':        
            $title = "PRISM - Users Add";
            $header = "PRISM - Users Add";
            break;
        default:
            $title = "P R I S M - ";
            $header = "P R I S M - ";
    }
?>
	<title>
		<?=$title;?>
	</title>
</head>
<body>
    <nav>
            <ul>
                <li class="left"><a href="../internships/list.php">Internships</a></li>
                <li class="left"><a href="../companies/list.php">Companies</a></li>
                <li class="left"><a href="../students/list.php">Students</a></li>
                <li class="left"><a href="../admin/list.php">Users</a></li>
                <li class="left"><a href="#">Change Log</a></li>

                <li class="right"><a href="../login/logout.php">Logout</a></li>
                <li class="right"><a href="list.php">Profile</a></li>
            </ul>
        </nav>
    <main>
        <form target="">
            <input id="searchbox" type="text" name="q" placeholder=" Search" />
        </form>
        <h1><?=$header;?></h1>