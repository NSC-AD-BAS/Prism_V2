<?php require "../login/validate_session.php"; ?>
<!DOCTYPE html>
<!-- 
	author Joe McLaughlin
	Contains the header and common html and php shared
	between user pages
 -->
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../style/site.css">
<?php
    
    #require '../includes/config.php; //site configuration
	#require '../../../../../includes/creds.php';//remove when config is live
    require '../lib/db_connect.php';//remove when config is live
    include '../db/query_db.php';
    include_once("../login/login_utils.php");

    //Current page name, stripped of folder pathing
    define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); 
    //Below are page specific variables/settings.
    switch(THIS_PAGE)
    {
        case 'list.php':        
            $title = "PRISM - Users List";
            $header = "Users List";
            break;
        case 'detail.php':        
            $title = "PRISM - Users View";
            $header = "Users View";
            break;
        case 'edit.php':        
            $title = "PRISM - Users Edit";
            $header = "Users Edit";
            break;
        case 'add.php':        
            $title = "PRISM - Users Add";
            $header = "Users Add";
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
                <!--Add php if statement for user privys-->
                <?php 
                    if(isAdmin()){
                    echo '<li class="left"><a href="../users/list.php">Users</a></li>';
                    echo '<li class="left"><a href="../changelog/list.php">Changelog</a></li>';
                }
                ?>
                <!--End php if statement for user privys-->
                
                
                <li class="right"><a href="../login/logout.php">Logout</a></li>
                <li class="right"><a href="../profile/detail.php">Profile</a></li>
            </ul>
        </nav>
    <main>
        <form target="">
            <input id="searchbox" type="text" name="q" placeholder=" Search" />
        </form>
        <h1><?=$header;?></h1>
