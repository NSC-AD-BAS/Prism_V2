<?php
    require "query_db.php";
    require "student_presentation.php";

    $initiallySelectedIndex = 0;

    $internCapstoneStatuses = get_all_intern_capstone_statuses();
    $internCapstoneStatusesOptions = CreateOptionsFrom($internCapstoneStatuses, $initiallySelectedIndex);

    $applicationStatuses = get_all_application_statuses();
    $applicationStatusesOptions = CreateOptionsFrom($applicationStatuses, $initiallySelectedIndex);

    $programStatuses = get_all_program_statuses();
    $programStatusesOptions = CreateOptionsFrom($programStatuses, $initiallySelectedIndex);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRISM - Create Student</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style/site.css">
</head>
<body>
    <nav>
            <ul>
                <li class="left"><a href="../internships/list.php">Internships</a></li>
                <li class="left"><a href="../companies/list.php">Companies</a></li>
                <li class="left"><a href="../students/list.php">Students</a></li>
                <li class="left"><a href="../admin/admin.php">Admin</a></li>

                <li class="right"><a href="list.php">Logout</a></li>
                <li class="right"><a href="list.php">Profile</a></li>

                <li id="welcome" class="right">Welcome, You!</li>
            </ul>
        </nav>

        <main>
            <h1>Create Student</h1>
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
                    </tr>
                        <th>Internship/Capstone Status</th>
                        <td>
                            <select name="student[internship_capstone_status_id]">
                               <?=$internCapstoneStatusesOptions?>
                            </select>
                        </td>
                    </tr>
                    </tr>
                        <th>Internship URL</th>
                        <td><input name="student[internship_url]" type="text"></td>
                    </tr>
                    </tr>
                        <th>Application Status</th>
                        <td>
                            <select name="student[application_status_id]">
                                <?=$applicationStatusesOptions?>
                            </select>
                        </td>
                    </tr>
                    </tr>
                        <th>Resume URL</th>
                        <td><input name="student[resume_url]" type="text"></td>
                    </tr>
                    </tr>
                        <th>Linked-In URL</th>
                        <td><input name="student[linked_in_url]" type="text"></td>
                    </tr>
                    </tr>
                        <th>Email</th>
                        <td><input name="student[email]"></td>
                    </tr>
                    </tr>
                        <th>Phone</th>
                        <td><input name="student[phone]"></td>
                    </tr>
                    </tr>
                        <th>Address Line1</th>
                        <td><input name="student[address1]" type="text"></td>
                    </tr>
                    </tr>
                        <th>Address Line2</th>
                        <td><input name="student[address2]" type="text"></td>
                    </tr>
                    </tr>
                        <th>City</th>
                        <td><input name="student[city]" type="text"></td>
                    </tr>
                    </tr>
                        <th>State</th>
                        <td><input name="student[state]" type="text"></td>
                    </tr>
                    </tr>
                        <th>Zipcode</th>
                        <td><input name="student[zipcode]" type="text"></td>
                    </tr>
                    <tr><td><input type="submit" value="Create Student"></td></tr>
                </table>
            </form>
            <a class="button" href="list.php"><div>Back to List</div></a>
        </main>

    <footer>
        <p><small>North Seattle College - PRISM &copy; 2016</small></p>
    </footer>

</body>
</html>
