<?php 
include 'includes/header.php';
?>
<br><br>        
<?php 
include 'includes/functionsinc.php';
/**
  * Retrieves and displays details regarding a specified account.
  * Information includes: Name, phone number, email, and user type
  */
	if(isset($_GET['id']) && (int)$_GET['id'] > 0){ //proper data must be on querystring
	 	$myID = (int)$_GET['id']; //Convert to integer, will equate to zero if fails
	}
	$data = get_user_detail($myID);

	//Case: no results
    if (empty($data)) {
        echo "0 results";
    }

    //assign variables for readability
    foreach ($data as $d) {
        $userName = dbOut($d['Name']);
        $userPhone = dbOut($d['Phone']);
        $userEmail = dbOut($d['Email Address']);
        $userType = dbOut($d['User Type']);
        $usrId = dbOut($d['User ID']);
    }
    
    //TODO: Make this a proper detail table
	echo "<br /><br />Name : " . $userName . "<br>";
	echo "Phone #: " . $userPhone . "<br>";
	echo "E-mail : " . $userEmail . "<br>";
	echo "Type : " . $userType . "<br>" . "<br>";
    

    echo '&emsp;&emsp;&emsp; <a class="button" href=edit.php?id=' . $usrId . '><div>Edit</div></a>' . '&emsp;&emsp;&emsp;' . '<a class="button" href=delete.php><div>Delete</div></a>';
    
	
?>
<br><br>
<a href=list.php> Back to list</a>
<?php include 'includes/footer.php'; ?>
