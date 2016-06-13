<?php
	require "../login/validate_session.php";
	require "../db/query_db.php";
	require "student_presentation.php";
	require "../render/page_builder.php";
	
	$studentId = $_GET["id"];
	$student = get_single_student($studentId);
	$userId = $student["UserId"];
	
	$nextStudentId = get_next_student($studentId);
	$prevStudentId = get_prev_student($studentId);

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	$detailTable = createStudentDetailTableRows($student);
	
	$studentNotes = get_student_notes($studentId);
	$notesTableRows = createStudentNotesTableRows($studentNotes);

	render_header("Students", true);
	render_nav($studentFullName);

	$previousStudentLink = $prevStudentId ? createDetailNavLink($prevStudentId, "Previous") : "";
	$nextStudentLink = $nextStudentId ? createDetailNavLink($nextStudentId, "Next") : "";
?>

	<?=$previousStudentLink?>
	<?=$nextStudentLink?>

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
		    <table class="notetable">
                <col class="notedefs">
			    	<tr><td><strong>Type</strong></td><td><strong>Notes</strong></td></tr></strong>
			    	<?=$notesTableRows?> 	
			    </col>
		    </table>
		    <hr>
			<div class="lower_nav">
			    <a href="create_note.php?UserId=<?=$userId?>" class="button"><div>Create Note</div></a>
			</div>
		</div>
	</div>
<?php render_footer(); ?>
