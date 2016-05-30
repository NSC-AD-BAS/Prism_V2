USE prism;
-- 
-- View Creation
-- 

-- Updated Bob M. 4/25/2016
CREATE OR REPLACE VIEW internship_list AS
    (SELECT 
        i.InternshipId,
	o.OrganizationId,
        i.PositionTitle AS `Position Title`,
        o.OrganizationName AS `Organization`,
        CONCAT(o.City, ", ", o.State) AS `Location`
    FROM
        internships i
            JOIN
        organizations o ON o.OrganizationId = i.OrganizationId
    WHERE NOT i.isDeleted
);

-- Updated Bob M. 5/15/2016
CREATE OR REPLACE VIEW internship_list_deleted AS
    (SELECT 
        i.InternshipId,
	o.OrganizationId,
        i.PositionTitle AS `Position Title`,
        o.OrganizationName AS `Organization`,
        CONCAT(o.City, ", ", o.State) AS `Location`
    FROM
        internships i
            JOIN
        organizations o ON o.OrganizationId = i.OrganizationId
    WHERE i.isDeleted
);

-- Updated Bob M. 4/27/2016
CREATE OR REPLACE VIEW internship_detail AS
    (SELECT 
        i.InternshipId,
	o.OrganizationId,
        i.PositionTitle AS `Position Title`,
        o.OrganizationName AS `Organization`,
        i.DatePosted AS `Date Posted`,
        i.StartDate AS `Start Date`,
        i.EndDate AS `End Date`,
	o.StreetAddressLineOne AS `Address 1`, 
	o.StreetAddressLineTwo AS `Address 2`,
        CONCAT(o.City, ", ",o.State) AS `Location`,
        i.description AS `Job Description`,
        i.InternshipUrl AS `Internship URL`,
        i.LastUpdated AS `Last Update`,
        i.ExpirationDate AS `Expiration Date`,
        i.isDeleted
    FROM
        internships i
            JOIN
        organizations o ON o.OrganizationId = i.OrganizationId);

-- Updated Bob M. 4/25/2016
CREATE OR REPLACE VIEW org_list AS
    (SELECT
		o.OrganizationId ,
        o.OrganizationName AS `Organization Name`,
        CONCAT(o.City, ", ", o.State) AS `Location`,
        COUNT( i.InternshipId ) AS `Available Internships`
    FROM
        organizations o
             LEFT JOIN
        internships i ON i.organizationId = o.organizationId
    WHERE NOT o.isDeleted
    GROUP BY
        i.organizationId
        );

-- Updated Bob M. 5/15/2016
CREATE OR REPLACE VIEW org_list_archived AS
    (SELECT
		o.OrganizationId ,
        o.OrganizationName AS `Organization Name`,
        CONCAT(o.City, ", ", o.State) AS `Location`,
        COUNT( i.InternshipId ) AS `Available Internships`
    FROM
        organizations o
            LEFT JOIN
        internships i ON i.organizationId = o.organizationId
    WHERE o.isDeleted
    GROUP BY
        i.organizationId
        );

-- ADDED Bob M. 4/27/2015
CREATE OR REPLACE VIEW org_contact_list AS 
    (SELECT 
        oc.ContactID,
        o.OrganizationId,
        CONCAT(oc.ContactFirstName, " ", oc.ContactLastName) AS `Contact Name`,
        oc.Title,
        oc.EmailAddress AS `Email Address`,
        oc.OfficeNumber AS `Office Phone`, 
        oc.OfficeExtension AS `Extension`,
        oc.CellNumber AS `Mobile Number`,
        oc.Referral,
        oc.Hiring,
        oc.OnADAdvisoryCommittee AS `AD Advisory Committee Member`,
        oc.LinkedInURL AS `LinkedIn` 
    FROM
        organization_contacts oc
            JOIN
        organizations o ON oc.OrganizationId = o.OrganizationId
        );

-- Updated Bob M. 4/27/2016
CREATE OR REPLACE VIEW org_detail AS
    (SELECT 
        o.OrganizationId,
        o.OrganizationName AS `Company`,
        o.URL,
        o.StreetAddressLineOne AS `Address 1`,
        o.StreetAddressLineTwo AS `Address 2`,
        o.City,
        o.State,
        o.NumOfEmployees AS `Number of Employees`,
        o.YearlyRevenue AS `Yearly Revenue`,
        o.Description,
        o.GlassdoorURL AS `Glassdoor Link`,
        o.isDeleted
    FROM
        organizations o
           LEFT JOIN
        internships i ON o.OrganizationId = i.OrganizationId);

CREATE OR REPLACE VIEW student_detail AS
    (SELECT 
        u.UserId,
        u.FirstName AS `Student First Name`,
        u.MiddleName AS `Student Middle Name`,
        u.LastName AS `Student Last Name`,
        s.PreferredName AS `Preferred Name`,
        s.StudentId AS `SID`,
        s.Cohort,
        s.ProgramStatusId AS `Program Status Id`,
        ps.Description AS `Program Status`,
        s.InternCapstoneStatusId AS `Internship/Capstone Status Id`,
        ics.Description AS `Internship/Capstone Status`,
        s.ApplicationStatusId AS `Application Status Id`,
        aps.Description AS `Application Status`,
        s.ResumeURL AS `Resume`,
        s.LinkedInURL AS `LinkedIn Profile`,
        s.Internship AS `Internship`,
        u.PhoneNumber AS `Phone`,
        u.EmailAddress AS `Email`,
        s.StreetAddressLineOne AS `Address 1`,
        s.StreetAddressLineTwo AS `Address 2`,
        s.City,
        s.State,
        s.Zipcode,
        s.isDeleted
    FROM
        students s
            JOIN
        users u ON u.userId = s.userId
            JOIN
        program_status ps ON ps.Id = s.ProgramStatusId
            JOIN
        intern_capstone_status ics ON ics.Id = s.InternCapstoneStatusId
            JOIN
        application_status aps ON aps.Id = s.ApplicationStatusId);
            
       
CREATE OR REPLACE VIEW user_list AS
    (SELECT 
        u.UserId AS `User ID`,
		CONCAT(u.FirstName, " ", u.LastName) AS `Name`,
        u.PhoneNumber AS `Phone`,
        u.EmailAddress AS `Email Address`,
        t.TypeName AS `User Type`
    FROM
        users u
			JOIN
        user_types t ON t.TypeId = u.TypeId
	WHERE u.TypeId != 1
	);

-- CREATE OR REPLACE VIEW user_detail AS
--     (SELECT 
--         *
--     FROM
--         user_list);

CREATE OR REPLACE VIEW change_list AS
    (SELECT 
        c.Change_LogId,
        c.LogTime,
        c.UserId,
  --      	u.FirstName AS `Student First Name`,
  --       u.MiddleName AS `Student Middle Name`,
		-- u.LastName AS `Student Last Name`,
        c.Message
    FROM
        change_log c
            JOIN
        users u ON u.UserId = c.UserId);

-- CREATE OR REPLACE VIEW change_detail AS
--     (SELECT 
--         *
--     FROM
--         change_list);

DROP PROCEDURE IF EXISTS `internship_detail_single`;
DROP PROCEDURE IF EXISTS `org_detail_single`;
DROP PROCEDURE IF EXISTS `internship_list_by_org`;
DROP PROCEDURE IF EXISTS `student_detail_single`;
DROP PROCEDURE IF EXISTS `user_detail_single`;
DROP PROCEDURE IF EXISTS `change_detail_single`;

DELIMITER //
CREATE PROCEDURE `internship_detail_single` (IN internship_ID INT)
	BEGIN
		SELECT * FROM internship_detail i
		WHERE i.InternshipId = internship_id;
	END //
    
CREATE PROCEDURE `org_detail_single` (IN org_ID INT)
	BEGIN
		SELECT * FROM org_detail o
		WHERE o.organizationId = org_id;
	END //

CREATE PROCEDURE `internship_list_by_org` (IN org_ID INT)
	BEGIN
		SELECT * FROM internship_list i
		WHERE i.`organizationId` = org_ID;
	END //
    
CREATE PROCEDURE `student_detail_single` (IN sid INT)
	BEGIN
		SELECT * FROM student_detail s
		WHERE s.SID = sid;
	END //
    
CREATE PROCEDURE `user_detail_single` (IN user_id INT)
	BEGIN
		SELECT * FROM user_detail u
		WHERE u.`User Id` = user_id;
	END //
    
CREATE PROCEDURE `change_detail_single` (IN change_id INT)
	BEGIN
		SELECT * FROM change_detail c
		WHERE c.Change_LogId = change_id;
	END //
DELIMITER ; 

