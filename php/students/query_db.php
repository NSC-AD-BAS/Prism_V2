<?php
/*
This script is intended to only generate the table for displaying the list of students.
The entirety of the table is created here, including the labels for the colums.
-- Austin
*/
	function get_all_students() {
		
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$query = "SELECT * FROM student_list;";
		
		$students = array();
		if ($result = mysqli_query($conn, $query)) {
		    while ($student = mysqli_fetch_assoc($result)) {
		        array_push($students, $student);
		    }
		    mysqli_free_result($result);
		}
    	mysqli_close($conn);

		return $students;
	}
?>