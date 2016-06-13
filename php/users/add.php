<?php 
/**
  * Displays form to create a new user
  */
    include 'includes/header.php';
    
    #TODO:Add missing table fields(middle name etc...), fix style
 	echo 
    "
        <form action='prism-input.php?id=".$myID."' method='post'>
        <div class='wrapper'>
            <div class='detail_table'>
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td> <input type='text' name='firstname' ></td>
                    </tr>

                    <tr>
                        <td>Last Name: </td>
                        <td><input type='text' name='lastName' ></td>

                    </tr>
                    <tr>
                        <td>Phone #: </td>
                        <td><input type='text' name='userPhone' ></td>

                    </tr>
                    <tr>
                        <td>E-mail :</td> 
                        <td><input type='text' name='userEmail' ></td>

                    </tr>
                    <tr>
                        <td>User Type: </td>
                        <td>
                            <input type='radio' name='type' value='2'>Admin
                            <input type='radio' name='type' value='1' checked>Student
                            <input type='radio' name='type' value='3'>Faculty
                        </td>
                    </tr>
                </table>
                <hr>
                <div class='lower_nav'>
                    <div>
                        <a class='button' href=list.php><div>User List</div></a>
                        <input class='button' type='submit' name='add' value='Add User'>
                    </div>
                </div> <!--end lower_nav -->
            </div> <!--detail_table-->
        </div> <!--wrapper-->
        <input type='hidden' name='act' value='add' />
        
        </form>
    ";
    render_footer(); 
?>
