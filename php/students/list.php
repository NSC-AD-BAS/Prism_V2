<?php
    require "query_db.php";
    require "student_presentation.php";
    require "../companies/page_builder.php";
    include_once("../login/login_utils.php");

	# Session management
	session_start();
	if (!is_logged_in()) {
	    to_login();
	}


    $students = [];
    if (isset($_GET['q'])) {
        $searchQuery = $_GET['q'];
        $students = search_students_for($searchQuery);
    } else {
        $students = get_all_students();
    }
        
    $studentList = createStudentList($students);
    

    render_header("Students", false);
    render_nav("Student List", "list.php?q=");
?>
   
   <?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?php render_footer(); ?>