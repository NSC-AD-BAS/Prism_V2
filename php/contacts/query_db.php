<?php
function db_connect()
{
    include '../lib/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
}

function get_contacts_list()
{
    $conn = db_connect();
    //Note to self, make this line more readable by breaking it up
    $sql = "SELECT cts.ContactId, CONCAT(cts.ContactLastName, ', ', cts.ContactFirstName) as 'Name', cts.title, cts.CellNumber, cts.EmailAddress, orgs.OrganizationName FROM organization_contacts cts INNER JOIN organizations orgs ON cts.OrganizationId = orgs.OrganizationId ORDER BY cts.ContactLastName, cts.ContactFirstName";

    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_contact_detail($id)
{
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT cts.*, orgs.OrganizationName from organization_contacts cts INNER JOIN organizations orgs ON cts.OrganizationId = orgs.OrganizationId where cts.OrganizationId = ? limit 1");
    $stmt->bind_param("i", $id);
    /* execute query */
    $stmt->execute();

    $stmt->bind_result($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
        $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL,
        $OrganizationName);

    $output = false;
    while ($stmt->fetch()) {
        $output[] = [$ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
            $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL,
            $OrganizationName];
    }

    //clean-up result set and connection
    mysqli_close($conn);
    return $output;
}

//This should be moved to a separate file, but lets just leave it here for now...
function update_contact_detail($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
                               $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL)
{
    $conn = db_connect();
    $stmt = $conn->prepare("");
    $stmt->bind_param("i", $id);
    /* execute query */
    $stmt->execute();

    //clean-up result set and connection
    mysqli_close($conn);
    return true;
}

?>
