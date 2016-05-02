<?php
# update_db php file: db write-access layer
# Author: Tim Davis
# Author: Kellan Nealy

# this page calls itself with non-empty POST data
# if the POST data contains everything the table in the database needs
# it will be added to the database
include "update_db.php";
include "common.php";

print_top();

# process the POST params for create new internship
if (isset($_POST['PositionTitle']) && isset($_POST['organization']) && isset($_POST['DatePosted'])
	&& isset($_POST['StartDate']) && isset($_POST['EndDate']) && isset($_POST['Location'])
	&& isset($_POST['SlotsAvailable']) && isset($_POST['ExpirationDate']) && isset($_POST['Description'])) {

	echo "POST variables set!";

	# need to follow up with DB people about how to setup link between org and internship
	$internship_data = array("PositionTitle"=>$_POST['PositionTitle'], "OrganizationId"=>"55",
		"DatePosted"=>$_POST['DatePosted'], "StartDate"=>$_POST['StartDate'], "EndDate"=>$_POST['EndDate'],
		"Location"=>$_POST['Location'], "SlotsAvailable"=>$_POST['SlotsAvailable'],
		"ExpirationDate"=>$_POST['ExpirationDate'], "Description"=>$_POST['Description']);

	add_internship($internship_data);
}
# call add_internship from update_db.php with the correct assoc array

?>

    <!-- Main view -->
    <main>
        <h1>Internship Create</h1>
        <form action="create.php" method="POST">
	        <table id="internship_detail">
	            <tr>
	                <th>Position</th>
	                <td><input name="PositionTitle" type="text" /></td>
	            </tr>
	            <tr>
	                <th>Company</th>
	                <td><input name="organization" type="text" /></td>
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
	                <th>Location</th>
	                <td><input name="Location" type="text" /></td>
	            </tr>
	            </tr>
	                <th>Slots Available</th>
	                <td><input name="SlotsAvailable" type="text" /></td>
	            </tr>
	            </tr>
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

        <!-- Buttons -->
        <a class="button" href="list.html"><div>Back to List</div></a>

    </main>

<?php
	print_bottom();
?>