<?php
# common php file: holds common code used between all files
# Author: Tim Davis
# Author: Kellan Nealy

# Prints common top html, including nav
function print_top() { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>PRISM - Internships</title>
        <meta charset="utf-8">

        <!-- Page styling -->
        <link type="text/css" rel="stylesheet" href="../style/site.css" />
    </head>
    <body>
        <!-- Navigation bar -->
        <nav>
            <ul>
                <li class="left"><a href="../internships/list.php">Internships</a></li>
                <li class="left"><a href="../companies/list.php">Companies</a></li>
                <li class="left"><a href="../students/list.php">Students</a></li>
                <li class="left"><a href="../admin/admin.php">(Admin)</a></li>

                <li class="right"><a href="list.php">Logout</a></li>
                <li class="right"><a href="list.php">Profile</a></li>

                <li id="welcome" class="right">Welcome, Tim!</li>
            </ul>
        </nav>
<?php }

# Prints common bottom html, including footer
function print_bottom() { ?>
        <footer>
            <p><small>North Seattle College - PRISM &copy; 2016</small></p>
        </footer>
    </body>
    </html>
<?php }


?>
