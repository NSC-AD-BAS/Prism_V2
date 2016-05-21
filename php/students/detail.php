<?php
	require "query_db.php";
	require "student_presentation.php";
	require "../companies/page_builder.php";
	
	$studentId = $_GET["id"];
	$student = get_single_student($studentId);
	
	$next = get_next_student($studentId);
	$prev = get_prev_student($studentId);

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	$detailTable = createStudentDetailTableRows($student);
	render_header("Students", true);
	render_nav($studentFullName);
?>

	<a href="detail.php?id=<?=$prev?>" class="button"><div>Previous</div></a>
    <a href="detail.php?id=<?=$next?>" class="button"><div>Next</div></a>

    <div class="wrapper">
        <div class="detail_table">
		    <table>
		    	<?=$detailTable?> 	
		    </table>
		    <hr>
			<div class="lower_nav">
				<a href="list.php" class="button"><div>Student List</div></a>
			    <a href="edit.php?id=<?=$studentId?>" class="button"><div>Edit</div></a>
			    <a href="delete.php" class="button"><div>Delete</div></a>
			</div>
		</div>
	</div>
</div>
<?php render_footer(); ?>