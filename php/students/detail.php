<?php
	require "query_db.php";
	require "student_presentation.php";
	require "../companies/page_builder.php";
	
	$studentId = $_GET["id"];
	$student = get_single_student($studentId);
	
	$next = $studentId + 1;
	$prev = $studentId - 1;

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	$detailTable = createStudentDetailTable($student);
	render_header("Students", true);
	render_nav($studentFullName);
?>

	<a href="detail.php?id=<?=$prev?>" class="button"><div>Previous</div></a>
    <a href="detail.php?id=<?=$next?>" class="button"><div>Next</div></a>

    <?=$detailTable?> 

    <a href="list.php" class="button"><div>Back to List</div></a>
    <?php
    	echo '<a href="edit.php?id=' . $studentId . '" class="button"><div>Edit</div></a>';
    ?>
    <a href="delete.php" class="button"><div>Delete</div></a>
    
</div>
<?php render_footer(); ?>