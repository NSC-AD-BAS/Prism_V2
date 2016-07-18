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
    
/**
 * Automatically loads classes by name when called.  This saves resources, as  
 * only pages that need to reference the class actually load it.
 *
 * The autoload function allows us to name a file after the class, and customize it to 
 * meet our needs, but load the file requiring the class by assuming the file name based on 
 * the name of the class.  In our case, we'll add '.php', which follows our pattern. 
 *
 *<code>
 *$myObject = new myClass();
 *</code>
 *  
 * @param str $class_name Class to be loaded as needed
 * @return void
 */

function __autoload($class_name) 
{
    if(file_exists(INCLUDE_PATH . $class_name . '.php'))
    {
    	include INCLUDE_PATH . $class_name . '.php';
	}
}#end __autoload()
function myerror($myFile, $myLine, $errorMsg)

{
	
    if(defined('DEBUG') && DEBUG)
	
    {
    	
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
        echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";	
        die();
    }
}
?>

