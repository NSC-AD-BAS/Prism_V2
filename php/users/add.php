<?php include 'includes/header.php'; ?>
<br><br>        
<?php 
/**
  * Displays newly created user and its fields
  */
	//AddPage
	//*
 	echo "<form action='prism-input.php?id=".$myID."' method='post'>";
	echo "First Name: <input type='text' name='firstname' ><br>";
	echo "Last Name: <input type='text' name='lastName' ><br>";
	//echo "Contact: <input type='text' name='contact' ><br>";
    echo "Phone #: <input type='text' name='userPhone' ><br>";
	echo "E-mail : <input type='text' name='userEmail' ><br>";
    
	echo "
    User Type: 
    <input type='radio' name='type' value='2'>Admin
    <input type='radio' name='type' value='1' checked>Student
    <input type='radio' name='type' value='3'>Faculty<br><br>
    ";
	echo "<input type='submit' name='add'>";
	echo "<input type='hidden' name='act' value='add' />";
	echo "</form>";
?>
<br><br>
<a href=list.php> Back to list</a>
<?php include 'includes/footer.php'; ?>
