<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRISM - Edit Student</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style/site.css">

    <?php
        require 'query_db.php';
        require 'student_presentation.php';

        $studentId = $_GET['id'];
        $student = get_single_student($studentId);
    ?>
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
            <form action="create.php" method="post">
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
                            <select name="student[program_status]">
                                <?php
                                // Get current value and place it as the selected value in the menu
                                switch($student['Program Status']) {
                                    case 'active':
                                        echo '<option value="active">Active</option>
                                            <option value="none">(None Selected)</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="graduated">Graduated</option>';
                                        break;
                                    case 'inactive':
                                        echo '<option value="inactive">Inactive</option>
                                            <option value="none">(None Selected)</option>
                                            <option value="active">Active</option>
                                            <option value="graduated">Graduated</option>';
                                        break;
                                    case 'graduated':
                                        echo '<option value="graduated">Graduated</option>
                                            <option value="none">(None Selected)</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>';
                                    default:
                                        echo '<option value="none">(None Selected)</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="graduated">Graduated</option>';
                                        break;
                                }
                                ?>    
                            </select>
                        </td>
                    </tr>
                    </tr>
                        <th>Internship/Capstone Status</th>
                        <td>
                            <select name="student[internship_capstone_status]">
                                <option value="none">(None Selected)</option>
                                <option value="incomplete">Incomplete</option>
                                <option value="completed">Completed</option>
                                <option value="in_progress">In Progress</option>
                            </select>
                        </td>
                    </tr>
                    </tr>
                        <th>Internship URL</th>
                        <?php
                            echo '<td><input name="student[internship_url]" type="text" value="' . $student['Internship'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>Application Status</th>
                        <td>
                            <select name="student[application_status]">
                                <option value="none">(None Selected)</option>
                                <option value="applied">Applied</option>
                                <option value="provisionallyAccepted">Provisionally Accepted</option>
                                <option value="fullyAccepted">Fully Accepted</option>
                                <option value="withdrawn">Withdrawn</option>
                                <option value="denied">Denied</option>
                            </select>
                        </td>
                    </tr>
                    </tr>
                        <th>Email</th>
                        <?php
                        	echo '<td><input name="student[email]" value="' . $student['Email'] . '""></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>Phone</th>
                        <?php
                            echo '<td><input name="student[phone]" value="' . $student['Phone'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>Address Line1</th>
                        <?php
                            echo '<td><input name="student[address1]" type="text" value="' . $student['Address 1'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>Address Line2</th>
                        <?php
                            echo '<td><input name="student[address2]" type="text" value="' . $student['Address 2'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>City</th>
                        <?php
                            echo '<td><input name="student[city]" type="text" value="' . $student['City'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>State</th>
                        <?php
                            echo '<td><input name="student[state]" type="text" value="' . $student['State'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>Zipcode</th>
                        <?php
                        // type="text" for a number? Somebody confirm this -- Austin
                            echo '<td><input name="student[zipcode]" type="text" value="' . $student['Zipcode'] . '"></td>';
                        ?>
                    </tr>
                    </tr>
                        <th>Notes</th>
                        <?php
                            echo '<td><textarea name="student[notes]">' . $student['Notes'] . '</textarea></td>';
                        ?>
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