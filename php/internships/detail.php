<?php
# detail php file:
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("query_db.php");

$id = $_GET["id"];

# Prints main html for this internship detail
function print_detail_main($data) { ?>
    <!-- Main view -->
    <main>
        <h1><?=  ?></h1>
        <?php
        if (count($data) > 0) {
            echo($id);
        } else { ?>
            <p>0 results.</p>
        <?php } ?>

        <hr />
        <!-- Buttons -->
        <a class="button" href="create.php"><div>Create new Internship</div></a>
    </main>
<?php }

# Build detail page
$detail = get_internship_detail($id);
print_top();
print_detail_main($detail);
print_bottom();

?>
