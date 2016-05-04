<?php

	function create_student($student) {
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$insertUserQuery = build_insert_user_query($student);
		mysqli_query($conn, $insertUserQuery);
		$newUserId = mysqli_insert_id($conn);

		$insertStudentQuery = build_insert_student_query($student, $newUserId);
		mysqli_query($conn, $insertStudentQuery);

		$notes = $student['notes'];
		$insertNoteQuery = build_insert_note_query($newUserId, $notes);
		mysqli_query($conn, $insertNoteQuery);
		
    	mysqli_close($conn);
	}

	function build_insert_user_query($student) {
		$STUDENT_USERTYPE_ID = 1;

		$defaultUserName = $student['first'] . $student['last'] . $student['ssid'];
		$defaultPassword = 'test';

		$queryFormat = "insert users(
				FirstName,
				MiddleName,
				LastName,
				PhoneNumber,
				EmailAddress,
				UserName,
				UserPassword,
				TypeId)
			values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', %d);";

			return sprintf($queryFormat,
				$student['first'],
				$student['middle'],
				$student['last'],
				$student['phone'],
				$student['email'],
				$defaultUserName,
				$defaultPassword,
				$STUDENT_USERTYPE_ID);
	}

	function build_insert_student_query($student, $userId) {
		$queryFormat = "insert students(
				UserId,
				StudentId,
				PreferredName,
				ProgramStatus,
				Internship,
				InternCapstoneStatus,
				Cohort,
				ApplicationStatus,
				ResumeURL,
				LinkedInURL,
				StreetAddressLineOne,
				StreetAddressLineTwo,
				City,
				State,
				Zipcode)
			values (%d, %d, '%s', '%s', '%s', '%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";

			return sprintf($queryFormat,
				$userId,
				$student['ssid'],
				$student['preferred'],
				$student['program_status'],
				$student['internship_url'],
				$student['internship_capstone_status'],
				$student['cohort'],
				$student['application_status'],
				$student['resume_url'],
				$student['linked_in_url'],
				$student['address1'],
				$student['address2'],
				$student['city'],
				$student['state'],
				$student['zipcode']);
	}

	function build_insert_note_query($userId, $notes) {
		$queryFormat = "insert user_notes(
				UserId,
				Note_Type,
				Note_Text)
			values (%d, '%s', '%s');";

			return sprintf($queryFormat,
				$userId,
				'Unknown',
				$notes);
	}

	function edit_student($id) {
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
	}
?>