<!DOCTYPE html>
<!-- author Joe McLaughlin -->
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../style/site.css">
<?php
    
    //require("../lib/db_connect.php");
    require '../../../includes/creds.php';
    require 'includes/functions_inc.php';

    //Current page name, stripped of folder pathing
    define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); 

        //Below are page specific variables/settings.    
    switch(THIS_PAGE)
    {
        case 'user_list.php':        
            $title = "index";
            $header = "Faculty-list";
            break;

        default:
            $title = "Default Title";
            $header = "Default Header";
    }

    
?>
    
<title>
   <?=$title;?>
</title>
</head>
<body>

<header><h1><?=$header;?></h1></header>
    <nav>
        <a href="../internships/list.html">Internships</a>
        <a href="../companies/list.html">Companies</a>
        <a href="../students/list.html">Students</a>
        <a href="../admin/list.html">(Admin)</a>
    </nav>
    <main>
