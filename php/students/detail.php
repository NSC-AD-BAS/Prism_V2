<?php
	require "../login/validate_session.php";
	require "query_db.php";
	require "student_presentation.php";
	require "../render/page_builder.php";
	
	$studentId = $_GET["id"];
	$student = get_single_student($studentId);
	$userId = $student["UserId"];
	
	$next = get_next_student($studentId);
	$prev = get_prev_student($studentId);

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	$detailTable = createStudentDetailTableRows($student);
	
	$studentNotes = get_student_notes($studentId);
	$notesTableRows = createStudentNotesTableRows($studentNotes);

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
			    <a href="delete_confirmation.php?id=<?=$studentId?>" class="button"><div>Delete</div></a>
			</div>
		</div>
	</div>

	<div class="wrapper">
        <div class="detail_table">
        	<h3>Notes</h3>
        	<hr>
		    <table>
		    	<tr><td><strong>Note Type</strong></td><td><strong>Text</strong></td></tr></strong>
		    	<?=$notesTableRows?> 	
		    </table>
		    <hr>
			<div class="lower_nav">
			    <a href="create_note.php?UserId=<?=$userId?>" class="button"><div>Create Note</div></a>
			</div>
		</div>
	</div>
<?php render_footer(); ?>
