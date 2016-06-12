<?php include 'includes/header.php'; ?>
<br><br>        
<?php 
include 'includes/functionsinc.php';
/**
  * Allows fields of a selected account to be changed
  * Fields include: Name, phone number, email, and user type
  */
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){ //proper data must be on querystring
		$myID = (int)$_GET['id']; //Convert to integer, will equate to zero if fails
	}
	$sql = "SELECT FirstName, LastName, PhoneNumber, EmailAddress,TypeId ,UserId FROM users WHERE UserId='".$myID."'"; //set sql statement

	$result = mysqli_query($conn, $sql);//grab tables
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
	} else {
		echo "0 results";
	}

	$firstName = dbOut($row['FirstName']);//assign variables for readability
    $lastName = dbOut($row['LastName']);
    $userPhone = dbOut($row['PhoneNumber']);
	$userEmail = dbOut($row['EmailAddress']);
	$userType = dbOut($row['TypeId']);
    $usrId = dbOut($row['UserId']);

	//Edit Page
	echo "<form action='prism-input.php?id=".$myID."' method='post'>";
	echo "First Name: <input type='text' name='firstname' value='".$firstName."'><br>";
	echo "Last Name: <input type='text' name='lastname' value='".$lastName."'><br>";
	echo "User Email: <input type='text' name='userEmail' value='".$userEmail."'><br>";
	echo "User Phone: <input type='text' name='userPhone' value='".$userPhone."'><br>";
    
    echo "
    User Type: 
    <input type='radio' name='type' value='2'";
    if($userType ==2){echo "checked";}
    echo ">Admin";
    
    echo "<input type='radio' name='type' value='1'";
    if($userType ==1){echo "checked";}
    echo ">Student";
    
    echo "<input type='radio' name='type' value='3'";
    if($userType ==3){echo "checked";}
    echo ">Faculty<br>";
    echo "<input type='submit' value='Update' >";
	echo "<input type='hidden' name='act' value='update' />";
    
    echo '<a class="button" href="detail.php?id=' . $usrId . '"><div>Cancel</div></a>';
	echo "</form>";
    
    
?>
<br><br>
<a href=list.php> Back to list</a>
<?php include 'includes/footer.php'; ?>
