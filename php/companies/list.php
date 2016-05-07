<?php

//Includes
include "page_builder.php";
include "query_db.php";

function renderCompanyList($data) {

    $out = "
        <ul class=\"outer\">
            <li class=\"tableHead\">
            <ul class=\"inner\">
                <li>Company Name</li>
                <li>Location</li>
                <li>Internships Available</li>
            </ul>
        ";
        foreach ($data as $d) {
            $out .= "
            <li><a href=\"detail.php?id=" . $d['OrganizationId'] . "\">
                <ul class=\"inner\">
                    <li>" . $d['Organization Name'] . "</li>
                    <li>" . $d['Location'] . "</li>
                    <li>" . $d['Number of Positions'] . "</li>
                </ul>
            </a></li>
            ";
        }
    $out .= "</ul>";
    if (isAdmin()) {
        $out .= "
        <hr>
        <a class=\"button\" href=\"create.php\"><div>Create new Company</div></a>";
    }

    //This could just as easily be a return
    echo $out;
}

render_header('Companies', false);
render_nav('Company List');
renderCompanyList(get_companies_list());
render_footer();

?>
