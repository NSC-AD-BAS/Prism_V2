<?php 

    require "../login/validate_session.php"; 
    require '../lib/db_connect.php';
    include '../db/query_db.php';
    include '../render/page_builder.php';

    include_once("../login/login_utils.php");
    switch(basename($_SERVER['PHP_SELF']))
        {
            case 'list.php':        
                render_header('Users');
                render_nav('Users');
                break;
            case 'detail.php':        
                render_header('Users',true);
                render_nav('Users');
                break;
            case 'edit.php':        
                render_header('Users');
                render_nav('Users');
                break;
            case 'add.php':        
                render_header('Users');
                render_nav('Users');
                break;
            default:
                $title = "P R I S M - ";
                $header = "P R I S M - ";
        }
    
?>

