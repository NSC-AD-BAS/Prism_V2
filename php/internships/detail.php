<?php
# detail php file:
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("query_db.php");

# Prints main html for this internship detail
function print_detail_main($data) { ?>
    <!-- Main view -->
    <main>
        <?php
        if (count($data) > 0) {
            $data = $data[0];
            $intId = $data["InternshipId"];
            $intPosition = $data["Position Title"];
            $intCompany = $data["Organization"];
            $intDatePosted = $data["Date Posted"];
            $intStartDate = $data["Start Date"];
            $intEndDate = $data["End Date"];
            $intLocation = $data["Location"];
            $intDescription = $data["Job Description"];
            $intLastUpdated = $data["Last Update"];
            $intExpiration = $data["Expiration Date"]; ?>

            <h1><?= $intPosition ?></h1>

            <table id="internship_detail">
                <tr>
                    <th>Company:</th>
                    <td><?= $intCompany ?></td>
                </tr>
                <tr>
                    <th>Date Posted:</th>
                    <td><?= $intDatePosted ?></td>
                </tr>
                <tr>
                    <th>Start Date:</th>
                    <td><?= $intStartDate ?></td>
                </tr>
                <tr>
                    <th>End Date:</th>
                    <td><?= $intEndDate ?></td>
                </tr>
                    <th>Location:</th>
                    <td><?= $intLocation ?></td>
                </tr>
                </tr>
                    <th>Last Updated:</th>
                    <td><?= $intLastUpdated ?></td>
                </tr>
                </tr>
                    <th>Expiration Date:</th>
                    <td><?= $intExpiration ?></td>
                </tr>
            </table>
            <h2>Description</h2>
            <hr />
            <p id="internship_description"><?= $intDescription ?></p>

        <?php } else { ?>
            <p>We're sorry, a result was not found.</p>
        <?php } ?>

        <hr />
        <!-- Buttons -->
        <a class="button" href="list.php"><div>Back to List</div></a>
        <a class="button" href="create.php"><div>Create new Internship</div></a>
        <a class="button" href="edit.php?id=<?= $intId ?>"><div>Edit</div></a>
        <a class="button" href="delete.php?id=<?= $intId ?>"><div>Delete</div></a>
    </main>
<?php }

# Build detail page
$id = $_GET["id"];
$data = get_internship_detail($id);
print_top();
print_detail_main($data);
print_bottom();

?>
