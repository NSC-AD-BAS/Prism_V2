<?php
	// Page for editing personal data
	require "../students/query_db.php";
	require "../students/student_presentation.php";
	require "../render/page_builder.php";
	require "functions.php";
	require_once("../login/login_utils.php");

	# Session management
	session_start();
	if (!is_logged_in()) {
	    to_login();
	}

	error_log("Fix the problem");
	$userType = $_SESSION["user_type"];
	$userId = $_SESSION["user_id"];
	// Check if the user is a student or not
	if($userType == "Student") {
		$userData = get_single_student($userId);
		$echoForm = edit_student_profile($userData);
	}
	else {
		$userData = get_user_profile($userId);
	}
	//$userData = get_single_student($studentId);
	$navTitle = "Profile";

	$detailTable = createStudentDetailTableRows($userData);

	render_header("Profile", true);
	render_nav($navTitle, "detail.php");
?>
<div class="wrapper">
    <div class="detail_table">
        <form action="submit_edit.php" method="post">
            <table>
 				<?=$echoForm?>
            </table>
            <hr>
            <div>
                <input class="form_button" type="submit" value="Save">
                <a class="button" href="detail.php"><div>Cancel</div></a>
            </div>
        </form>
    </div>
</div>
<?php render_footer(); ?>