<!DOCTYPE html>
<!-- author Joe McLaughlin -->
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../style/site.css">
<?php

    //require("../lib/db_connect.php");
    require '../../../../../includes/creds.php';
    require 'includes/functions_inc.php';

    //Current page name, stripped of folder pathing
    define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); 
    //define('SITE_URL', "http://www.joesarchive.com/sandbox/prism/");
    //Below are page specific variables/settings.    
    switch(THIS_PAGE)
    {
        case 'list.php':        
            $title = "Faculty-list";
            $header = "Faculty-list";
            break;
        case 'user_view.php':        
            $title = "Faculty-view";
            $header = "Faculty-view";
            break;
        case 'edit.php':        
            $title = "Faculty-edit";
            $header = "Faculty-edit";
            break;
        case 'add.php':        
            $title = "Faculty-add";
            $header = "Faculty-add";
            break;
        default:
            $title = "P R I S M - Default";
            $header = "P R I S M - Default";
    }
?>
	<title>
		<?=$title;?>
	</title>
</head>
<body>
	<header><h1><?=$header;?></h1></header>
	<!-- commented until tested on server 
    <nav>
		<a href="../internships/list.php">Internships</a>
		<a href="../companies/list.php">Companies</a>
		<a href="../students/list.php">Students</a>
		<a href="../admin/list.php">(Admin)</a>
        <a href="../login/logout.php">Logout</a>
	<main>
    -->
    
    <nav>
            <ul>
                <li class="left"><a href="../internships/list.php">Internships</a></li>
                <li class="left"><a href="../companies/list.php">Companies</a></li>
                <li class="left"><a href="../students/list.php">Students</a></li>
                <li class="left"><a href="../admin/list.php">Admin</a></li>

                <li class="right"><a href="../login/logout.php">Logout</a></li>
                <li class="right"><a href="list.php">Profile</a></li>
            </ul>
        </nav>
    <main>