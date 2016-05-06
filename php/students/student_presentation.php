<?php

function createStudentList($students) {
	$html = "<ul class='outer'>
                <li class='tableHead'>
                	<ul class='inner5'>
                        <li>Name</li>
                        <li>Cohort</li>
                        <li>Active Status</li>
                        <li>Internship / Capstone Status</li>
                        <li>Application Status</li>
                    </ul>";
	
	foreach ($students as $student) {

		$studentRow = "<li>"
			. "<a href='detail.php?id=" . $student["StudentKeyId"] . "'>" 
			. "<ul class='inner5'>" 
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

function createStudentDetailTable($student) {
	$html = "<table id='internship_detail'>";
	$formattedTableRow = "
	<tr>
		<th>%s</th>
		<td>%s</td>
	</tr>";
	
	foreach($student as $field => $value) {
		$html = $html . sprintf($formattedTableRow, $field, $value);
	}                    
                    
    return $html . "</table>";
}

?>
