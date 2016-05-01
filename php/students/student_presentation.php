<?php

function createStudentTable($students) {
	$html = "<table>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>SID</th>
                        <th>Cohort</th>
                        <th>Active Status</th>
                        <th>Internship/Capstone Status</th>
                        <th>Application Status</th>
                    </tr>";
	
	foreach ($students as $student) {

		$studentRow = "<tr><td><input type='checkbox' name='1' value='selected'></td>"
			. "<td><a href='detail.html?id=" . $student["StudentKeyId"] . "'>" . $student["Student Name"] . "</a></td>"
			. "<td>" . $student["Cohort"] . "</td>"
			. "<td>" . $student["Program Status"] . "</td>"
			. "<td>" . $student["Internship/Capstone Status"] . "</td>"
			. "<td>" . $student["Application Status"] . "</td></tr>";

		$html = $html . $studentRow;
	}

	$html = $html . "</table>";
	return $html;
}

?>