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

    $students = get_all_students();
    $studentList = createStudentList($students);
    

    render_header("Students", false);
    render_nav("Student List");
?>
   
   <?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?php render_footer(); ?>