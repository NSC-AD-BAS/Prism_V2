<?php
# edit php file: updates an internship in the database
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("update_db.php");

# this page calls itself with non-empty POST data
# if the POST data contains everything the table in the database needs
# the entry will be replaced in the database

# process the POST params for create new internship
function try_post_process($intId) {
	if (isset($_POST['PositionTitle']) && isset($_POST['OrganizationId']) && isset($_POST['DatePosted'])
		&& isset($_POST['StartDate']) && isset($_POST['EndDate']) && isset($_POST['Location'])
		&& isset($_POST['SlotsAvailable']) && isset($_POST['ExpirationDate']) && isset($_POST['Description'])) {

		# need to follow up with DB people about how to setup link between org and internship
		$internship_data = array("PositionTitle"=>$_POST['PositionTitle'], "OrganizationId"=>$_POST['OrganizationId'],
			"DatePosted"=>$_POST['DatePosted'], "StartDate"=>$_POST['StartDate'], "EndDate"=>$_POST['EndDate'],
			"Location"=>$_POST['Location'], "SlotsAvailable"=>$_POST['SlotsAvailable'],
			"ExpirationDate"=>$_POST['ExpirationDate'], "Description"=>$_POST['Description']);

		update_internship($internship_data, $intId);
		header("Location: list.php");
	}
}

# Prints the main html for this internship edit
function print_edit_main($data) { ?>
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

            <h1>Internship Edit</h1>
            <form action="edit.php?id=<?= $intId ?>" method="POST">
    	        <table id="internship_detail">
    	            <tr>
    	                <th>Position</th>
    	                <td><input name="PositionTitle" type="text" value="<?= $intPosition ?>" /></td>
    	            </tr>
    	            <tr>
    	                <th>Company</th>
    	                <td><select name="OrganizationId">
    	                	<?php
    	                		$company_array = get_companies_list();
    	                		print_company_options($company_array, $intCompany);
    	                	?>
    	                </select>
    	                </td>
    	            </tr>
    	            <tr>
    	                <th>Date Posted</th>
    	                <td><input name="DatePosted" type="text" value="<?= $intDatePosted ?>" /></td>
    	            </tr>
    	            <tr>
    	                <th>Start Date</th>
    	                <td><input name="StartDate" type="text" value="<?= $intStartDate ?>" /></td>
    	            </tr>
    	            <tr>
    	                <th>End Date</th>
    	                <td><input name="EndDate" type="text" value="<?= $intEndDate ?>" /></td>
    	            </tr>
    	                <th>Location</th>
    	                <td><input name="Location" type="text" value="<?= $intLocation ?>" /></td>
    	            </tr>
    	            </tr>
    	                <th>Slots Available</th>
    	                <td><input name="SlotsAvailable" type="text" value="" /></td>
    	            </tr>
    	            </tr>
    	                <th>Expiration Date</th>
    	                <td><input name="ExpirationDate" type="text" value="<?= $intExpiration ?>" /></td>
    	            </tr>
    	            <tr>
    	                <th>Description</th>
    	                <td><textarea rows="3" name="Description" ><?= $intDescription ?></textarea>
    	                </td>
    	            </tr>
    	        </table>

    	        <input type="submit" name="submit" value="Submit!" />
        	</form>

        <?php } else { ?>
            <p>We're sorry, there was an error retrieving data from the database.</p>
        <?php } ?>

        <!-- Buttons -->
        <a class="button" href="detail.php?id=<?= $intId ?>"><div>Back to Detail</div></a>

    </main>
<?php }

# See if we're being passed post parameters
$intId = $_GET["id"];
try_post_process($intId);

# Build the page (only done if post parameters aren't set)
$data = get_internship_detail($intId);
print_top();
print_edit_main($data);
print_bottom();

?>
