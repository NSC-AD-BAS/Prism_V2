<?php
/*
	Profile page for displaying data that a student can edit
*/
	// Import statements. I'm using the ones I used previously for students
	require "../students/query_db.php";
	require "../students/student_presentation.php";
	require "../render/page_builder.php";
	include_once("../login/login_utils.php");

	# Session management
	session_start();
	if (!is_logged_in()) {
	    to_login();
	}

	$userType = $_SESSION["user_type"];
	$userId = $_SESSION["user_id"];
	// Check if the user is a student or not
	if($userType == "Student") {
		$userData = get_single_student($userId);
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
		<table>
			<?=$detailTable?>
			<!--<?php foreach($_SESSION as $element) {
				echo $element . "<br>";
				} ?>-->
		</table>
		<hr>
		<div class="lower_nav">
			<a href="edit.php?id=<?=$userId?>" class="button"><div>Edit</div></a>
		</div>
	</div>
</div>
<?php render_footer(); ?>