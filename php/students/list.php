<?php
    require "query_db.php";
    require "student_presentation.php";
    $students = get_all_students();
    $studentTable = createStudentTable($students);
?>
<html lang="en">
<head>
    <title>PRISM - Students</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../html/style/site.css">
</head>
<body>
    <header><h1>Student List</h1></header>
    <nav>
        <a href="../internships/list.html">Internships</a> &nbsp;
        <a href="../companies/list.php">Companies</a> &nbsp;
        <a href="../students/list.php">Students</a> &nbsp;
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
                    <li><a href="create.php" class="myButton">Add Record</a></li>
                    <li><a href="edit.php" class="myButton">Edit</a></li>
                    <li><a href="delete.php" class="myButton">Delete Selected</a></li>
                </ul>
               <?php 
                    echo $studentTable;
               ?>    
            </form>
        </div>
    </main>

    <footer>
        <p><small>&copy; 2016 North Seattle College</small></p>
    </footer>

</body>
</html>
