<?php
# list php file:
# Author: Tim Davis
# Author: Kellan Nealy
require_once("../includes/config.php");
require "../login/validate_session.php";

# Prints main html for this list
function print_list_main($data, $list_title) { ?>
    <!-- Main view -->
        <?php
        if (count($data) > 0) {
            # output table header ?>
            <!-- Table -->
            <ul class="outer">
                <li class="tableHead">
                    <ul class="inner">
                        <li>Position</li>
                        <li>Company</li>
                        <li>Location</li>
                    </ul>
                </li>
            <?php
            # output data of each row
            foreach($data as $row) {
                $intId = $row["InternshipId"];
                $intPosition = $row["Position Title"];
                $intCompany = $row["Organization"];
                $intLocation = $row["Location"]; ?>

                <li>
                    <a href="detail.php?id=<?= $intId ?>">
                        <ul class="inner">
                            <li><?= $intPosition ?></li>
                            <li><?= $intCompany ?></li>
                            <li><?= $intLocation ?></li>
                        </ul>
                    </a>
                </li>
            </ul>
            <?php }
        } else { ?>
            <p>0 results.</p>
        <?php } ?>

        <hr />
        <!-- Buttons -->
        <a class="button" href="create.php"><div>Create new Internship</div></a>
<?php }

render_header("Students", false);

# Build list page
$list = [];
$navTitle = "Internship List";

if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];
    $list = search_internship_list($searchQuery);
    $navTitle = "Search: " . $searchQuery;
} else {
    $list = get_internship_list();
}

render_nav($navTitle, "list.php");
print_list_main($list, "Internships");
render_footer();

?>