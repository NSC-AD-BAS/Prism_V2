<?php
require "query_db.php";
	$student_query = get_single_student($_GET["id"]);
	echo '<!DOCTYPE html>
			<html lang="en">
			<head>
			    <title>PRISM - ';
			    echo $student_query["Student First Name"] . ' ' . $student_query["Student Last Name"];

	echo ' - Detail</title>
			    <meta charset="utf-8">
			    <link rel="stylesheet" type="text/css" href="../../html/style/site.css">
			</head>
			<body>
			    <header><h1>[Student Name] - Detail</h1></header>
			    <nav>
			        <ul>
			            <li class="left"><a href="../internships/list.php">Internships</a></li> &nbsp;
			            <li class="left"><a href="../companies/list.php">Companies</a></li> &nbsp;
			            <li class="left"><a href="../students/list.php">Students</a></li> &nbsp;
			            <li class="left"><a href="../admin/list.php">(Admin)</a></li> &nbsp;
			        </ul>
			    </nav>
			    <br>
			    <main>
			        <ul>
			            <li><a href="#">Previous</a></li>
			            <li><a href="#">Next</a></li>
			            <li><a href="edit.html">Edit</a></li>
			        </ul>
			        <fieldset>
			            <legend><strong>Student Detail</strong></legend>
			            <table>';
	
	echo '<tr><td>First</td><td>' . $student_query["Student First Name"] . '</td></tr>
		<tr><td>Middle</td><td>' . $student_query["Student Middle Name"] . '</td></tr>
		<tr><td>Last</td><td>' . $student_query["Student Last Name"] . '</td></tr>
		<tr><td>SID</td><td>' . $student_query["SID"] . '</td></tr>
		<tr><td>Cohort</td><td>' . $student_query["Cohort"] . '</td></tr>
		<tr><td>Program Status</td><td>' . $student_query["Program Status"] . '</td></tr>
		<tr><td>Internship</td><td>' . $student_query["Internship"] . '</td></tr>
		<tr><td>Phone</td><td>' . $student_query["Phone"] . '</td></tr>
		<tr><td>Email</td><td>' . $student_query["Email"] . '</td></tr>
		<tr><td>Address 1</td<td>' . $student_query["Address 1"] . '</td></tr>
		<tr><td>Address 2</td><td>' . $student_query["Address 2"] . '</td></tr>
		<tr><td>City</td><td>' . $student_query["City"] . '</td></tr>
		<tr><td>State</td><td>' . $student_query["State"] . '</td></tr>
		<tr><td>Notes</td><td><div class="boxed">' . $student_query["Notes"] . '</div></td></tr>';

	echo '</table>
        </fieldset>
        <br>
        <div class="buttons">
            <table>
                <tr>
                    <td><a href="list.html">Back to List</a></td>
                    <td><a href="list.html">Cancel</a></td>
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