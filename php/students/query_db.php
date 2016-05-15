<?php
	function get_many_rows($query) {
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$rows = array();
		if ($result = mysqli_query($conn, $query)) {
		    while ($row = mysqli_fetch_assoc($result)) {
		        array_push($rows, $row);
		    }
		    mysqli_free_result($result);
		}
    	mysqli_close($conn);

		return $rows;
	}

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

	function get_single_student($id) {
		
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$query = "SELECT * FROM student_detail WHERE UserId = " . $id . ";";
		if ($result = mysqli_query($conn, $query)) {
			$row = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
		}
    	mysqli_close($conn);

		return $row;
	}

	function get_all_fields($id) {
		
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$query = "SELECT * FROM students WHERE UserId = " . $id . ";";
		if ($result = mysqli_query($conn, $query)) {
			$row = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
		}
    	mysqli_close($conn);

		return $row;
	}

	function get_all_intern_capstone_statuses() {
		$query = "SELECT * FROM intern_capstone_status;";
		echo "Query= " . $query;
		return get_many_rows($query);	
	}

	function get_all_application_statuses() {
		$query = "SELECT * FROM application_status;";
		echo "Query= " . $query;
		return get_many_rows($query);	
	}

	function get_all_program_statuses() {
		$query = "SELECT * FROM program_status;";
		echo "Query= " . $query;
		return get_many_rows($query);	
	}
	function isAdmin() {
    //TODO: This needs to (eventually) evaluate that the user is both logged in *and* has admin credentials.
    //Change to false to see nav and detail buttons auto-magically disappear.
    return true;
}
?>