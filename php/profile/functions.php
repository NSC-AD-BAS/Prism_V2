<?php
	// Functions for displaying the appropriate form to edit the user profile

	function edit_student_profile($user) {
		return '<tr>
                    <td>First</td>
                    <td>' . $user["Student First Name"] . '</td>
                </tr>
                <tr>
                    <td>Middle</td>
                    <td>' . $user["Student Middle Name"] . '</td>
                </tr>
                <tr>
                    <td>Last</td>
                    <td>' . $user["Student Last Name"] . '</td>
                </tr>
                <tr>
                	<td>Preferred Name</td>
                	<td>' . $user["Preferred Name"] . '</td>
                </tr>
                <tr>
                    <td>SSID</td>
                    <td>' . $user["SID"] . '</td>
                </tr>
                    <td>Cohort/Year</td>
                    <td>' . $user["Cohort"] . '</td>
                </tr>
                <tr>
                    <td>Program Status</td>
                    <td>' . $user["Program Status"] . '</td>
                </tr>
                <tr>
                	<td>Internship/Capstone Status</td>
                	<td>' . $user["Internship/Capstone Status"] . '</td>
                </tr>
                <tr>
                    <td>Internship</td>
                    <td>' . $user["Internship"] . '</td>
                </tr>
                <tr>
                	<td>Application Status</td>
                	<td>' . $user["Application Status"] . '</td>
                </tr>
                <tr>
                	<td>Resume</td>
                    <td><input class="textbox" name="user[resume_url]" value="' . $user["Resume"] . '"></td>
                </tr>
                <tr>
                	<td>LinkedIn Profile</td>
                	<td><input class="textbox" name="user[linked_in_url]" value="' . $user["LinkedIn Profile"] . '"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="textbox" name="user[email]" value="' . $user["Email"] . '"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input class="textbox" name="user[phone]" value="' . $user["Phone"] . '"></td>
                </tr>
                <tr>
                    <td>Address Line 1</td>
                    <td><input class="textbox" name="user[address1]" type="text" value="' . $user["Address 1"] . '"></td>
                </tr>
                <tr>
                    <td>Address Line 2</td>
                    <td><input class="textbox" name="user[address2]" type="text" value="' . $user["Address 2"] . '"></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input class="textbox" name="user[city]" type="text" value="' . $user["City"] . '"></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><input class="textbox" name="user[state]" type="text" value="' . $user["State"] . '"></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><input class="textbox" name="user[zipcode]" type="text" value="' . $user["Zipcode"] . '"></td>
                </tr>
                <input type="hidden" name="user[id]" value="' . $user["UserId"] . '">';
	}

	function edit_user_profile($user) {
		return '<tr>
                    <td>First</td>
                    <td>' . $user["First Name"] . '</td>
                </tr>
                <tr>
                    <td>Middle</td>
                    <td>' . $user["Middle Name"] . '</td>
                </tr>
                <tr>
                    <td>Last</td>
                    <td>' . $user["Last Name"] . '</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input class="textbox" name="user[phone]" value="' . $user["Phone"] . '"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="textbox" name="user[email]" value="' . $user["Email"] . '"></td>
                </tr>
                <input type="hidden" name="user[id]" value="' . $user["UserId"] . '">';              
	}
?>