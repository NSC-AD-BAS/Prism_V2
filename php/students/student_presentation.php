<?php

function createStudentList($students, $programStatusOptions) {
	$headerFormat = "<ul class='outer'>
                <li class='tableHead'>
                	<ul class='inner5'>
                        <li>Name</li>
                        <li>Cohort</li>
                        <li>
                        	Program Status
                        	<form method='GET' action='list.php'>
                        		<select onchange='this.form.submit()' name='programStatusId'>
                        			%s
                        		</select>
                        	</form>
                        </li>
                        <li>Internship / Capstone Status</li>
                        <li>Application Status</li>
                    </ul>
                </li>\n";
    $html = sprintf($headerFormat, $programStatusOptions);
	
	foreach ($students as $student) {

		$studentRowFormat = 
		"<li>
			<a href='detail.php?id=%d'>
				<ul class='inner5'>
					<li>%s</li>
					<li>%s</li>
					<li>%s</li>
					<li>%s</li>
					<li>%s</li>
				</ul>
			</a>
		</li>\n";

		$fullName = $student["Student Last Name"] . ", " . $student["Student First Name"];
		$html = $html . sprintf($studentRowFormat
			, $student["UserId"]
			, $fullName
			, $student["Cohort"]
			, $student["Program Status"]
			, $student["Internship/Capstone Status"]
			, $student["Application Status"] );
	}

	$html = $html . "</ul>";
	return $html;
}



function detailFieldIsVisible($field) {
	$invisibleFields = array("UserId"
		, "Program Status Id"
		, "Internship/Capstone Status Id"
		, "Application Status Id"
		, "isDeleted");
	return !in_array($field, $invisibleFields);
}

function createStudentDetailTableRows($student) {
	$formattedTableRow = "
	<tr>
		<td>%s</td>
		<td>%s</td>
	</tr>";
	
	$tableRowsHtml = "";
	foreach($student as $field => $value) {
		if (!detailFieldIsVisible($field))
			continue; 
		$tableRowsHtml = $tableRowsHtml . sprintf($formattedTableRow, $field, $value);
	}                    
                    
    return $tableRowsHtml;
}

function GetOptionSelectedStatus($optionIndex, $selectedIndex) {
	if ($selectedIndex == $optionIndex)
		return 'selected="selected"';
	return "";	
}

function CreateOptionsFrom($statuses, $selectedIndex) {
	$formattedOption = '<option value="%s" %s>%s</option>';
	$optionsHtml = "";
	foreach($statuses as $status) {
		$index = $status["Id"];
		$description = $status["Description"];
		$selectedStatus = GetOptionSelectedStatus($index, $selectedIndex);

		$optionsHtml = $optionsHtml . sprintf($formattedOption, $index, $selectedStatus, $description);		
	}

	return $optionsHtml;
}

function createStudentNotesTableRows($notes) {
	$formatter = '
	<tr>
		<td>%s</td>
		<td><a href="edit_note.php?id=%s"><textarea readonly class="textarea-readonly">%s</textarea></a></td></tr>';
	$html = "";

	foreach($notes as $note) {
		$index = $note["NoteId"];
		$type = $note["Type"];
		$text = $note["Text"];

		$html = $html . sprintf($formatter, $type, $index, $text);		
	}

	return $html;

}

function createShowDeletedLink($showingDeleted) {
	$linkFormat = '<a class="aside" href="list.php%s">%s</a>';

	$parameter = $showingDeleted ? "" : "?showDeleted=1";
	$linkText = $showingDeleted ? "Hide Deleted" : "Show Deleted";
	$html = sprintf($linkFormat, $parameter, $linkText);

	return $html;
}

function createDetailNavLink($id, $title) {
	$link = "<a href='detail.php?id=$id' class='button'><div>$title</div></a>";
	return $link;
}

?>
