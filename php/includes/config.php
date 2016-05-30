<?php


/*
 We have these types of includes, 
*/

//header and footer not incuded here.


#define's are constants that can be used globally
define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); # Current page name, stripped of folder info - (saves resources)

define('VIRTUAL_PATH', 'http://www.joesarchive.com/sandbox/Prism_V2/php/'); # Virtual (web) 'root' of application for images, JS & CSS files
define('PHYSICAL_PATH', '/joesarchive.com/sandbox/Prism_V2/php/'); # Physical (PHP) 'root' of application for file & upload reference

#define('VIRTUAL_PATH', 'http://www.joesarchive.com/sandbox/Prism_V2/php/'); # Virtual (web) 'root' of application for images, JS & CSS files
#define('PHYSICAL_PATH', '/joesarchive.com/sandbox/Prism_V2/php/'); # Physical (PHP) 'root' of application for file & upload reference
define('INCLUDE_PATH', PHYSICAL_PATH . 'include/'); # Path to PHP include files - INSIDE APPLICATION ROOT


date_default_timezone_set('America/Los_Angeles'); #sets default date/timezone for this website
//ini_set('session.save_path','/home/classes/horsey01/sessions'); #optional folder set to 0700 outside webroot to store session data
//ini_set('session.cookie_domain', '.tekbot.net'); # "dot" (period) then domain name - apply session cookies to subdomains!
ob_start();  #buffers our page to be prevent header errors. Call before INC files or ANY html!
//header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching
$title = THIS_PAGE; //fallback unique title - see title tag in header.php
if(DEBUG)
{# When debugging, show all errors & warnings
	ini_set('error_reporting', E_ALL | E_STRICT);  
}else{# zero will hide everything except fatal errors
	ini_set('error_reporting', 0);  
}
#lines to change to match the relative host
#21,22


#required files must be included for site functionality
require '../../../../../includes/creds.php';

#include_once files should only be loaded once to avoid collisions such as defined constants

#include files are files that should be used, but if their are missing links the page should still load
include 'common.php'; //stores common functions,etc.
#include 'credentials.php'; //database credentials
include 'db_connect.php'; //database credentials
include 'function_inc.php'; //stores common fucntions, redundent to common.php, choose one
include 'page_builder.php'; //builds basic page needs
include 'query_builder.php'; //build db queries
include 'login_utils.php'; //functions for login functionality
include 'query_db.php'; // quieries for the db
include 'render_company.php'; //renders the company page
include 'student_presentation.php'; //renders the student_presentation page
include 'update_db.php'; //updates to the db




/*
$nav1['.php'] = "";
$nav1['.php'] = "";
$nav1['.php'] = "";
$nav1['.php'] = "";



//title must be unique.
switch(THIS_PAGE)
{
	case 'template.php':
	$title = "Template Page Title!";
		$banner = "Template Banner!";
	break;
	case 'first_data1.php':
	$title = "DATABASE PAGE!";
		$banner = "DATABASE Banner!";
	break;
	default:
		//$title = "Our Cool Website!";  titles must be unique.
		$banner = "Our Cool Banner!";
		
}
*/


?>