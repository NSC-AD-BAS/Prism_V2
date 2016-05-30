<?php
/*
functions: 
    ***contacts folder***
    db_connect()
    get_contact_detail($id)
    
    ***db folder***
    db_connect()  !!!!!!!!DUPLICATE!!!!!!!!
    isAdmin()
    get_view_data($view)
    get_view_data_sorted($view, $field = "", $asc = "ASC")
    get_view_data_where($view, $orgId)
    get_companies_list()
    get_companies_list_sorted($field = "", $asc = true)
    get_company_detail($id)
    get_internships_by_company($id)
    get_contacts_by_company($id)
    get_deleted_companies()
    get_last_error($conn)
    get_internship_list()
    get_internship_detail($id)
    
    
    ***students folder***
    create_connection() get_many_rows($query)get_row($query)get_all_students()
    get_single_student($id)get_all_fields($id)
    get_all_intern_capstone_statuses()
    get_all_application_statuses() 
    get_all_program_statuses()
    isAdmin()
    get_prev_student($id) 
    get_next_student($id)
    get_student_notes($userId)
    get_note($id)
    get_searchable_student_data()
    student_matches_search($student, $searchQuery)
    build_search_result_query($userIds)
    search_students_for($searchQuery)
*/




function get_contact_detail($id)
{
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT cts.*, orgs.OrganizationName from organization_contacts cts INNER JOIN organizations orgs ON cts.OrganizationId = orgs.OrganizationId where cts.OrganizationId = ? limit 1");
    $stmt->bind_param("i", $id);
    /* execute query */
    $stmt->execute();

    $stmt->bind_result($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
        $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL,
        $OrganizationName);

    $output = false;
    while ($stmt->fetch()) {
        $output[] = [$ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
            $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL,
            $OrganizationName];
    }

    //clean-up result set and connection
    mysqli_close($conn);
    return $output;
}

?>


<?php

/*
    query_db.php - Stands up database connection and runs read-only queries against it.
    includes: db_connect.php
    included by: update_db and query_builder
    TODO: SECURITY - Move all DB function files outside of webroot to prevent direct access
*/

/*
    Handy DB Functions for everyone!
*/

//Stand-up and return a connect object
function db_connect() {
    include '../lib/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
}

//Determine if logged-in user is an admin.  See the fixer, needs improvement
function isAdmin() {
    //FIXME: This needs to (eventually) evaluate that the user is both logged in *and* has admin credentials.
    //Change to false to see nav and detail buttons auto-magically disappear.
    return true;
}

//Get the result set from an arbitrary view name
function get_view_data($view) {
    $conn = db_connect();
    $sql  = "SELECT * FROM $view";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

//Get sorted results from an arbitrary view
function get_view_data_sorted($view, $field = "", $asc = "ASC") {
    if ($field === "") {
        return get_view_data($view);
    }
    $conn = db_connect();
    $sql = "SELECT * FROM $view ORDER BY $field $asc";
    //DEBUG: Comment this out to see the query, run it manually and debug.
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

/*
    Organization Specific DB Queries
*/

//Get the data from some view where OrgID = some ID.
function get_view_data_where($view, $orgId) {
    $conn = db_connect();
    $sql  = "SELECT * FROM $view WHERE OrganizationId = $orgId";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

//Return the list of all companies
function get_companies_list() {
    return get_view_data('org_list');
}

//Return a sorted list of companies
function get_companies_list_sorted($field = "", $asc = true) {
    return get_view_data_sorted('org_list', $field, $asc);
}

//Get the org detail for an org
function get_company_detail($id) {
    return get_view_data_where('org_detail', $id);
}

//Get the internships for an org
function get_internships_by_company($id) {
    return get_view_data_where('internships', $id);
}

//Get the contacts for an org
function get_contacts_by_company($id) {
    return get_view_data_where('org_contact_list', $id);
}

//Get all deleted companies
function get_deleted_companies() {
    return get_view_data('org_list_archived');
}

//Get the last error and return it.
function get_last_error($conn) {
    return mysqli_error($conn);
}

/*
    Internship Specific DB Queries
*/

// Returns internship list result
function get_internship_list() {
    $conn = db_connect();
    $sql = "SELECT DISTINCT *
            FROM internship_list;";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

// Returns intership detail result
function get_internship_detail($id) {
    $conn = db_connect();
    $sql = "SELECT DISTINCT *
            FROM internship_detail
            WHERE InternshipId = $id
            LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

?>



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