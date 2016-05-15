<?php
    require 'query_db.php';
    require "../companies/page_builder.php";
    require "student_presentation.php";

    $studentId = $_GET['id'];
    $student = get_single_student($studentId);
    $studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);

    $internCapstoneStatuses = get_all_intern_capstone_statuses();
    $internCapstoneStatusesOptions = CreateOptionsFrom($internCapstoneStatuses, $student["Internship/Capstone Status Id"]);

    $applicationStatuses = get_all_application_statuses();
    $applicationStatusesOptions = CreateOptionsFrom($applicationStatuses, $student["Application Status Id"]);

    $programStatuses = get_all_program_statuses();
    $programStatusesOptions = CreateOptionsFrom($programStatuses, $student["Program Status Id"]);

    render_header("Students", false);
    render_nav($studentFullName);

?>
<form action="submit_edit.php" method="post">
    <table id="internship_detail">
        <tr>
            <th>First</th>
            <?php
                echo '<td><input name="student[first]" type="text" value="' . $student['Student First Name'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Middle</th>
            <?php
                echo '<td><input name="student[middle]" type="text" value="' . $student['Student Middle Name'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Last</th>
            <?php
                echo '<td><input name="student[last]" type="text" value="' . $student['Student Last Name'] . '"></td>';
            ?>
        </tr>
        <tr>
        	<th>Preferred Name</th>
        	<?php
        		echo '<td><input name="student[preferred]" type="text" value="' . $student['Preferred Name'] . '"></td>';
        	?>
        <tr>
            <th>SSID</th>
            <?php
                echo '<td><input name="student[ssid]" type="text" value="' . $student['SID'] . '"></td>';
            ?>
        </tr>
            <th>Cohort/Year</th>
            <?php
                echo '<td><input name="student[cohort]" type="text" value="' . $student['Cohort'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Program Status</th>
            <td>
                <select name="student[program_status_id]">
                    <?=$programStatusesOptions?>
                </select>
            </td>
        </tr>
        <tr>
        	<th>Internship/Capstone Status</th>
        	<td>
        		<select name="student[internship_capstone_status_id]">
        			<?=$internCapstoneStatusesOptions?>
        		</select>
        	</td>
        </tr>
        <tr>
            <th>Internship</th>
            <?php
                echo '<td><input name="student[internship_url]" type="text" value="' . $student['Internship'] . '"></td>';
            ?>
        </tr>
        <tr>
        	<th>Application Status</th>
        	<td>
        		<select name="student[application_status_id]">
        			<?=$applicationStatusesOptions?>
        		</select>
        	</td>
        </tr>
        <tr>
        	<th>Resume</th>
        	<?php
        		echo '<td><input name="student[resume_url]" value="' . $student['Resume'] . '"></td>';
        	?>
        </tr>
        <tr>
        	<th>LinkedIn Profile</th>
        	<?php
        		echo '<td><input name="student[linked_in_url]" value="' . $student['LinkedIn Profile'] . '"></td>';
        	?>
        </tr>
        <tr>
            <th>Email</th>
            <?php
            	echo '<td><input name="student[email]" value="' . $student['Email'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Phone</th>
            <?php
                echo '<td><input name="student[phone]" value="' . $student['Phone'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Address Line1</th>
            <?php
                echo '<td><input name="student[address1]" type="text" value="' . $student['Address 1'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Address Line2</th>
            <?php
                echo '<td><input name="student[address2]" type="text" value="' . $student['Address 2'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>City</th>
            <?php
                echo '<td><input name="student[city]" type="text" value="' . $student['City'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>State</th>
            <?php
                echo '<td><input name="student[state]" type="text" value="' . $student['State'] . '"></td>';
            ?>
        </tr>
        <tr>
            <th>Zipcode</th>
            <?php
                echo '<td><input name="student[zipcode]" type="text" value="' . $student['Zipcode'] . '"></td>';
            ?>
        </tr>
        <tr><td><input type="submit" value="Edit Student"></td></tr>
        <?php
        	echo '<input type="hidden" name="student[id]" value="' . $student['UserId'] . '">';
        ?>
    </table>
</form>
<a class="button" href="list.php"><div>Back to List</div></a>
<?php render_footer(); ?>