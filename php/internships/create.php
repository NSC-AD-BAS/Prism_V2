<?php
# create php file: inserts a internship into the database
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
require_once("../includes/config.php");

# TODO: clean-up like edit

# this page calls itself with non-empty POST data
# if the POST data contains everything the table in the database needs
# the entry will be added to the database

# process the POST params for create new internship
function try_post_process() {
	if (isset($_POST['PositionTitle']) && isset($_POST['OrganizationId']) && isset($_POST['DatePosted'])
		&& isset($_POST['StartDate']) && isset($_POST['EndDate']) && isset($_POST['Location'])
		&& isset($_POST['ExpirationDate']) && isset($_POST['Description'])) {

		# need to follow up with DB people about how to setup link between org and internship
		$internship_data = array("PositionTitle"=>$_POST['PositionTitle'], "OrganizationId"=>$_POST['OrganizationId'],
			"DatePosted"=>$_POST['DatePosted'], "StartDate"=>$_POST['StartDate'], "EndDate"=>$_POST['EndDate'],
			"Location"=>$_POST['Location'],	"ExpirationDate"=>$_POST['ExpirationDate'],
			"Description"=>$_POST['Description']);

		add_internship($internship_data);
		header("Location: list.php");
	}
}

# Prints the main html for this internship createS
function print_create_main() { ?>
    <h1>Internship Create</h1>
    <form action="create.php" method="POST">
        <table id="internship_create_edit">
            <tr>
                <th>Position</th>
                <td><input name="PositionTitle" type="text" /></td>
            </tr>
            <tr>
                <th>Company</th>
                <td><select name="OrganizationId">
                	<?php
                		$company_array = get_companies_list();
                		print_company_options($company_array, "");
                	?>
                </select>
                </td>
            </tr>
            <tr>
                <th>Date Posted</th>
                <td><input name="DatePosted" type="text" /></td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td><input name="StartDate" type="text" /></td>
            </tr>
            <tr>
                <th>End Date</th>
                <td><input name="EndDate" type="text" /></td>
			</tr>
            <tr>
                <th>Location</th>
                <td><input name="Location" type="text" /></td>
            </tr>
            <tr>
                <th>Expiration Date</th>
                <td><input name="ExpirationDate" type="text" /></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea rows="3" name="Description"></textarea>
                </td>
            </tr>
        </table>

        <input type="submit" name="submit" value="Submit!" />
	</form>

	<hr />
    <!-- Buttons -->
    <a class="button" href="list.php"><div>Back to List</div></a>
<?php }

# See if we're being passed post parameters
try_post_process();

# Build the page (only done if post parameters aren't set)
render_header("Create Company", true);
render_nav();
print_create_main();
render_footer();

?>
