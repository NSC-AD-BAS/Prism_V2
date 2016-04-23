#Student Lists (Accessible by Faculty/Admin)
Display a list of student records 
  List Data: 
    Student Name 
    Cohort/Year
    Active status
      Active
      Inactive
      Graduated
    Internship/Capstone Status
      Incomplete
      Completed
      In Progress
    Application Status
      Applied
      Provisionally Accepted
      Fully Accepted
      Withdrawn
      Denied
  Each table row is link to detail view of that record. 
  Search functionality above table. 
    Plaintext search by name
    Filter by cohort
    Filter by Active Status
    Filter by internship Status
    Filter by Application Status
  Enable multiple filter conditions, ie filter by Active Statuses Inactive and Graduated.

#Student Detail (Accessible by Faculty/Admin)
-Displays a document view for a single student record (Faculty view)
  -Document data:
    -Student Name (Editable by Faculty)
    -Preferred Name (Editable by Faculty)
    -SID (Editable by Faculty)
    -Cohort/Year (Editable by Faculty)
    -Active Status (Editable by Faculty)
    -Internship Status (Editable by Faculty)
    -Link to internship record if exists*
    -Application Status(Editable by Faculty)
    -Resume URL(Editable by Faculty)
    -LinkedIn URL(Editable by Faculty)
    -Contact Info (Editable by Faculty)
    -Address, City, State, Zip (Editable by Faculty)
    -User Notes (Viewable by Faculty/Admin) (Editable by Faculty)
  -Next/Previous navigation
  -Next/previous links to present the detail view of the next/prev record. 
  -Link to return to list, rather than back button nav.
  -Add new user note functionality
  -Faculty and admin users can add text notes to student record. 
  <ADMIN> Archive Student
    -Set’s student record to Archived status. 
    -Confirmation required
  -<ADMIN> Delete Archived Student
    -Remove Archived student record from system
    -Confirmation required

