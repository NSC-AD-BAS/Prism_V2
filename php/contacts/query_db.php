<?php
function db_connect()
{
    include '../lib/db_connect.php';
    //create and verify connection
    $conn = db_connect();
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
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

?>
