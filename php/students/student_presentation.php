<?php

function createStudentTable($students) {
	$html = "<table>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Cohort</th>
                        <th>Active Status</th>
                        <th>Internship/Capstone Status</th>
                        <th>Application Status</th>
                    </tr>";
	
	foreach ($students as $student) {

		$studentRow = "<tr><td><input type='checkbox' name='1' value='selected'></td>"
			. "<td><a href='detail.php?id=" . $student["StudentKeyId"] . "'>" . $student["Student Name"] . "</a></td>"
			. "<td>" . $student["Cohort"] . "</td>"
			. "<td>" . $student["Program Status"] . "</td>"
			. "<td>" . $student["Internship/Capstone Status"] . "</td>"
			. "<td>" . $student["Application Status"] . "</td></tr>";

		$html = $html . $studentRow;
	}

	$html = $html . "</table>";
	return $html;
}

function createStudentList($students) {
	$html = "<ul class='outer'>
                <li class='tableHead'>
                	<ul class='inner6'>
                        <li>Select</li>
                        <li>Name</li>
                        <li>Cohort</li>
                        <li>Active Status</li>
                        <li>Internship/Capstone Status</li>
                        <li>Application Status</li>
                    </ul>";
	
	foreach ($students as $student) {

		$studentRow = "<li><li><input type='checkbox' name='1' value='selected'></li>"
			. "<a href='detail.php?id=" . $student["StudentKeyId"] . "'>" 
			. "<ul class='inner6'>" 
			. "<li>" . $student["Student Name"] . "</li>"
			. "<li>" . $student["Cohort"] . "</li>"
			. "<li>" . $student["Program Status"] . "</li>"
			. "<li>" . $student["Internship/Capstone Status"] . "</li>"
			. "<li>" . $student["Application Status"] . "</li>"
			. "</ul>"
			. "</a>"
			. "</li>"
			. "</li>"
			. "</ul>";

		$html = $html . $studentRow;
	}

	$html = $html . "</table>";
	return $html;
}

?>