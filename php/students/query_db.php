<?php
	function create_connection() {
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		return $conn;
	}

	function get_many_rows($query) {
		$conn = create_connection();

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

	function get_row($query) {
		$conn = create_connection();

		if ($result = mysqli_query($conn, $query)) {
			$row = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
		}
    	mysqli_close($conn);

		return $row;
	}

	function get_all_students() {
		$query = "SELECT * FROM student_list;";
		return get_many_rows($query);
	}

	function get_single_student($id) {
		$query = "SELECT * FROM student_detail WHERE UserId = " . $id . ";";
		return get_row($query);
	}

	function get_all_fields($id) {
		$query = "SELECT * FROM students WHERE UserId = " . $id . ";";
		return get_row($query);
	}

	function get_all_intern_capstone_statuses() {
		$query = "SELECT * FROM intern_capstone_status;";
		return get_many_rows($query);	
	}

	function get_all_application_statuses() {
		$query = "SELECT * FROM application_status;";
		return get_many_rows($query);	
	}

	function get_all_program_statuses() {
		$query = "SELECT * FROM program_status;";
		return get_many_rows($query);	
	}
	function isAdmin() {
	    //TODO: This needs to (eventually) evaluate that the user is both logged in *and* has admin credentials.
	    //Change to false to see nav and detail buttons auto-magically disappear.
	    return true;
	}

	function get_prev_student($id) {
		$query = "SELECT UserId FROM student_detail WHERE UserId < " . $id . " ORDER BY UserId DESC LIMIT 1;";
		$row = get_row($query);
		return $row["UserId"];
	}

	function get_next_student($id) {
		$query = "SELECT UserId FROM student_detail WHERE UserId > " . $id . " ORDER BY UserId LIMIT 1;";
		$row = get_row($query);
		return $row["UserId"];
	}

	function get_student_notes($userId) {
		$query = "SELECT 
	        un.User_NoteId AS `NoteId`,
	        un.Note_Type AS `Type`,
	        un.Note_Text AS `Text`
		FROM
        	users u
				JOIN
        	user_notes un ON u.UserId = un.UserId
        WHERE u.UserId = " . $userId;

       return get_many_rows($query);	
	}

	function get_note($id) {
		$query = "SELECT
			u.UserId, 
	        un.User_NoteId AS `NoteId`,
	        un.Note_Type AS `Type`,
	        un.Note_Text AS `Text`
		FROM
        	users u
				JOIN
        	user_notes un ON u.UserId = un.UserId
        WHERE un.User_NoteId = " . $id;

        return get_row($query);
	}

	function get_searchable_student_data() {
		$query = "SELECT * FROM student_detail;";
		return get_many_rows($query);
	}

	function student_matches_search($student, $searchQuery) {
		$lowercaseQuery = strtolower($searchQuery);
		foreach($student as $field => $value) {
			$lowerCaseValue = strtolower($value);
			if (strpos($lowerCaseValue, $lowercaseQuery) !== false) {
			    return true;
			}
		}
		return false;
	}

	function build_search_result_query($userIds) {
		$reduceFunc = function($inClause, $item)
		{
		    return $inClause . "," . $item;
		};
		
		$inClause = array_reduce($userIds, $reduceFunc, -1);
		$format = "SELECT * FROM student_list WHERE UserId in (%s);";
		return sprintf($format, $inClause);
	}

	function search_students_for($searchQuery) {
		$searchableStudents = get_searchable_student_data();

		$userIds = [];
		foreach ($searchableStudents as $searchableStudent) {
			if (student_matches_search($searchableStudent, $searchQuery)) {
				$id = $searchableStudent["UserId"];
				array_push($userIds, $id);
			}
		}

		$query = build_search_result_query($userIds);
		return get_many_rows($query);
	}
?>