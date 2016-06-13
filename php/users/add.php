<?php 
/**
  * Displays form to create a new user
  */
    include 'includes/header.php';
    
    #TODO:Add missing table fields(middle name etc...), fix style
 	echo 
    "
        <form action='prism-input.php?id=".$myID."' method='post'>
            First Name: <input type='text' name='firstname' ><br>
            Last Name: <input type='text' name='lastName' ><br>
            Phone #: <input type='text' name='userPhone' ><br>
            E-mail : <input type='text' name='userEmail' ><br>
            User Type: 
            <input type='radio' name='type' value='2'>Admin
            <input type='radio' name='type' value='1' checked>Student
            <input type='radio' name='type' value='3'>Faculty<br><br>
            <input type='submit' name='add'>
            <input type='hidden' name='act' value='add' />
        </form>
    ";
?>
<br><br>
<a href=list.php> Back to list</a>
<?php include 'includes/footer.php'; ?>
