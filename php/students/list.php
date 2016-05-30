<?php
    require "../login/validate_session.php";
    require_once("../includes/config.php");

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

    function createProgramStatusOptions($selectedIndex) {
        $programStatuses = get_all_program_statuses();
        array_unshift($programStatuses, array("Id" => -1, "Description" => "All"));
        return CreateOptionsFrom($programStatuses, $selectedIndex);
    }

    $navTitle = "Student List";
    $showDeleted = false;
    $filters = [];
    $programStatusId = -1;

    if (isset($_GET['q'])) {
        $searchQuery = $_GET['q'];
        $navTitle = "Search results for: " . $searchQuery;
        array_push($filters, createSearchFilter($searchQuery));
    }

    if (isset($_GET['programStatusId']) && $_GET['programStatusId'] > -1) {
        $programStatusId = $_GET['programStatusId'];
        array_push($filters, function($student) use ($programStatusId) {
            return $student["Program Status Id"] === $programStatusId;
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
    $programStatusOptions = createProgramStatusOptions($programStatusId);
    $studentList = createStudentList($students, $programStatusOptions);
    
    render_header("Students", false);
    render_nav($navTitle, "list.php");
    
?>
   
<?=$studentList?>

<a href="create.php" class="button"><div>Create Student</div></a>
<?=$showDeletedLink?>

<?php render_footer(); ?>
