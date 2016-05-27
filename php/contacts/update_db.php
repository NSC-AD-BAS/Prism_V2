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
        $message = "Failed contact update action";
        $userid = 1;
        $stmtlog = $conn->prepare("INSERT INTO change_log (UserId, Message)  VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return $stmt->error;
    } else {
        $message = "User Steve Balo edited contact " . $ContactFirstName . " " . $ContactLastName .".";
        $userid = 1;  // Hard coded userid will change once sessions are properly implemented, then pull
                        // userid from that
        $stmtlog = $conn->prepare("INSERT INTO change_log  (UserId, Message) VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
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

    $userid = 1;

    if (!$stmt->execute()) {
        $message = "Failed contact create action";
        $stmtlog = $conn->prepare("INSERT INTO change_log (UserId, Message)  VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return $stmt->error;
    } else {
        // Insert into change log
        $message = "User Steve Balo created contact " . $ContactFirstName . " " . $ContactLastName . ".";
        $stmtlog = $conn->prepare("INSERT INTO change_log  (UserId, Message) VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return true;
    }
}
?>
