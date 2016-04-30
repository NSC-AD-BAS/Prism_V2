<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRISM - Students</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../html/style/site.css">
    <?php
        require "query_db.php";
    ?>
</head>
<body>
    <header><h1>Student List</h1></header>
    <nav>
        <a href="../internships/list.html">Internships</a> &nbsp;
        <a href="../companies/list.html">Companies</a> &nbsp;
        <a href="../students/list.html">Students</a> &nbsp;
        <a href="../admin/list.html">(Admin)</a> &nbsp;
    </nav>
    <main>
        <div class="listview">
            <form method="post" action="asdf();" name="search" class="search">
                <input type="text">
                <input type="submit" value="Search Students">
            </form>
            <form method="post" action="postsomething();" name="details">
                <ul class="listActions">
                    <li><a href="create.html" class="myButton">Add Record</a></li>
                    <li><a href="edit.html" class="myButton">Edit</a></li>
                    <li><a href="delete.html?id=1" class="myButton">Delete Selected</a></li>
                </ul>
                <?php
                    //find this function inside query_db.php
                    list_students();
                ?>
                <!--<table>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>SID</th>
                        <th>Cohort</th>
                        <th>Active Status</th>
                        <th>Internship/Capstone Status</th>
                        <th>Application Status</th>
                    </tr>
                    
                    <tr>
                        <td><input type="checkbox" name="1" value="selected"></td>
                        <td><a href="detail.html?id=1">Garry Kasparov</a></td>
                        <td>40522751</td>
                        <td>2015</td>
                        <td>Inactive</td>
                        <td>Incomplete</td>
                        <td>Applied</td>
                    </tr>
                    
                    <tr>
                        <td><input type="checkbox" name="2" value="selected"></td>
                        <td><a href="detail.html?id=2">Bobby Fischer</a></td>
                        <td>6277751</td>
                        <td>2015</td>
                        <td>Graduated</td>
                        <td>Completed</td>
                        <td>Provisionally Accepted</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="selected:3" value="selected"></td>
                        <td><a href="detail.html?id=3">Deep Blue</a></td>
                        <td>6268221</td>
                        <td>2015</td>
                        <td>Active</td>
                        <td>Incomplete</td>
                        <td>Fully Accepted</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="selected:4" value="selected"></td>
                        <td><a href="detail.html?id=4">Jose Capablanca</a></td>
                        <td>883563</td>
                        <td>2014</td>
                        <td>Active</td>
                        <td>In Progress</td>
                        <td>Withdrawn</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="selected:5" value="unchecked"></td>
                        <td><a href="detail.html?id=5">Wilhelm Steinitz</a></td>
                        <td>2643677</td>
                        <td>2014</td>
                        <td>Graduated</td>
                        <td>Completed</td>
                        <td>Denied</td>
                    </tr>
                </table>-->
            </form>
        </div>
    </main>

    <footer>
        <p><small>North Seattle College - PRISM &copy; 2016</small></p>
    </footer>

</body>
</html>
