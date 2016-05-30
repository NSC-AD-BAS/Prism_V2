<?php
    require "../login/validate_session.php";
    require "query_db.php";
    require "student_presentation.php";
    require "../render/page_builder.php";

    $navTitle = "Student List";
    $showDeleted = false;
    $searchQuery = "";


    if (isset($_GET['q'])) {
        $searchQuery = $_GET['q'];
        $navTitle = "Search results for: " . $searchQuery;
    }

    if (isset($_GET['showDeleted']) && $_GET['showDeleted']) {
        $showDeleted = true;
    }

    $students = search_students_for($searchQuery);
    $filteredStudents = filter_students_matching_showDeleted($students, $showDeleted);     
    $studentList = createStudentList($filteredStudents);

    render_header("Students", false);
    render_nav($navTitle, "list.php");

    $showDeletedLink = createShowDeletedLink($showDeleted);
?>
   
<?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?=$showDeletedLink?>

<?php render_footer(); ?>
