<?php
# edit php file: updates an internship in the database
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("update_db.php");
include_once("../login/login_utils.php");

# Session management
session_start();
if (!is_logged_in()) {
    to_login();
}

# Prints the main html for this internship edit
function print_edit_main($data, $intId) { ?>
    <!-- Main view -->
    <main>
        <?php
		# Make sure we have data
        if (count($data) > 0) {
            $data = $data[0];
            $intPosition = $data["Position Title"];
            $intCompany = $data["Organization"];
            $intDatePosted = $data["Date Posted"];
            $intStartDate = $data["Start Date"];
            $intEndDate = $data["End Date"];
            $intLocation = $data["Location"];
            $intDescription = $data["Job Description"];
            $intLastUpdated = $data["Last Update"];
            $intExpiration = $data["Expiration Date"]; ?>

			<!-- HTML content -->
            <h1>Internship Edit</h1>
            <form action="confirm_edit.php" method="POST">
				<input type="hidden" name="intId" value="<?php echo htmlspecialchars($intId) ?>" />
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
					<tr>
    	                <th>Location</th>
    	                <td><input name="Location" type="text" value="<?= $intLocation ?>" /></td>
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

        <!-- Buttons -->
        <a class="button" href="detail.php?id=<?= $intId ?>"><div>Back to Detail</div></a>

    </main>
<?php }

# Build edit page
print_top();

# Make sure GET id parameter is set
if (isset($_GET["id"])) {
    $intId = $_GET["id"];
    $data = get_internship_detail($intId);
    print_edit_main($data, $intId);
} else {
    print_error_main();
}

print_bottom();

?>
