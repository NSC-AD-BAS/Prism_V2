<?php 
/**
  * Allows fields of a selected account to be changed
  * Fields include: Name, phone number, email, and user type
  */
    include 'includes/header.php'; 
   
    $conn = db_connect();

    #pulls users ID
    if(isset($_GET['id']) && (int)$_GET['id'] > 0){ #proper data must be on querystring
        $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
    }
    $sql = "SELECT FirstName, LastName, PhoneNumber, EmailAddress,TypeId ,UserId FROM users WHERE UserId='".$myID."'"; #set sql statement

    $result = mysqli_query($conn, $sql);#grab tables
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "0 results";
    }

    $firstName = dbOut($row['FirstName']);#assign variables for readability
    $lastName = dbOut($row['LastName']);
    $userPhone = dbOut($row['PhoneNumber']);
    $userEmail = dbOut($row['EmailAddress']);
    $userType = dbOut($row['TypeId']);
    $usrId = dbOut($row['UserId']);

    #TODO:Add missing table fields(middle name etc...), fix style
    echo 
    "
        <form action='prism-input.php?id=".$myID."' method='post'>
            <div class='wrapper'>
                <div class='detail_table'>
                    <table>
                        <tr>
                            <td>First Name: </td>
                            <td><input type='text' name='firstname' value='".$firstName."'></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input type='text' name='lastname' value='".$lastName."'></td>
                        </tr>
                        <tr>
                            <td>User Email: </td>
                            <td><input type='text' name='userEmail' value='".$userEmail."'></td>
                        </tr>
                        <tr>
                            <td>User Phone: </td>
                            <td><input type='text' name='userPhone' value='".$userPhone."'></td>
                        <tr>
                            <td>User Type: </td>
                            <td>
                                <input type='radio' name='type' value='2'
        ";

        if($userType ==2){echo "checked";}#check if user is admin, if true, checkbox
        echo 
        "
                                >Admin
                                <input type='radio' name='type' value='1'
        ";

        if($userType ==1){echo "checked";}#check if user is student, if true, checkbox
        echo 
        "
                                >Student
                                <input type='radio' name='type' value='3'
        ";

        if($userType ==3){echo "checked";}#check if user is faculty, if true, checkbox
        echo 
        "
                                >Faculty
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class='lower_nav'>
                        <div>
                            <a class='button' href=list.php><div>User List</div></a>
                            <input class='button' type='submit' name='update' value='Update User'>
                            <a class='button' href='detail.php?id=" . $usrId . "'><div>Cancel</div></a>
                            
                        </div>
                    </div> <!--end lower_nav -->
                </div> <!--detail_table-->
            </div> <!--wrapper-->
            <input type='hidden' name='act' value='update' >
        </form>
    ";
?>

<?php render_footer(); ?>
