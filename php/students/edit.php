<?php
    require "../login/validate_session.php";
    require 'query_db.php';
    require "../render/page_builder.php";
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
<div class="wrapper">
    <div class="detail_table">
        <form action="submit_edit.php" method="post">
            <table>
                <tr>
                    <td>First</td>
                    <td><input class="textbox" name="student[first]" type="text" value="<?=$student['Student First Name']?>" require></td>
                </tr>
                <tr>
                    <td>Middle</td>
                    <td><input class="textbox" name="student[middle]" type="text" value="<?=$student['Student Middle Name']?>"></td>
                </tr>
                <tr>
                    <td>Last</td>
                    <td><input class="textbox" name="student[last]" type="text" value="<?=$student['Student Last Name']?>" require></td>
                </tr>
                <tr>
                	<td>Preferred Name</td>
                	<td><input class="textbox" name="student[preferred]" type="text" value="<?=$student['Preferred Name']?>"></td>
                </tr>
                <tr>
                    <td>SSID</td>
                    <td><input class="textbox" name="student[ssid]" type="text" value="<?=$student['SID']?>" require></td>
                </tr>
                    <td>Cohort/Year</td>
                    <td><input class="textbox" name="student[cohort]" type="text" value="<?=$student['Cohort']?>" require></td>
                </tr>
                <tr>
                    <td>Program Status</td>
                    <td>
                        <select class="textbox" name="student[program_status_id]">
                            <?=$programStatusesOptions?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Internship/Capstone Status</td>
                	<td>
                		<select class="textbox" name="student[internship_capstone_status_id]">
                			<?=$internCapstoneStatusesOptions?>
                		</select>
                	</td>
                </tr>
                <tr>
                    <td>Internship</td>
                    <td><input class="textbox" name="student[internship]" type="text" value="<?=$student['Internship']?>"></td>
                </tr>
                <tr>
                	<td>Application Status</td>
                	<td>
                		<select class="textbox" name="student[application_status_id]">
                			<?=$applicationStatusesOptions?>
                		</select>
                	</td>
                </tr>
                <tr>
                	<td>Resume</td>
                    <td><input class="textbox" name="student[resume_url]" value="<?=$student['Resume']?>"></td>
                </tr>
                <tr>
                	<td>LinkedIn Profile</td>
                	<td><input class="textbox" name="student[linked_in_url]" value="<?=$student['LinkedIn Profile']?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input class="textbox" name="student[email]" value="<?=$student['Email']?>"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input class="textbox" name="student[phone]" value="<?=$student['Phone']?>"></td>
                </tr>
                <tr>
                    <td>Address Line 1</td>
                    <td><input class="textbox" name="student[address1]" type="text" value="<?=$student['Address 1']?>"></td>
                </tr>
                <tr>
                    <td>Address Line 2</td>
                    <td><input class="textbox" name="student[address2]" type="text" value="<?=$student['Address 2']?>"></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input class="textbox" name="student[city]" type="text" value="<?=$student['City']?>"></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><input class="textbox" name="student[state]" type="text" value="<?=$student['State']?>"></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><input class="textbox" name="student[zipcode]" type="text" value="<?=$student['Zipcode']?>"></td>
                </tr>  
                <input type="hidden" name="student[id]" value="<?=$student['UserId']?>">
            </table>
            <hr>
            <div>
                <input class="form_button" type="submit" value="Save">
                <a class="button" href="list.php"><div>Cancel</div></a>
            </div>
        </form>
    </div>
</div>
<?php render_footer(); ?>
