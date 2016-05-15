<?php
    require "query_db.php";
    require "student_presentation.php";
    require "../companies/page_builder.php";

    $initiallySelectedIndex = 0;

    $internCapstoneStatuses = get_all_intern_capstone_statuses();
    $internCapstoneStatusesOptions = CreateOptionsFrom($internCapstoneStatuses, $initiallySelectedIndex);

    $applicationStatuses = get_all_application_statuses();
    $applicationStatusesOptions = CreateOptionsFrom($applicationStatuses, $initiallySelectedIndex);

    $programStatuses = get_all_program_statuses();
    $programStatusesOptions = CreateOptionsFrom($programStatuses, $initiallySelectedIndex);

    render_header("Students", false);
    render_nav("Create Student");

?>
    <form action="create_post.php" method="post">
        <table id="internship_detail">
            <tr>
                <th>First</th>
                <td><input name="student[first]" type="text"></td>
            </tr>
            <tr>
                <th>Middle</th>
                <td><input name="student[middle]" type="text"></td>
            </tr>
            <tr>
                <th>Last</th>
                <td><input name="student[last]" type="text"></td>
            </tr>
            <tr>
                <th>Preferred Name</th>
                <td><input name="student[preferred]"type="text"></td>
            </tr>
            <tr>
                <th>SSID</th>
                <td><input name="student[ssid]" type="text"></td>
            </tr>
            <tr>
                <th>Cohort/Year</th>
                <td><input name="student[cohort]" type="text"></td>
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
                <td><input name="student[internship_url]" type="text"></td>
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
                <td><input name="student[resume_url]" type="text"></td>
            </tr>
            <tr>
                <th>LinkedIn Profile</th>
                <td><input name="student[linked_in_url]" type="text"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input name="student[email]"></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input name="student[phone]"></td>
            </tr>
            <tr>
                <th>Address Line 1</th>
                <td><input name="student[address1]" type="text"></td>
            </tr>
            <tr>
                <th>Address Line 2</th>
                <td><input name="student[address2]" type="text"></td>
            </tr>
            <tr>
                <th>City</th>
                <td><input name="student[city]" type="text"></td>
            </tr>
            <tr>
                <th>State</th>
                <td><input name="student[state]" type="text"></td>
            </tr>
            <tr>
                <th>Zipcode</th>
                <td><input name="student[zipcode]" type="text"></td>
            </tr>
            <tr><td><input type="submit" value="Create Student"></td></tr>
        </table>
    </form>
    <a class="button" href="list.php"><div>Back to List</div></a>
<?php render_footer(); ?>
