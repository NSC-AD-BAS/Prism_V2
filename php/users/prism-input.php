<?php 

    require '../lib/db_connect.php';
    require '../db/query_db.php';
    
	# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
	if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

	switch ($myAction) 
	{#check 'act' for type of process

		case "update": # 1)user is updating a field
			updateUser();
			break;
		case "add": # 1)user is adding a field
			addUser();
			break;		
		default:
			$newURL = 'list.php';
			header('Location: '.$newURL);
	}

/**
  * Updates a user's fields
  * Fields updated include: first name, last name, phone number, email, and type
  * #TODO:Add missing table fields(middle name etc...)
  */

function updateUser(){
	$conn = db_connect();

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
		$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
	}

	if(isset($_POST['firstname'])){$firstName=$_POST['firstname'];}else{$firstName = '';}
    if(isset($_POST['lastname'])){$lastName=$_POST['lastname'];}else{$lastName = '';}
    if(isset($_POST['userPhone'])){$userPhone=$_POST['userPhone'];}else{$firstName = '';}
    if(isset($_POST['userEmail'])){$userEmail=$_POST['userEmail'];}else{$lastName = '';}
    if(isset($_POST['type'])){$type=$_POST['type'];}else{$type = '';}

	$sql = "UPDATE users set firstName='%s',lastName='%s',PhoneNumber='%s',EmailAddress='%s',TypeId=%d WHERE UserId = " . $myID;

	$sql = sprintf($sql,$firstName,$lastName, $userPhone,$userEmail, $type);
	$result = mysqli_query($conn,$sql); 
    
	if ($result)
	{#successful update!
		$newURL = 'detail.php?id=' . $myID;
	}else{
		$newURL = 'edit.php?id=' . $myID;
	}
	header('Location: '.$newURL);
    die();
}

/**
  * Adds a new user to the database along with given fields
  * User fields include: first name, last name, phone number, and email
  * #TODO:Add missing table fields(middle name etc...)
  */
function addUser(){
	$conn = db_connect();

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
		$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
	}
    
	if(isset($_POST['firstname'])){$firstName=$_POST['firstname'];}else{$firstName = '';}
    if(isset($_POST['lastName'])){$lastName=$_POST['lastName'];}else{$lastName = '';}
    if(isset($_POST['userPhone'])){$userPhone=$_POST['userPhone'];}else{$firstName = '';}
    if(isset($_POST['userEmail'])){$userEmail=$_POST['userEmail'];}else{$lastName = '';}
    if(isset($_POST['type'])){$type=$_POST['type'];}else{$type = '';}
    
    if(strlen($firstName) >=3)#check if users last name is smaller than 3 characters
    { 
        $userName = substr($firstName,0,3) . substr($lastName,0,2);
    }else{#if first name is shorter use as is for username
        $userName = $firstName . substr($lastName,0,2);
    }
    $userName = strtolower($userName); #format users name to site standards
    $userPW = $userName; #default pw is userName
    
	$sql = "INSERT INTO users(FirstName,LastName,PhoneNumber,EmailAddress,TypeId,UserName,UserPassword) VALUES('%s','%s','%s','%s',%d,'%s','%s')";
	$sql = sprintf($sql,$firstName,$lastName,$userPhone,$userEmail,$type,$userName,$userPW);
	$result = mysqli_query($conn,$sql); 

	if ($result)
	{#successful update!
		$newURL = 'list.php';
	}else{
		$newURL = 'add.php';
	}
	header('Location: '.$newURL);
	die();
}
?>
