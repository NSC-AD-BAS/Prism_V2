/*
This script will drop and re-create the database with no dummy data in it. It does not create the views or stored procedures.
*/

DROP DATABASE IF EXISTS prism;
CREATE DATABASE prism;
USE prism;

CREATE TABLE organizations
(
	OrganizationId			INT				PRIMARY KEY 		AUTO_INCREMENT,
    OrganizationName		VARCHAR(100)	UNIQUE				NOT NULL,
    YearlyRevenue			INT				NULL                DEFAULT 0,
    NumOfEmployees			INT				NULL                DEFAULT 0,
	URL						VARCHAR(250)	NULL,
    StreetAddressLineOne	VARCHAR(250)	NULL,
    StreetAddressLineTwo	VARCHAR(250)	NULL,
    City					VARCHAR(250)	NULL,
    State					VARCHAR(250)	NULL,
--    Statement				VARCHAR(250)	NULL,
	Description 			TEXT			NOT NULL,
    GlassdoorURL            VARCHAR(250)    NULL, 
    isArchived              boolean         NOT NULL    DEFAULT 0
);

-- Updated Bob M, 4/25/2016
CREATE TABLE organization_contacts
(
	ContactId				INT				PRIMARY KEY			AUTO_INCREMENT,
    OrganizationId			INT				NOT NULL,
    ContactFirstName		VARCHAR(50)		NOT NULL, -- Changed from FullName to first and last fields
    ContactLastName			VARCHAR(50)		NOT NULL, -- Bob M. 4/25/2016
    Title					VARCHAR(100)	NOT NULL,
    OfficeNumber			VARCHAR(12)		NOT NULL,
    OfficeExtension			VARCHAR(10),
	CellNumber				VARCHAR(12),
    EmailAddress			VARCHAR(100)	NOT NULL,
    Referral 				VARCHAR(100), 		 	  -- Added Bob M. 4/25/2016
    Hiring					boolean 		NOT NULL, -- Added Bob M. 4/25/2016
    OnADAdvisoryCommittee	boolean			NOT NULL, -- Added Bob M. 4/25/2016
    LinkedInURL				VARCHAR(250), 			  -- Added Bob M. 4/25/2016
	CONSTRAINT Organization_Contact_fk_OrganizationId
		FOREIGN KEY (OrganizationId)
        REFERENCES organizations(OrganizationId)
);


CREATE TABLE internships
(
	InternshipId 			INT				PRIMARY KEY			AUTO_INCREMENT,
    PositionTitle			VARCHAR(100)	NOT NULL,
	Description				TEXT			NOT NULL,
    OrganizationId			INT				NOT NULL,
--  LocationState			VARCHAR(250)	NOT NULL, //Removed Bob M. 4/25/2016
--  LocationZip				VARCHAR(10)		NOT NULL, //Removed Bob M. 4/25/2016
    DatePosted				DATE			NOT NULL,
--  AppStartDate			DATE, 					  //Removed Bob M. 4/25/2016
--  AppEndDate				DATE, 					  //Removed Bob M. 4/25/2016
	StartDate				DATE,
    EndDate					DATE,			
--    SlotsAvailable			INT				NOT NULL,
    LastUpdated				DATETIME		NOT NULL,
    ExpirationDate          DATE        	NOT NULL,
    isDeleted               boolean         NOT NULL    DEFAULT 0,
	CONSTRAINT Internship_fk_OrganizationId
		FOREIGN KEY (OrganizationId)
        REFERENCES organizations(OrganizationId)
);

CREATE TABLE user_types
(
	TypeId					INT				PRIMARY KEY			AUTO_INCREMENT,
    TypeName				VARCHAR(12)		UNIQUE				NOT NULL
);




CREATE TABLE users
(
	UserId					INT				PRIMARY KEY			AUTO_INCREMENT,

    FirstName				VARCHAR(50)		NOT NULL,
    MiddleName				VARCHAR(50)		NULL, 
    LastName				VARCHAR(50)		NOT NULL,
--    ContactInfo				TEXT			NULL, //Replaced with Phone and Email Bob M. 4/25/2016
	PhoneNumber				VARCHAR(20),  -- Added to replace ContactInfo field
    EmailAddress			VARCHAR(100), -- Added to replace ContactInfo field
    UserName				VARCHAR(250)	NOT NULL			UNIQUE,
    UserPassword			VARCHAR(500)	NOT NULL,
    TypeId					INT				NOT NULL,
	CONSTRAINT User_fk_TypeId
		FOREIGN KEY (TypeId)
        REFERENCES user_types(TypeId)
);


CREATE TABLE intern_capstone_status
(
	Id				INT 			PRIMARY KEY, 
    Description		VARCHAR(50)		NOT NULL
);

CREATE TABLE program_status
(
	Id				INT 			PRIMARY KEY, 
    Description		VARCHAR(50)		NOT NULL
);

CREATE TABLE application_status
(
	Id				INT 			PRIMARY KEY, 
    Description		VARCHAR(50)		NOT NULL
);


CREATE TABLE students
(
	StudentKeyId			INT 			PRIMARY KEY      AUTO_INCREMENT, 
    UserId                  INT             UNIQUE              NOT NULL,
	StudentId				INT             NOT NULL, 	
    PreferredName			VARCHAR(50)		NULL,
	Internship				VARCHAR(250),
	Cohort					VARCHAR(20)		NOT NULL,
    ApplicationStatusId		INT		NOT NULL,
    ProgramStatusId     	INT		NOT NULL,
    InternCapstoneStatusId  INT		NOT NULL,
    ResumeURL				VARCHAR(250)	NULL,
    LinkedInURL				VARCHAR(250)	NULL,
	StreetAddressLineOne	VARCHAR(250)	NULL,
    StreetAddressLineTwo	VARCHAR(250)	NULL,
    City					VARCHAR(250)	NULL,
    State					VARCHAR(250)	NULL,
    Zipcode					VARCHAR(250)	NULL,
    isDeleted			BOOLEAN 	NOT NULL 	DEFAULT 0,
	CONSTRAINT Student_fk_UserId
		FOREIGN KEY (UserId)
        REFERENCES users(UserId),
	CONSTRAINT Student_fk_ApplicationStatusId
		FOREIGN KEY (ApplicationStatusId)
        REFERENCES application_status(Id),
	CONSTRAINT Student_fk_ProgramStatusId
		FOREIGN KEY (ProgramStatusId)
        REFERENCES program_status(Id),
	CONSTRAINT Student_fk_InternCapstoneStatusId
		FOREIGN KEY (InternCapstoneStatusId)
        REFERENCES intern_capstone_status(Id)
);



-- CREATE TABLE student_internships
-- (
-- 	InternshipId 			INT				NOT NULL,
-- 	StudentId				INT 			NOT NULL,
-- 	CONSTRAINT Student_Internship_fk_InternshipId
-- 		FOREIGN KEY (InternshipId)
--         REFERENCES internships(InternshipId),
-- 	CONSTRAINT Student_Internship_fk_StudentId
-- 		FOREIGN KEY (StudentId)
--         REFERENCES students(StudentId)
-- );

CREATE TABLE student_contact_log
(
	Student_Contact_LogId	INT 			PRIMARY KEY		AUTO_INCREMENT, 
    StudentKeyId			INT 			NOT NULL,
    LogTime					TIMESTAMP		NOT NULL		DEFAULT CURRENT_TIMESTAMP  		ON UPDATE CURRENT_TIMESTAMP,
    Notes					TEXT			NOT NULL,
	UserId					INT				NOT NULL,
	CONSTRAINT Student_Contact_Log_fk_StudentKeyId
		FOREIGN KEY (StudentKeyId)
        REFERENCES students(StudentKeyId),
	CONSTRAINT Student_Contact_Log_fk_UserId
		FOREIGN KEY (UserId)
        REFERENCES users(UserId)
);


CREATE TABLE change_log
(
	Change_LogId			INT 			PRIMARY KEY			AUTO_INCREMENT, 
    LogTime					TIMESTAMP		NOT NULL			
	DEFAULT CURRENT_TIMESTAMP  		ON UPDATE CURRENT_TIMESTAMP,
    UserId					INT				NOT NULL,
    Message					TEXT			NOT NULL,
	CONSTRAINT Change_Log_fk_UserId
		FOREIGN KEY (UserId)
        REFERENCES users(UserId)
);


CREATE TABLE user_notes
(
	User_NoteId				INT 			PRIMARY KEY			AUTO_INCREMENT, 
	UserId					INT				NOT NULL,
	Note_Type				VARCHAR(100)	NOT NULL,
    Note_Text				TEXT			NOT NULL,
	CONSTRAINT User_Note_Log_fk_UserId
		FOREIGN KEY (UserId)
        REFERENCES users(UserId)
);

SET NAMES 'utf8';

--
-- Inserting data into table organizations
--
INSERT INTO user_types
(TypeId, TypeName)
VALUES
(1, 'Student'),
(2, 'Admin'),
(3, 'Faculty');
