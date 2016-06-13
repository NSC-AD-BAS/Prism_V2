<?php
# list php file:
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
include("common.php");
include("../db/query_db.php");
include("../render/page_builder.php");

# Prints main html for this list
function print_list_main($data, $list_title) {
    # Default column names
    $pos_header = "Position";
    $com_header = "Company";
    $loc_header = "Location";

    # Default column orders
    $pos_order = "ASC";
    $com_order = "ASC";
    $loc_order = "ASC";

    # Arrows
    $arrow_asc = " &#9660;";
    $arrow_desc = " &#9650;";

    if (isset($_GET["sort"]) && isset($_GET["order"])) {
        # Check what column is being sorted
        if ($_GET["sort"] == "pos") {
            # Check what order to sort in
            if ($_GET["order"] == "ASC") {
                $pos_order = "DESC";
            }
            $pos_header .= $pos_order == "DESC" ? $arrow_asc : $arrow_desc;

        } else if ($_GET["sort"] == "com") {
            # Check what order to sort in
            if ($_GET["order"] == "ASC") {
                $com_order = "DESC";
            }
            $com_header .= $com_order == "DESC" ? $arrow_asc : $arrow_desc;

        } else if ($_GET["sort"] == "loc") {
            # Check what order to sort in
            if ($_GET["order"] == "ASC") {
                $loc_order = "DESC";
            }
            $loc_header .= $loc_order == "DESC" ? $arrow_asc : $arrow_desc;
        }

    } else {
        // default sort
        $pos_order = "DESC";
        $pos_header .= $arrow_asc;
    }

    ?>

    <!-- Main view -->
        <?php
        if (count($data) > 0) {
            # output table header ?>
            <!-- Table -->
            <ul class="outer">
                <li class="tableHead">
                    <ul class="inner">
                        <li><a href="?sort=pos&order=<?php echo $pos_order ?>"><?= $pos_header ?></a></li>
                        <li><a href="?sort=com&order=<?php echo $com_order ?>"><?= $com_header ?></a></li>
                        <li><a href="?sort=loc&order=<?php echo $loc_order ?>"><?= $loc_header ?></a></li>
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

        <!-- Buttons -->
        <?php if (isAdmin()) : ?>
        <hr />
        <a class="button" href="create.php"><div>Create new Internship</div></a>
        <?php endif ?>
<?php }

# Build list page
$possibleSorts = array(
    "default" => "`Position Title`",
    "pos" => "`Position Title`",
    "com" => "`Organization`",
    "loc" => "`Location`"
);
$sort = isset($_GET["sort"]) ? $possibleSorts[$_GET["sort"]] : $possibleSorts["default"];
$order = isset($_GET["order"]) ? $_GET["order"] : "ASC";

$list = [];
$navTitle = "Internship List";

if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];
    $list = search_internship_list($searchQuery, $order);
    $navTitle = "Search: " . $searchQuery;
} else {
    $list = get_internship_list($sort, $order);
}

render_header("Internships", false);
render_nav($navTitle, "list.php");
print_list_main($list, "Internships");
render_footer();

?>
