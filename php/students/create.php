<?php
    require "../login/validate_session.php";
    require_once("../includes/config.php");

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
    <div class="wrapper">
        <div class="detail_table">
            <form action="create_post.php" method="post">
                <table>
                    <tr>
                        <td>First</td>
                        <td><input class="textbox" name="student[first]" type="text" required></td>
                    </tr>
                    <tr>
                        <td>Middle</td>
                        <td><input class="textbox" name="student[middle]" type="text"></td>
                    </tr>
                    <tr>
                        <td>Last</td>
                        <td><input class="textbox" name="student[last]" type="text" required></td>
                    </tr>
                    <tr>
                        <td>Preferred Name</td>
                        <td><input class="textbox" name="student[preferred]"type="text"></td>
                    </tr>
                    <tr>
                        <td>SSID</td>
                        <td><input class="textbox" name="student[ssid]" type="text" required></td>
                    </tr>
                    <tr>
                        <td>Cohort/Year</td>
                        <td><input class="textbox" name="student[cohort]" type="text" required></td>
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
                        <td><input class="textbox" name="student[internship]" type="text"></td>
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
                        <td><input class="textbox" name="student[resume_url]" type="text"></td>
                    </tr>
                    <tr>
                        <td>LinkedIn Profile</td>
                        <td><input class="textbox" name="student[linked_in_url]" type="text"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input class="textbox" name="student[email]"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input class="textbox" name="student[phone]"></td>
                    </tr>
                    <tr>
                        <td>Address Line 1</td>
                        <td><input class="textbox" name="student[address1]" type="text"></td>
                    </tr>
                    <tr>
                        <td>Address Line 2</td>
                        <td><input class="textbox" name="student[address2]" type="text"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input class="textbox" name="student[city]" type="text"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input class="textbox" name="student[state]" type="text"></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td><input class="textbox" name="student[zipcode]" type="text"></td>
                    </tr>
                </table>
                <hr>
                <div class="lower_nav">
                    <input class="form_button" type="submit" value="Create Student">
                    <a class="button" href="list.php"><div>Student List</div></a>
                </div>
            </form>
        </div>
    </div>
    
<?php render_footer(); ?>
