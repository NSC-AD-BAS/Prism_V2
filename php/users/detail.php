<?php 
/**
  * Retrieves and displays details regarding a specified account.
  * Information includes: Name, phone number, email, and user type
  */
    include 'includes/header.php';
   
    #pulls users ID
    if(isset($_GET['id']) && (int)$_GET['id'] > 0){ #proper data must be on querystring
        $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
    }
    $data = get_user_detail($myID);

    #Case: no results
    if (empty($data)) {
        echo "0 results";
    }

    #assign variables for readability
    foreach ($data as $d) {
        $userName = dbOut($d['Name']);
        $userPhone = dbOut($d['Phone']);
        $userEmail = dbOut($d['Email Address']);
        $userType = dbOut($d['User Type']);
        $usrId = dbOut($d['User ID']);
    }

    #TODO:Add missing table fields(middle name etc...), fix style
    echo 
    "
    <div class='wrapper'>
        <div class='detail_table'>
            <table>
                
                    <tr>
                        <td>User Name :</td>
                        <td> " . $userName . "</td>
                    </tr>
                    <tr>
                        <td>User Phone #:</td>
                        <td> " . $userPhone . "</td>
                    </tr>
                    <tr>
                        <td>User E-mail :</td>
                        <td> " . $userEmail . "</td>
                    </tr>
                    <tr>
                        <td>User Type :</td>
                        <td> " . $userType . "</td>
                    </tr>
                
            </table>
            <hr>
            <div class='lower_nav'>
                <div>
                    <a class='button' href=list.php><div>List</div></a>
                    <a class='button' href=edit.php?id=" . $usrId . "><div>Edit</div></a>
                </div>
            </div> <!--end lower_nav -->
        </div> <!--detail_table-->
    </div> <!--wrapper-->
    ";
?>
<br><br>
<a href=list.php> Back to list</a>
<?php render_footer(); ?>
