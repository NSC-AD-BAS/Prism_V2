<?php
    require "../login/validate_session.php";
    require "query_db.php";
    require "student_presentation.php";
    require "../render/page_builder.php";

    $students = [];
    $navTitle = "Student List";
    if (isset($_GET['q'])) {
        $searchQuery = $_GET['q'];
        $students = search_students_for($searchQuery);
        $navTitle = "Search results for: " . $searchQuery;
    } else {
        $students = get_all_students();
    }
        
    $studentList = createStudentList($students);
    

    render_header("Students", false);
    render_nav($navTitle, "list.php");
?>
   
   <?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?php render_footer(); ?>
