USE prism;


INSERT INTO organizations(
	OrganizationId, 
    OrganizationName, 
    YearlyRevenue, 
    NumOfEmployees, 
    URL, 
    StreetAddressLineOne, 
    StreetAddressLineTwo, 
    City, 
    State,  
    Description
)VALUES
(1, "Microsoft", 10000000, 10000, "http://www.microsoft.com", "1 Microsoft Way", NULL, "Redmond", "WA" , "Microsoft description goes here. Are Statement and Description fields necessary?"),
(2, "Facebook", 10000000, 15000, "http://www.facebook.com", "1 Facebook Way", NULL, "Seattle", "WA", "Facebook description goes here. Are Statement and Description fields necessary?"),
(3, "Twitter", 10000000, 2000, "http://www.twitter.com", "1 Twitter Way", NULL, "Bellevue", "WA","Twitter description goes here. Are Statement and Description fields necessary?"),
(4, "Adobe", 10000000, 500, "http://www.adobe.com", "1 Adobe Way", NULL, "Seattle", "WA","Adobe description goes here. Are Statement and Description fields necessary?"),
(5, "Consulto Services", 10000000, 200, "http://www.consulto.com", "1 Consulto Way", NULL, "Bothell", "WA", "Consulto description goes here. Are Statement and Description fields necessary?"),
(6, "Google", 10000000, 10000, "http://www.google.com", "1 Google Way", NULL, "Seattle", "WA",  "Google description goes here. Are Statement and Description fields necessary?"),
(7, "Contoso", 10000000, 90, "http://www.contosocorp.com", "1 Contoso Way", NULL, "Auburn", "WA",  "Contoso description goes here. Are Statement and Description fields necessary?"),
(8, "Expeditors", 10000000, 800, "http://www.expeditors.com", "1 Exeditors Way", NULL, "Seattle", "WA",  "Exeditors description goes here. Are Statement and Description fields necessary?"),
(9, "Oculus VR", 10000000, 500, "http://www.oculusvr.com", "1 Oculus Way", NULL, "Redmond", "WA",  "Oculus description goes here. Are Statement and Description fields necessary?"),
(10, "AT&T", 10000000, 10000, "http://www.att.com", "1 AT&T Way", NULL, "Seattle", "WA",  "AT&T description goes here. Are Statement and Description fields necessary?")

;

INSERT INTO internships(
	InternshipId,
    PositionTitle, 
    Description,
    InternshipUrl, 
    OrganizationId, 
    DatePosted, 
    StartDate, 
    EndDate, 
    LastUpdated,
    ExpirationDate
) VALUES
(1, "SDET Intern", "Exciting opportunity for students interested in QA", "microsoft.com", 1,                     CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(2, "Web Developer Intern", "Exciting opportunity for students interested in LAMP", "Facebook.com", 2,          CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(3, "App Developer Intern", "Exciting opportunity for students interested in Android/iOS","Twitter.com", 3,   CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(4, "Embedded Systems Intern", "Exciting opportunity for students interested in C","adobe.com", 4,          CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(5, "PHP Intern", "Exciting opportunity for students interested in PHP", "consulto.com/careers",1,                     CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(6, "Java Developer Intern", "Exciting opportunity for students interested in Java","google.com", 6,         CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(7, "C++ Intern", "Exciting opportunity for students interested in C++","contoso.com", 7,                     CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(8, "C#/.NET Intern", "Exciting opportunity for students interested in .NET", "expeditors.com",8,                CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(9, "Ruby Intern", "Exciting opportunity for students interested in Ruby", "oculus.com",9,                   CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY),
(10, "Python Intern", "Exciting opportunity for students interested in Python/Django", "att.com",10,      CURDATE(), NULL, NULL,  CURDATE(), CURDATE() + INTERVAL 84 DAY)
;

INSERT INTO organization_contacts(
	ContactId, 
    OrganizationId, 
    ContactFirstName, 
    ContactLastName, 
    Title, 
    OfficeNumber, 
    OfficeExtension, 
    CellNumber, 
    EmailAddress, 
    Referral, 
    Hiring, 
    OnADAdvisoryCommittee, 
    LinkedInURL
) VALUES
( 1, 1, "Jane", "Doe", "Recruitment Director", "425-111-1111", "1111", "206-111-1111", "janedoe@microsoft.com", "Clarify This", TRUE, FALSE, "http://linkedin.com/ln/janedoe" ),
( 2, 2, "John", "Poe", "Sr Engineer", "425-111-1111", "1111", "206-111-1111", "johnpoe@facebook.com", "Clarify This", FALSE, TRUE, "http://linkedin.com/ln/johnpoe" ),
( 3, 3, "Kim", "Cotrill", "Project Manager", "425-111-1111", "1111", "206-111-1111", "kimc@twitter.com", "Clarify This", TRUE, TRUE, "http://linkedin.com/ln/kimcotrill" ),
( 4, 4, "Ken", "LeBlond", "Talent Coordinator", "425-111-1111", "1111", "206-111-1111", "kenleb@adobe.com", "Clarify This", FALSE, FALSE, "http://linkedin.com/ln/kenleblond" ),
( 5, 5, "Bill", "Ball", "HR Director", "425-111-1111", "1111", "206-111-1111", "bball@consulto.com", "Clarify This", TRUE, FALSE, "http://linkedin.com/ln/billball" ),
( 6, 6, "Barb", "James", "Sr SDET", "425-111-1111", "1111", "206-111-1111", "barbarajames@google.com", "Clarify This", FALSE, TRUE, "http://linkedin.com/ln/barbjames" ),
( 7, 7, "Archie", "Fjord", "QA Manager", "425-111-1111", "1111", "206-111-1111", "arfjor@contoso.com", "Clarify This", TRUE, TRUE, "http://linkedin.com/ln/archiefjord" ),
( 8, 8, "Anna", "Warren", "Talent Director", "425-111-1111", "1111", "206-111-1111", "annwar@expeditors.com", "Clarify This", FALSE, FALSE, "http://linkedin.com/ln/annawarren" ),
( 9, 9, "Zed", "Van Buren", "Recruitment Coordinator", "425-111-1111", "1111", "206-111-1111", "zvb@oculusvr.com", "Clarify This", TRUE, FALSE, "http://linkedin.com/ln/zedvanburen" ),
( 10, 10, "Zoe", "Pitt", "Principal Engineer", "425-111-1111", "1111", "206-111-1111", "pizo@att.com", "Clarify This", TRUE, FALSE, "http://linkedin.com/ln/zoepitt" )
;

INSERT INTO users(
	UserId, 
    FirstName, 
    MiddleName, 
    LastName, 
    PhoneNumber, 
    EmailAddress, 
    UserName, 
    UserPassword, 
    TypeId
) VALUES
(1, "Steven", "", "Balo", "206-111-1111", "steven@balo.com", "steba", "steba", 2),
(2, "Alfred", "", "Sterling", "206-111-1111", "casey@casey.com", "casri", "casri", 1 ),
(3, "Alexis", "", "Vonnegut", "206-111-1111", "aiman@aiman.com", "aimma", "aimma", 1 ),
(4, "Brian", "", "Asimov", "206-111-1111", "chris@chris.com", "chrme", "chrme", 1 ),
(5, "Bridgette", "W", "Bradbury", "206-111-1111", "bob@bob.com", "robmc", "robmc", 1 ),
(6, "Carl", "", "Lovelace", "206-111-1111", "jeremy@jeremy.com", "jerdu", "jerdu", 1 ),
(7, "Chloe", "", "Gibson", "206-111-1111", "nathan@nathan.com", "natfl", "natfl", 1 ),
(8, "Dave", "", "Turing", "206-111-1111", "sai@sai.com", "saich", "siach", 1 ),
(9, "Donna", "", "Kennedy", "206-111-1111", "mario@mario.com", "marro", "marro", 1 ),
(10, "Eric", "", "Lincoln", "206-111-1111", "kellan@kellan.com", "kelne", "kelne", 1 ),
(11, "Ethel", "", "Washington", "206-111-1111", "tim@tim.com", "timda", "timda", 1 ),
(12, "Frank", "", "Franklin", "206-111-1111", "joe@joe.com", "joemc", "joems", 1 ),
(13, "Flo", "", "Van Buren", "206-111-1111", "austin@austin.com", "ausam", "ausam", 1 ),
(14, "John", "", "Stager", "206-111-1111", "john@stager.com", "johst", "johst", 2),
(15, "Faculty", "", "Faculty", "111-111-1111", "faculty@faculty.com", "facul", "facul", 3)
;

-- Move these to 1_Create...
INSERT INTO intern_capstone_status(Id, Description)
VALUES
(0, "(None Selected)"),
(1, "Incomplete"),
(2, "Completed"),
(3, "In Progress");

INSERT INTO program_status(Id, Description)
VALUES
(0, "(None Selected)"),
(1, "Active"),
(2, "Inactive"),
(3, "Graduated");

INSERT INTO application_status(Id, Description)
VALUES
(0, "(None Selected)"),
(1, "Applied"),
(2, "Provisionally Accepted"),
(3, "Fully Accepted"),
(4, "Wihtdrawn"),
(5, "Denied");


INSERT INTO students(
	StudentId, 
    PreferredName, 
    Internship, 
    Cohort, 
    UserId, 
    ApplicationStatusID,
    ProgramStatusId,
    InternCapstoneStatusId,
    ResumeURL, 
    LinkedInURL,
    StreetAddressLineOne, 
    StreetAddressLineTwo, 
    City, 
    State,
    Zipcode
) VALUES 
(111111111, "Jimbo", "Internship Company Name", "201501", 2, 1, 1, 1, NULL, "LinkedinURL", NULL, NULL, "Seattle", "WA", "98123")
;

INSERT INTO change_log(Change_LogId, LogTime, UserId, Message) VALUES
(1, '2015-12-29 00:16:35', 1, 'Eventually, the negative impact of the internal network...'),
(2, '2015-12-01 00:00:12', 2, 'Doubtless, the organization of the mechanism involves...'),
(3, '2016-01-03 01:13:18', 7, 'It goes without saying that a huge improvement of the...'),
(4, '2015-12-30 09:19:20', 14, 'Up to a certain time, the results of the strategic decision...'),
(5, '2015-12-01 00:00:56', 15, 'Asdf')
;

INSERT INTO user_notes(User_NoteId, UserId, Note_Type, Note_Text) VALUES
(1, 2, 'Security', 'To put it simply, the framework of the comprehensive methods must take into...'),
(2, 3, 'Intership', 'In respect that in terms of the the profit benefits from permanent interrelation ...'),
(3, 4, 'Company', 'Conversely, an basic component of the utilization of the major and minor objectives ...'),
(4, 5, 'Security', 'Regardless of the fact that an basic component of the structure of the final ...')
;

-- INSERT INTO student_contact_log()VALUES();


--
-- Fixing student TypeId to 1
--
-- SET SQL_SAFE_UPDATES = 0;
-- UPDATE students AS s
-- INNER JOIN users as u ON u.UserId = s.UserId
-- SET TypeId=1 WHERE TypeId != 1;
-- SET SQL_SAFE_UPDATES = 1;
