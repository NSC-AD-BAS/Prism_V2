<?php 
	//require '../../../../../includes/creds.php';
    //define('SITE_URL', "http://joesarchive.com/sandbox/Prism_V2/php/users/");
    require '../lib/db_connect.php';
	define('SITE_URL', "http://prism.tekbot.net/users/");
    
	# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
	if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

	switch ($myAction) 
	{//check 'act' for type of process

		case "update": # 1)user is updating a field
			updateUser();
			break;
		case "add": # 1)user is updating a field
			addUser();
			break;		
		default:
			$newURL = SITE_URL . 'list.php';
			header('Location: '.$newURL);
	}

	/////////////////////////////////////////////////////////////////
/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
  */
function updateUser(){
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
		$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
	}

	if(isset($_POST['firstname'])){$firstName=$_POST['firstname'];}else{$firstName = '';}
    if(isset($_POST['lastname'])){$lastName=$_POST['lastname'];}else{$lastName = '';}
    if(isset($_POST['contact'])){$contact=$_POST['contact'];}else{$contact = '';}
    if(isset($_POST['typeid'])){$typeid=$_POST['typeid'];}else{$typeid = '2';}

	$sql = "UPDATE users set firstName='%s',lastName='%s',contact='%s',typeid=%d WHERE UserId = " . $myID;

	$sql = sprintf($sql,$firstName,$lastName, $contact, $typeid);
	//var_dump($sql); //test sql query 
    //die();
	$result = mysqli_query($conn,$sql); 
	if ($result)
	{//successful update!
		$newURL = SITE_URL . 'detail.php?id=' . $myID;
	}else{
		$newURL = SITE_URL . 'edit.php?id=' . $myID;
	}
	header('Location: '.$newURL);
	die();
}

/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
*/
function addUser(){
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
		$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
	}
    
	if(isset($_POST['firstname'])){$firstName=$_POST['firstname'];}else{$firstName = 'a';}
    if(isset($_POST['lastname'])){$lastName=$_POST['lastname'];}else{$lastName = '';}
    if(isset($_POST['contact'])){$contact=$_POST['contact'];}else{$contact = '';}
    //if(isset($_POST['typeid'])){$typeid=$_POST['typeid'];}else{$typeid = '';}

	$sql = "INSERT INTO users(firstname,lastname,contact,typeId) VALUES('%s','%s','%s',%d)";
	$sql = sprintf($sql,$firstName,$lastName,$contact,1/*,$typeid*/);

	//var_dump($sql); //test sql query 
	//die();

	$result = mysqli_query($conn,$sql); 
	if ($result)
	{//successful update!
		$newURL = SITE_URL . 'list.php';
	}else{
		$newURL = SITE_URL . 'add.php';
	}
	header('Location: '.$newURL);
	die();
}
/////////////////////////////////////////////////////////////////


?>
