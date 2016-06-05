<?php
	// Functions for displaying the appropriate form to edit the user profile

	function edit_student_profile($student) {
		return '<tr>
                    <td>First</td>
                    <td>' . $student["Student First Name"] . '</td>
                </tr>
                <tr>
                    <td>Middle</td>
                    <td>' . $student["Student Middle Name"] . '</td>
                </tr>
                <tr>
                    <td>Last</td>
                    <td>' . $student["Student Last Name"] . '</td>
                </tr>
                <tr>
                	<td>Preferred Name</td>
                	<td>' . $student["Preferred Name"] . '</td>
                </tr>
                <tr>
                    <td>SSID</td>
                    <td>' . $student["SID"] . '</td>
                </tr>
                    <td>Cohort/Year</td>
                    <td>' . $student["Cohort"] . '</td>
                </tr>
                <tr>
                    <td>Program Status</td>
                    <td>' . $student["Program Status"] . '</td>
                </tr>
                <tr>
                	<td>Internship/Capstone Status</td>
                	<td>' . $student["Internship/Capstone Status"] . '</td>
                </tr>
                <tr>
                    <td>Internship</td>
                    <td>' . $student["Internship"] . '</td>
                </tr>
                <tr>
                	<td>Application Status</td>
                	<td>' . $student["Application Status"] . '</td>
                </tr>
                <tr>
                	<td>Resume</td>
                    <td><input class="textbox" name="student[resume_url]" value="' . $student["Resume"] . '"></td>
                </tr>
                <tr>
                	<td>LinkedIn Profile</td>
                	<td><input class="textbox" name="student[linked_in_url]" value="' . $student["LinkedIn Profile"] . '"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="textbox" name="student[email]" value="' . $student["Email"] . '"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input class="textbox" name="student[phone]" value="' . $student["Phone"] . '"></td>
                </tr>
                <tr>
                    <td>Address Line 1</td>
                    <td><input class="textbox" name="student[address1]" type="text" value="' . $student["Address 1"] . '"></td>
                </tr>
                <tr>
                    <td>Address Line 2</td>
                    <td><input class="textbox" name="student[address2]" type="text" value="' . $student["Address 2"] . '"></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input class="textbox" name="student[city]" type="text" value="' . $student["City"] . '"></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><input class="textbox" name="student[state]" type="text" value="' . $student["State"] . '"></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><input class="textbox" name="student[zipcode]" type="text" value="' . $student["Zipcode"] . '"></td>
                </tr>';
	}

	function edit_user_profile() {

	}
?>