<?php
    require "query_db.php";
    require "student_presentation.php";
    $students = get_all_students();
    $studentList = createStudentList($students);
?>
<html lang="en">
<head>
    <title>PRISM - Students</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style/site.css">
</head>
<body>
    <header><h1>Student List</h1></header>
    <nav>
        <ul>
            <li class="left"><a href="../internships/list.html">Internships</a></li> &nbsp;
            <li class="left"><a href="../companies/list.php">Companies</a></li> &nbsp;
            <li class="left"><a href="../students/list.php">Students</a></li> &nbsp;
            <li class="left"><a href="../admin/list.html">(Admin)</a></li> &nbsp;
        </ul>
    </nav>
    <main>
        <div class="listview">
            <!-- Nathan's code. Commented out by Austin and replaced in an attempt to mimic the
            styling of other pages
            <form method="post" action="asdf();" name="search" class="search">
                <input type="text">
                <input type="submit" value="Search Students">
            </form>-->
            <input id="searchbox" type="text" placeholder=" Search" />
            <h1>Students</h1>
            <form method="post" action="postsomething();" name="details">
                <ul class="listActions">
                    <li><a href="create.html" class="myButton">Add Record</a></li>
                    <li><a href="edit.php" class="myButton">Edit</a></li>
                    <li><a href="delete.php" class="myButton">Delete Selected</a></li>
                </ul>
               <?php 
                    echo $studentList;
               ?>    
            </form>
        </div>
    </main>

    <footer>
        <p><small>North Seattle College - PRISM &copy; 2016</small></p>
    </footer>

</body>
</html>
