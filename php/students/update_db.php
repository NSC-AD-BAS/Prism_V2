<?php
	
	function execute_upcert($query) {
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		if (!mysqli_query($conn, $query)) {
		    echo "Error updating record: " . mysqli_error($conn);
		    echo "<br>Query: " . $query;
		    die();
		}

		$newId = mysqli_insert_id($conn);
    	mysqli_close($conn);	

    	return $newId;
	}

	function create_student($student) {
		$insertUserQuery = build_insert_user_query($student);
		$newUserId = execute_upcert($insertUserQuery);

		$insertStudentQuery = build_insert_student_query($student, $newUserId);
		execute_upcert($insertStudentQuery);
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
				Internship,
				ProgramStatusId,
				InternCapstoneStatusId,
				ApplicationStatusId,
				Cohort,
				ResumeURL,
				LinkedInURL,
				StreetAddressLineOne,
				StreetAddressLineTwo,
				City,
				State,
				Zipcode)
			values (%d, %d, '%s', '%s', %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";

			return sprintf($queryFormat,
				$userId,
				$student['ssid'],
				$student['preferred'],
				$student['internship'],
				$student['program_status_id'],
				$student['internship_capstone_status_id'],
				$student['application_status_id'],
				$student['cohort'],
				$student['resume_url'],
				$student['linked_in_url'],
				$student['address1'],
				$student['address2'],
				$student['city'],
				$student['state'],
				$student['zipcode']);
	}

	function edit_student($student) {
		$sql = "UPDATE students s
					JOIN users u ON u.userId = s.userId
				SET FirstName = '$student[first]',
				MiddleName = '$student[middle]',
				LastName = '$student[last]',
				PreferredName = '$student[preferred]',
				StudentId = '$student[ssid]',
				Internship = '$student[internship]',
				Cohort = '$student[cohort]',
				ProgramStatusId = $student[program_status_id],
				InternCapstoneStatusId = $student[internship_capstone_status_id],
				ApplicationStatusId = $student[application_status_id],
				ResumeURL = '$student[resume_url]',
				LinkedInURL = '$student[linked_in_url]',
				EmailAddress = '$student[email]',
				PhoneNumber = '$student[phone]',
				StreetAddressLineOne = '$student[address1]',
				StreetAddressLineTwo = '$student[address2]',
				City = '$student[city]',
				State = '$student[state]',
				Zipcode = '$student[zipcode]'
				WHERE s.UserId = $student[id];";

		execute_upcert($sql);
	}

	function build_update_note_query($note) {
		$queryFormat = "update user_notes
						set Note_Type = '%s', Note_Text = '%s'
						where User_NoteId = %d;";

			return sprintf($queryFormat,
				$note['type'],
				$note['text'],
				$note['id']);
	}

	function edit_note($note) {
		$updateNoteQuery = build_update_note_query($note);
		execute_upcert($updateNoteQuery);
	}

	function build_insert_note_query($note) {
		$queryFormat = "insert user_notes(Note_Type, Note_Text, UserId)
						values ('%s', '%s', %d);";

			return sprintf($queryFormat,
				$note['type'],
				$note['text'],
				$note['UserId']);
	}

	function insert_note($note) {
		$insertNoteQuery = build_insert_note_query($note);
		execute_upcert($insertNoteQuery);
	}

	// This function is called on the delete.php page to construct the proper update sql statement
	function build_delete_student_query($orgId, $delete) {
    $query = "
        UPDATE students SET
        isDeleted=$delete
        WHERE UserId=$orgId
    ";
    return $query;
	}

    // Function to update the profile page for a student
    // used in profile/submit_edit.php
    function update_student_profile($userData) {
    	$sql = "UPDATE students s
					JOIN users u ON u.userId = s.userId
				SET ResumeURL = '$userData[resume_url]',
				LinkedInURL = '$userData[linked_in_url]',
				EmailAddress = '$userData[email]',
				PhoneNumber = '$userData[phone]',
				StreetAddressLineOne = '$userData[address1]',
				StreetAddressLineTwo = '$userData[address2]',
				City = '$userData[city]',
				State = '$userData[state]',
				Zipcode = '$userData[zipcode]'
				WHERE s.UserId = $userData[id];";
		execute_upcert($sql);
    }

    // Function to update the profile page for a non-student user
    // used in profile/submit_edit.php
    function update_user_profile($userData) {
    	$sql = "UPDATE users
    			SET EmailAddress = '$userData[email]',
    			PhoneNumber = '$userData[phone]'
    			WHERE UserId = $userData[id];";
    	execute_upcert($sql);
    }
?>