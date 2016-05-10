<?php
# update_db php file: db write-access layer
# Author: Casey Riggin
# Author: Chris Mendoza
include "query_db.php";

function updateContact($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
                       $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL)
{
    //This is still not working!
    //This is still not working!
    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE organization_contacts SET
      ContactFirstName = ?, ContactLastName = ? , Title = ? , OfficeNumber = ? , OfficeExtension = ? , CellNumber = ? ,
      EmailAddress = ? , Referral = ? , Hiring = ? , OnADAdvisoryCommittee = ? , LinkedInURL = ? WHERE ContactId = ? ");
    $stmt->bind_param("ssssssssbbsi", $ContactFirstName, $ContactLastName, $Title, $OfficeNumber, $OfficeExtension,
        $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL, $ContactId);
    $stmt->execute();


}

?>
