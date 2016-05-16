<?php
    require "query_db.php";
    require "student_presentation.php";
    require "../companies/page_builder.php";

    $students = get_all_students();
    $studentList = createStudentList($students);
    

    render_header("Students", false);
    render_nav("Student List");
?>
   
   <?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?php render_footer(); ?>