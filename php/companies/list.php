<?php

//Includes
require "../login/validate_session.php";
include "../render/page_builder.php";
include "../render/render_company.php";
include "../db/query_db.php";

//Toggle showing deleted / archived companies
$archived = isset($_GET['archived']) && $_GET['archived'];

//Allow column sorting
function getWithDefault($key, $defaultValue) {
    return isset($_GET[$key]) ? $_GET[$key] : $defaultValue;
}
$sort = getWithDefault('sort', "");
$order = getWithDefault('order', "ASC");

$urlArgsToNameLookup = array(
    "comp" => "`Organization Name`",
    "loc" => "Location",
    "avail" => "`Available Internships`"
);
$field = array_key_exists($sort, $urlArgsToNameLookup) ? $urlArgsToNameLookup[$sort] : "`Organization Name`";

$data = $archived ? get_deleted_companies() : get_companies_list_sorted($field, $order);

//Render the default page
render_header('Companies', false);
render_nav('Company List');
renderCompanyList($data, $archived);
render_footer();

?>
