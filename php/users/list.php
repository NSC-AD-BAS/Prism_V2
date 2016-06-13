<?php 
    require 'includes/header.php';

    /**
    * Creates and displays a list of users along
    * with their names, phone numbers, emails, and type
    */

    $conn = db_connect();
    $data = get_user_list($conn);

    echo 
    '
        <ul class="outer">
            <!--COLUMNS-->
            <li class="tableHead">
                <ul class="inner4">
                    <li>Full Name</li>
                    <li>Phone</li>
                    <li>Email</li>
                    <li>User Type</li>
                </ul>
            </li>
        <!--ROWS-->

    ';

    foreach ($data as $d) {
        $userName = dbOut($d['Name']);#assign variables for readability
        $userPhone = dbOut($d['Phone']);
        $userEmail = dbOut($d['Email Address']);
        $userType = dbOut($d['User Type']);
        $usrId = dbOut($d['User ID']);

        #print out table structure with data
        echo 
        '
            <li>
                <a href="detail.php?id='. $usrId . '">
                    <ul class="inner4">
                        <li>' . $userName . '</li>
                        <li>' . $userPhone . '</li>
                        <li>' . $userEmail . '</li>
                        <li>' . $userType . '</li>
                    </ul>
                </a>
            </li>
        ';
    }#end foreach
    echo 
    '
        </ul>    
        <a class="button" href="add.php"><div>Create new User</div></a>
    ';

    include 'includes/footer.php'; 
?>
