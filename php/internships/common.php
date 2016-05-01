<?php
#Common php file: holds common code used between all files
#Author: Tim Davis
#Author: Kellan Nealy

#Prints common top html, including nav
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
                <li class="left"><a href="../internships/list.html">Internships</a></li>
                <li class="left"><a href="../companies/list.html">Companies</a></li>
                <li class="left"><a href="../students/list.html">Students</a></li>
                <li class="left"><a href="../admin/admin.html">(Admin)</a></li>

                <li class="right"><a href="list.html">Logout</a></li>
                <li class="right"><a href="list.html">Profile</a></li>

                <li id="welcome" class="right">Welcome, Tim!</li>
            </ul>
        </nav>
<?php }

#Prints common bottom html, including footer
function print_bottom() { ?>
        <footer>
            <p><small>North Seattle College - PRISM &copy; 2016</small></p>
        </footer>
    </body>
    </html>
<?php }


?>
