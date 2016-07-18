<?php 
    require 'includes/header.php';
    include 'includes/Pager.php';
    /**
    * Creates and displays a list of users along
    * with their names, phone numbers, emails, and type
    */

    $iConn = db_connect();

    //$conn = db_connect();
    $sql  = "SELECT * FROM user_list";
    $output = false;
    

$myPager = new Pager(10,'',"<strong>Previous</strong>","<strong>Next</strong>",'');
$sql = $myPager->loadSQL($sql,$iConn);  #load SQL, pass in existing connection, add offset

$result = mysqli_query($iConn, $sql);
if($result){
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
}
    //clean-up result set and connection
    



    //$data = get_user_list($conn);

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
if($result){
    $numResults = mysqli_num_rows($result);
    if(mysqli_num_rows($result) > 0)
    {#records exist - process
	   if($myPager->showTotal()==1){$itemz = "user";}else{$itemz = "users";}  //deal with plural
    
	
        echo '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';

        echo "<br />" . $myPager->showNAV() . "<br />"; # show paging nav, only if enough records	
    
        foreach ($result as $d) {
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
    
        if($numResults>9){
            echo "<br />" . $myPager->showNAV() . "<br />"; # show paging nav, only if enough records	
        }
        mysqli_free_result($result);
        mysqli_close($iConn);
    }else{#no records
        echo "<div align=center>What! No users?  There must be a mistake!!</div>";	
    }
    
    
}else{#no records
    echo "<div align=center>What! No users?  There must be a mistake!!</div>";	
}
    
echo 
'
    </ul>    
    <a class="button" href="add.php"><div>Create new User</div></a>
';

render_footer();
?>
