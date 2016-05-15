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
			. "<a href='detail.php?id=" . $student["UserId"] . "'>" 
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



function detailFieldIsVisible($field) {
	$invisibleFields = array("UserId", "Program Status Id", "Internship/Capstone Status Id", "Application Status Id");
	return !in_array($field, $invisibleFields);
}

function createStudentDetailTable($student) {
	$formattedTableRow = "
	<tr>
		<th>%s</th>
		<td>%s</td>
	</tr>";
	
	$tableHtml = "";
	foreach($student as $field => $value) {
		if (!detailFieldIsVisible($field))
			continue; 
		$tableHtml = $tableHtml . sprintf($formattedTableRow, $field, $value);
	}                    
                    
    return "<table id='internship_detail'>" . $tableHtml . "</table>";
}

function GetOptionSelectedStatus($optionIndex, $selectedIndex) {
	if ($selectedIndex == $optionIndex)
		return 'selected="selected"';
	return "";	
}

function CreateOptionsFrom($statuses, $selectedIndex) {
	$formattedOption = '<option value="%s" %s>%s</option>';

	foreach($statuses as $status) {
		$index = $status["Id"];
		$description = $status["Description"];
		$selectedStatus = GetOptionSelectedStatus($index, $selectedIndex);

		$optionsHtml = $optionsHtml . sprintf($formattedOption, $index, $selectedStatus, $description);		
	}

	return $optionsHtml;
}

?>
