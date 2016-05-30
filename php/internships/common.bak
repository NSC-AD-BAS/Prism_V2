<?php
# common php file: holds common code used between all files
# Author: Tim Davis
# Author: Kellan Nealy

//NOTE: The page building functions have been moved to page_builder
//      get_companies_list() was moved to query_db.

# Prints common error message
function print_error_main() { ?>
    <main>
        <h1>An id was not recieved, please try again with an id.</h1>

        <!-- Buttons -->
        <a class="button" href="list.php"><div>Back to List</div></a>
    </main>
<?php }

# use output array from get_companies_list to print options
function print_company_options ($company_array, $company_name) {
	foreach ($company_array as $company) {
		$text = "<option value=\"" . $company['OrganizationId'] . "\"";
        if ($company_name == $company["Organization Name"]) {
            $text = $text . " selected=\"selected\" ";
        }
        $text = $text . ">" . $company['Organization Name'] . "</option>";
        echo $text;
	}
}

?>
