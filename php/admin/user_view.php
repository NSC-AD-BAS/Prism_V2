<?php include 'includes/header.php'; ?>

    
<br>
<br>        
<?php


/*
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "SELECT * FROM users where UserId=".$myID;

$result = mysqli_query($conn, $sql);



/*
User Detail (Accessible by Admin)
	Displays a document view for a single user record
		Document Data:
			Full Name  (Editable by Admin)
				Displayed as header(i.e.<h1>) and page title in html header
			//Contact Info (Editable by Admin)
			//User Type (Editable by Admin)
			DOES NOT EXISTUser Notes (Editable by Admin)
		DONE Next/Previous navigation
			DONE Next/previous links to present the detail view of the next/prev record. 
		Done Link to return to list, rather than back button nav.
		Add new user note functionality
		<ADMIN> Edit user type
			Add/remove faculty
				Confirmation required
			Grant/revoke admin rights to faculty
				Confirmation required
                

*/

userDetails();

?>
    
<br>
<br>
<a href=list.php> Back to list</a>

<!--  -->

<?php include 'includes/footer.php'; ?>