<?php
# create php file: inserts a internship into the database
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
include("common.php");
include("../db/update_db.php");
include("../db/query_db.php");
include("../render/page_builder.php");

# Prints the main html for this internship createS
function print_create_main() { ?>
    <h1>Internship Create</h1>
    <form action="confirm_create.php" method="POST">
        <table id="internship_create_edit">
            <tr>
                <th>Position</th>
                <td><input name="PositionTitle" type="text" placeholder="Position" /></td>
            </tr>
            <tr>
                <th>Company</th>
                <td><select name="OrganizationId">
                	<?php
                        # for dynamic pre-population of drop-down from company detail
                        $company_name = "";

                        if (isset($_GET["orgId"])) {
                            $company_data = get_company_detail($_GET["orgId"]);
                            $company_name = $company_data[0]['Company'];
                        }
                		$company_array = get_companies_list();
                		print_company_options($company_array, $company_name);
                	?>
                </select>
                </td>
            </tr>
            <tr>
                <th>Date Posted</th>
                <td><input name="DatePosted" type="text" placeholder="yyyy-mm-dd" /></td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td><input name="StartDate" type="text" placeholder="yyyy-mm-dd" /></td>
            </tr>
            <tr>
                <th>End Date</th>
                <td><input name="EndDate" type="text" placeholder="yyyy-mm-dd" /></td>
			</tr>
            <tr>
                <th>Expiration Date</th>
                <td><input name="ExpirationDate" type="text" placeholder="yyyy-mm-dd" /></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea rows="3" name="Description" placeholder="Enter a description" ></textarea>
                </td>
            </tr>
        </table>

        <input type="submit" name="submit" value="Submit!" />
	</form>

	<hr />
    <!-- Buttons -->
    <a class="button" href="list.php"><div>Back to List</div></a>
<?php }

# Build the page (only done if post parameters aren't set)
render_header("Create Company", true);
render_nav();
print_create_main();
render_footer();

?>
