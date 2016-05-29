<?php
/*
	Profile page for displaying data that a student can edit
*/
	// Import statements. I'm using the ones I used previously for students
	require "../students/query_db.php";
	require "../students/student_presentation.php";
	require "../render/page_builder.php";
	include_once("../login/login_utils.php");

	$studentId = $_SESSION["user_id"];
	$student = get_single_student($studentId);
	$navTitle = "Profile";

	$detailTable = createStudentDetailTableRows($student);

	render_header("Profile", true);
	render_nav($navTitle, "detail.php");
?>

<div class="wrapper">
	<div class="detail_table">
		<table>
			<?=$detailTable?>
			<?php foreach($_SESSION as $element) {
				echo $element . "<br>";
				} ?>
		</table>
	</div>
</div>
<?php render_footer(); ?>