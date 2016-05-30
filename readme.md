How to install the branch,

#1 ---Make sure you have a creds file like below, and edit the 4 lines to fit your credentials 
(THIS FILE SHOULD NEVER CHANGE AGAIN, referenced in php/includes/config.php line 39 (May 30th 2016))
	
//Name of the Database

define('DB_NAME','The_DB_Name_prism');//edit this with your DATABASE name (prism)

//localhost, or remote host

define('DB_HOST','YOUR_HOST');//edit this with your HOST name (prism)

//credentials

define('DB_USER','Your_User_Name');//edit this with your USER name (prism)

define('DB_PASSWORD','Your_Pass');//edit this with your PASSWORD (prism)


#2 -- Make sure your db_connect.php looks like below
(THIS FILE SHOULD NEVER CHANGE AGAIN)

$dbname = DB_NAME;

$servername = DB_HOST;

$username = DB_USER;

$password = DB_PASSWORD;


#3 -- Open php/includes/config.php

Edit lines 14,15,39 (examples are in the config file)

	#14 - should be your domain.com/YOUR_PATH/php/
    
	#15 - should be your path when you sftp to your server 
    
	#39 - should change to the location of where you put the creds.php file
		I put mine outside the web root in an includes folder
		ex: /home/userName/joesarchive.com/Prism_V2/php/includes/config.php
		my file would be one directory above home so 
		"../../../../../../includes/creds.php"
		You can put this file in the php/lib/ folder
		change line 39 to :
			require_once PHYSICAL_PATH . 'lib/creds.php';