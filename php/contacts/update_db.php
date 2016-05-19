<?php
# update_db php file: db write-access layer
# Author: Casey Riggin
# Author: Chris Mendoza
include "query_db.php";

function updateContact($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
                       $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL)
{
    $Hiring = intval(boolval($Hiring));
    $OnADAdvisoryCommittee = intval(boolval($OnADAdvisoryCommittee));
    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE organization_contacts SET
      ContactFirstName = ?, ContactLastName = ? , Title = ? , OfficeNumber = ? , OfficeExtension = ? , CellNumber = ? ,
      EmailAddress = ? , Referral = ? , Hiring = ? , OnADAdvisoryCommittee = ? , LinkedInURL = ? WHERE ContactId = ? ");
    $stmt->bind_param("ssssssssiisi", $ContactFirstName, $ContactLastName, $Title, $OfficeNumber, $OfficeExtension,
        $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL, $ContactId);

    if (!$stmt->execute()) {
        return $stmt->error;
    } else {
        return true;
    }
}


function createContact($OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
                       $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL)
{

    $Hiring = intval(boolval($Hiring));
    $OnADAdvisoryCommittee = intval(boolval($OnADAdvisoryCommittee));
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO organization_contacts  (OrganizationId, ContactFirstName, ContactLastName, Title, OfficeNumber,
       OfficeExtension, CellNumber, EmailAddress, Referral, Hiring, OnADAdvisoryCommittee, LinkedInURL)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    $stmt->bind_param("issssssssiis", $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber, $OfficeExtension,
        $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL);
    if (!$stmt->execute()) {
        return $stmt->error;
    } else {
        return true;
    }
}
?>
