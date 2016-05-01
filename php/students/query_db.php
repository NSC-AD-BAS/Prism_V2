<?php
	/*Function to return all of the students in the database as an array of associative arrays
	containing all of the attributes of the students.*/
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

	/*Function to return a single student from the database as an associative array.
	This student is supposed to be selected by the id from the students_list view from the
	database but fails to do so because the students_detail view does not contain the proper
	id so I can't query on that. -- Austin*/
	function get_single_student($id) {
		
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$query = "SELECT * FROM student_detail LIMIT 1;";
		if ($result = mysqli_query($conn, $query)) {
			$row = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
		}
    	mysqli_close($conn);

		return $row;
	}
?>