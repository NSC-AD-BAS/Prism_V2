<?php
	require "query_db.php";
	require "student_presentation.php";
	
	$studentId = $_GET["id"];
	$student = get_single_student($studentId);
	
	$next = $studentId + 1;
	$prev = $studentId - 1;

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	$detailTable = createStudentDetailTable($student);
?>

<html lang="en">
	<head>
		<title>PRISM - <?=$studentFullName?> - Detail</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../style/site.css">
	</head>
	
	<body>
	    <nav>
	        <ul>
	            <li class="left"><a href="../internships/list.php">Internships</a></li> &nbsp;
	            <li class="left"><a href="../companies/list.php">Companies</a></li> &nbsp;
	            <li class="left"><a href="../students/list.php">Students</a></li> &nbsp;
	            <li class="left"><a href="../admin/list.php">(Admin)</a></li> &nbsp;
	        </ul>
	    </nav>

	    <main>
	    	<h1><?=$studentFullName?> - Detail</h1>
	        <ul>
	            <li><a href="detail.php?id=<?=$prev?>">Previous</a></li>
	            <li><a href="detail.php?id=<?=$next?>">Next</a></li>
	            <li><a href="edit.php?id=<?=$studentId?>">Edit</a></li>
	        </ul>
	        <?=$detailTable?> 
        <div class="buttons">
            <table>
                <tr>
                    <td><a href="list.php">Back to List</a></td>
                    <td><a href="list.php">Cancel</a></td>
                </tr>
            </table>
        </div>
    </main>
    <br>
    <footer>
        <p><small>North Seattle College - PRISM &copy; 2016</small></p>
    </footer>

</body>
</html>';
?>