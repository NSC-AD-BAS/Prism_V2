<?php
# edit php file: updates an internship in the database
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
include("common.php");
include("../db/update_db.php");
include("../db/query_db.php");
include("../render/page_builder.php");

# Prints the main html for this internship edit
function print_edit_main($data, $intId) { ?>
        <?php
		# Make sure we have data
        if (count($data) > 0) {
            $data = $data[0];
            // loop to get rid of any 0000-00-00 dates
            foreach($data as $field => $value) {
                if($value == "0000-00-00") {
                    $data[$field] = "";
                }
                error_log($data[$field]);
            }
            $intPosition = $data["Position Title"];
            $intCompany = $data["Organization"];
            $intDatePosted = $data["Date Posted"];
            $intStartDate = $data["Start Date"];
            $intEndDate = $data["End Date"];
            $intDescription = $data["Job Description"];
            $intLastUpdated = $data["Last Update"];
            $intExpiration = $data["Expiration Date"]; ?>

			<!-- HTML content -->
            <form action="confirm_edit.php" method="POST">
				<input type="hidden" name="intId" value="<?php echo htmlspecialchars($intId) ?>" />
    	        <table id="internship_create_edit">
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
    	            <tr>
    	                <th>Expiration Date</th>
    	                <td><input name="ExpirationDate" type="text" value="<?= $intExpiration ?>" /></td>
    	            </tr>
    	            <tr>
    	                <th>Description</th>
    	                <td><textarea rows="3" name="Description" ><?= $intDescription ?></textarea>
    	                </td>
    	            </tr>
    	        </table>

    	        <input type="submit" name="submit" value="Make changes" />
        	</form>

        <?php } else { ?>
            <p>We're sorry, there was an error retrieving data from the database.</p>
        <?php } ?>

        <hr />
        <!-- Buttons -->
        <a class="button" href="detail.php?id=<?= $intId ?>"><div>Back to Detail</div></a>

<?php }

# Build edit page
render_header();
render_nav('Edit Internship');

# Make sure GET id parameter is set
if (isset($_GET["id"])) {
    $intId = $_GET["id"];
    $data = get_internship_detail($intId);
    print_edit_main($data, $intId);
} else {
    print_error_main();
}

render_footer();

?>
