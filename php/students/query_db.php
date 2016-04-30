<?php
/*
This script is intended to only generate the table for displaying the list of students.
The entirety of the table is created here, including the labels for the colums.
-- Austin
*/
	function list_students() {
		require "../lib/db_connect.php";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM student_list;";
		$result = mysqli_query($conn, $sql);

		echo "<table><tr>
			<th>Select</th>
			<th>Student Name</th>
			<th>Cohort</th>
			<th>Program Status</th>
			<th>Internship/Capstone Status</th>
			<th>Application Status</th>";

		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td><input type='checkbox' name='1' value='selected'></td>
				<td><a href='detail.html?id='" . $row["StudentKeyId"] . "'>" . $row["Student Name"] . "</a></td>
				<td>" . $row["Cohort"] . "</td>
				<td>" . $row["Program Status"] . "</td>
				<td>" . $row["Internship/Capstone Status"] . "</td>
				<td>" . $row["Application Status"] . "</td></tr>";
			}
		}

		echo "</table>";
	}
?>