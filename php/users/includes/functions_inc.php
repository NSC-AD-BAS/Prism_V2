<?php
/**
  * 
  *
  *
  * @package School-Intern-DB
  * @author Joe McLaughlin
  * @version 1.00 2016 - May 02nd
  * @link http://www.joesarchive.com/sandbox/php/includes/functions_inc.php
  * @license http://www.apache.org/licenses/LICENSE-2.0
  * @see functions_inc.php
  * @todo evolve...
  */

/**
  * Used to create a list of rows from the users table
  * Good to use with a while loop if you want to populate a
  * 	list that uses all data from given DB.
  * <code>
  * 
  * </code> 
  *
  * @param	
  */
function userList(){
	//create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {die("Connection failed: " . mysqli_connect_error());}


	$sql = "SELECT * FROM users WHERE TypeId > 1 AND TypeId < 4";//set sql statement

	$result = mysqli_query($conn, $sql);//grab tables
    echo 
    '
    <ul class="outer">
     <!--COLUMNS-->
                <li class="tableHead">
                    <ul class="inner">
                        <li>Full Name</li>
                        <li>Contact Info</li>
                        <li>User Type</li>
                    </ul>
                </li>
     <!--ROWS-->
    
    ';
	while($row = mysqli_fetch_assoc($result)){//fetch data from associate array
		$firstName = dbOut($row['FirstName']);//assign variables for readability
		$lastName = dbOut($row['LastName']);
		$contact = dbOut($row['ContactInfo']);
		$type = dbOut($row['TypeId']);
		$usrId = dbOut($row['UserId']);
		//print out table structure with data
		/*
        echo '<tr>';
		echo '<td><a href="detail.php?id='.$usrId .'">' . $firstName .  ' ' . $lastName . '</a></td>';
		echo '<td>' . $contact . '</td>'; 
		echo '<td>' . $type . '</td>';
		echo '</tr>';
        */
        
        echo '
                <li>
                    <a href="detail.php?id='. $usrId . '">
                        <ul class="inner">
                            <li>' . $firstName .  ' ' . $lastName . '</li>
                            <li>' . $contact . '</li>
                            <li>' . $type .'</li>
                            <li>' . $intLocation .'</li>
                        </ul>
                    </a>
                </li>
            
            ';
	}//end while
    echo ' </ul>';
    echo '<a class="button" href="add.php"><div>Create new User</div></a>'; 
    
	//release result

	//close db connection
	mysqli_close($conn);
} #end userList()


/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
  */
function userAdd(){
	//AddPage
	//*
 	echo "<form action='prism-input.php?id=".$myID."' method='post'>";
	echo "First Name: <input type='text' name='firstname' ><br>";
	echo "Last Name: <input type='text' name='lastName' ><br>";
	echo "Contact: <input type='text' name='contact' ><br>";
	echo "User Type: <input type='text' name='type' ><br>";
	echo "<input type='submit' name='add'>";
	echo "<input type='hidden' name='act' value='add' />";
	echo "</form>";
} #end userAdd()

/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
  */
function userEdit(){
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
		$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
	}
	$sql = "SELECT * FROM users where UserId=".$myID; //set sql statement

	$result = mysqli_query($conn, $sql);//grab tables
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
	} else {
		echo "0 results";
	}

	$firstName = dbOut($row['FirstName']);//assign variables for readability
	$lastName = dbOut($row['LastName']);
	$contact = dbOut($row['ContactInfo']);
	$type = dbOut($row['TypeId']);
	$usrId = dbOut($row['UserId']);

	//Edit Page
	echo "<form action='prism-input.php?id=".$myID."' method='post'>";
	echo "First Name: <input type='text' name='firstname' value='".$firstName."'><br>";
	echo "Last Name: <input type='text' name='lastname' value='".$lastName."'><br>";
	echo "Contact: <input type='text' name='contact' value='".$contact."'><br>";
	echo "User Type: <input type='text' name='type' value='".$type."'><br>";
	echo "<input type='submit' value='Update' >";
	echo "<input type='hidden' name='act' value='update' />";
	echo "</form>";
    
    echo '<a class="button" href="detail.php?id=' . ($row['UserId']) . '><div>Cancel</div></a>';
    
} #end userEdit()



/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
  */
function userDetails(){

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
	 	$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
	}
	$sql = "SELECT * FROM users where UserId=".$myID; //set sql statement

	$result = mysqli_query($conn, $sql);//grab tables
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
        if(dbOut($row['UserId']-1) > 0){
		echo '<a class="button" href=detail.php?id=' . (dbOut($row['UserId']-1)) . '><div>Previous</div></a>';
        }
        if(mysqli_num_rows($result) < dbOut($row['UserId']+1)){
            echo '&emsp;&emsp;&emsp; <a class="button" href=detail.php?id=' . (dbOut($row['UserId']+1)) . '><div>Next</div></a>';
        }
	} else {
		echo "0 results";
	}
    
	$firstName = dbOut($row['FirstName']);//assign variables for readability
	$lastName = dbOut($row['LastName']);
	$contact = dbOut($row['ContactInfo']);
	$type = dbOut($row['TypeId']);
	$usrId = dbOut($row['UserId']);

	//Details Page
	//echo  "<a href=" . 'edit.php?id=' . ($row['UserId']) . '> Edit</a>' . "&emsp;&emsp;&emsp;";
	//echo  "<a href=" . 'add.php?id=' . ($row['UserId']) . '> Add</a>' . "&emsp;&emsp;&emsp;";        
	//echo  "<a href=" . 'delete.php?id=' . ($row['UserId']) . '> Delete</a>';
	echo "<br /><br />Full Name : " . $row[FirstName] . " " . $row[LastName] . "<br>";
	echo "Contact Info : " . $row[ContactInfo] . "<br>";
	echo "User Type : " . $row[TypeId] . "<br>" . "<br>";

    echo '&emsp;&emsp;&emsp; <a class="button" href=edit.php?id=' . ($row['UserId']) . '><div>Edit</div></a>' . '&emsp;&emsp;&emsp;' . '<a class="button" href=delete.php><div>Delete</div></a>';
    
	
} #end userDetails()


/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
  */
function userDelete(){
	////////////////////////////////////////////////////////////////////
	/******************************************************************/
	//DeletePage
	/*

	echo "<form action='list.php?id='".$usrId."' method='post'>";
	echo "<input type='submit' >";
	echo "<input type='hidden' name='act' value='delete' />";
	echo "</form>";

	//delete
	//Delete SQL statement


	echo "<form action='detail.php?id='".$usrId."' method='post'>";
	echo "<input type='submit' >";
	echo "<input type='hidden' name='page' value='view' />";
	echo "</form>";
	//*/
	//End Delete Page
	/******************************************************************/
	////////////////////////////////////////////////////////////////////
echo "are you sure";
} #end userDelete()


/**
  * Description
  *
  * <code>
  * 
  * </code>
  *
  * @param	
  */
function dbOut($str){
if($str!=""){$str = stripslashes(trim($str));}//strip out slashes entered for SQL safety
	return $str;
} #end dbOut()
?>
