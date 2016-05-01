<?php
# List php file:
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("query_db.php");

# Prints main html for this list
function print_list_main($list_title, $data) { ?>
    <!-- Main view -->
    <main>
        <input id="searchbox" type="text" placeholder=" Search" />
        <h1><?= $list_title ?></h1>
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
    </main>
<?php }

# Build list page
$list = get_internship_list();
print_top();
print_list_main("Internships", $list);
print_bottom();

?>
