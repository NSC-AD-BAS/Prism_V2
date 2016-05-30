<?php
    require "../login/validate_session.php";
    require "query_db.php";
    require "student_presentation.php";
    require "../render/page_builder.php";

    function array_contains_value_like($array, $query) {
        $lowercaseQuery = strtolower($query);
        foreach($array as $field => $value) {
            $lowerCaseValue = strtolower($value);
            if (strpos($lowerCaseValue, $lowercaseQuery) !== false) {
                return true;
            }
        }
        return false;
    }

    function createSearchFilter($searchQuery) {
        return function($student) use ($searchQuery) {
            return array_contains_value_like($student, $searchQuery);
        };
    }

    $navTitle = "Student List";
    $showDeleted = false;
    $filters = [];

    if (isset($_GET['q'])) {
        $navTitle = "Search results for: " . $searchQuery;
        $searchQuery = $_GET['q'];
        array_push($filters, createSearchFilter($searchQuery));
    }

    if (isset($_GET['programStatus']) && $_GET['programStatus'] !== "All") {
        $programStatus = $_GET['programStatus'];
        array_push($filters, function($student) use ($programStatus) {
            return $student["Program Status"] === $programStatus;
        });
    }

    if (isset($_GET['showDeleted']) && $_GET['showDeleted']) {
        $showDeleted = true;
    }

    array_push($filters, function($student) use ($showDeleted) {
        $isStudentDeleted = (bool)$student["isDeleted"];
        $result = $isStudentDeleted === $showDeleted;
        return $result;
    });
    $showDeletedLink = createShowDeletedLink($showDeleted);

    $students = get_students_matching_filters($filters);
    $studentList = createStudentList($students);
    
    render_header("Students", false);
    render_nav($navTitle, "list.php");
    
?>
   
<?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?=$showDeletedLink?>

<?php render_footer(); ?>
