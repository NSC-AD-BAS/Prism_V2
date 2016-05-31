<?php

//Includes
require "../login/validate_session.php";
include "../render/page_builder.php";
include "../render/render_company.php";
include "../db/query_db.php";

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

function getWithDefault($key, $defaultValue) {
    return isset($_GET[$key]) ? $_GET[$key] : $defaultValue;
}

//Toggle showing deleted / archived companies
$archived = isset($_GET['archived']) && $_GET['archived'];

//Allow column sorting

$sort = getWithDefault('sort', "");
$order = getWithDefault('order', "ASC");

$urlArgsToNameLookup = array(
    "comp" => "`Organization Name`",
    "loc" => "Location",
    "avail" => "`Available Internships`"
);
$field = array_key_exists($sort, $urlArgsToNameLookup) ? $urlArgsToNameLookup[$sort] : "`Organization Name`";

$data = $archived ? get_deleted_companies() : get_companies_list_sorted($field, $order);

$navTitle = "Company List";
$query = isset($_GET['q']) ? $_GET['q'] : "";
if ($query !== "") {
    $navTitle = "Search results for: " . $query;
    $data = array_filter($data, function($company) use ($query) {
        return array_contains_value_like($company, $query);
    });
}

//Render the default page
render_header('Companies', false);
render_nav($navTitle, "list.php");
renderCompanyList($data, $archived);
render_footer();

?>
