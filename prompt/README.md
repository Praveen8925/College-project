# College Management System

## Project Description
This is a comprehensive College Management System developed for SREE SARASWATHI THYAGARAJA COLLEGE, an autonomous institution affiliated to Bharathiar University. The system is built using PHP and MySQL, providing a web-based interface for managing various college operations including student management, staff management, attendance tracking, assignments, internal marks, events, and reporting.

## Features
- **User Authentication**: Login system for admin, students, and staff
- **Student Management**: Add, edit, view student details, discontinue students
- **Staff Management**: Add, edit, view staff details, allocation, transfers
- **Attendance Management**: Class attendance, student attendance tracking and reports
- **Assignment Management**: Add assignments, view, submit, and generate reports
- **Notes Management**: Add and manage notes, generate reports
- **Subject Management**: Add and finalize subjects
- **Timetable Management**: Cycle tests, model exams, semester timetables
- **Internal Marks**: COE internal marks, student internal marks
- **Complaints System**: Submit and resolve complaints
- **Events Management**: Add, list, and manage college events
- **Alumni Management**: Manage alumni details
- **Associations**: Manage associations, activities, and members
- **Labs**: Manage lab details
- **Publications**: Staff and student publications reports
- **Work Diary**: Staff work diary management
- **Reports**: Various reports for staff, students, attendance, assignments, etc.
- **PDF Generation**: Generate PDFs for reports, timetables, marksheets using FPDF
- **Excel Exports**: Export data to Excel for various reports

## Installation
1. Install PHP and MySQL on your server.
2. Create a database named `collegedetails`.
3. Import the database schema from the `database/` folder.
4. Copy all files to your web server's document root.
5. Update database credentials in `database.php` if necessary.
6. Ensure the following directories are writable: `upload/`, `assignment/`, `rsyllabus/`, `syllabus/`.
7. Access the system via `index.php`.

### Dependencies
- PHP 5.1.0 or higher
- MySQL
- FPDF library (included in `fpdf.php` and `font/` directory)
- jQuery and other JS libraries in `JS/` folder
- CSS styles in `css/` folder

## Usage
1. Access the login page at `index.php`.
2. Login with appropriate credentials:
   - Admin: username "admin", password as set in database
   - Students: Registration number starting with 'N'
   - Staff: As per database
3. Navigate through the system using the iframe-based interface.
4. Perform various operations based on user role.

## File Structure
The project is organized as follows:

### Root Files
- `index.php`: Main entry point, login page
- `SLogin.php`: Login form and events display
- `Validate.php`: User authentication logic
- `User.php`: Main dashboard after login
- `Logout.php`: Logout functionality
- `database.php`: Database connection configuration
- `Connect.php`: Additional database connection (possibly duplicate)
- `banner.php`: College banner display
- `EventList.php`: Events listing
- `EventList1.php`: Events listing (alternative)
- `EventsAdd.php`: Add new events
- `EventsSave.php`: Save events
- `deleteevent.php`: Delete events
- `ChangePass.php`: Change password
- `Change.php`: Password change form
- `forgotpassword.php`: Forgot password functionality
- `Saveforgotpassword.php`: Save forgot password
- `profile.php`: User profile
- `FAQ.htm`: Frequently Asked Questions
- `changelog.htm`: Changelog for FPDF
- `license.txt`: License information
- `install.txt`: Installation notes for FPDF
- `dat.txt`: Data file
- `iiiiiiiiii.txt`: Test file
- `InternalMark2.txt`: Internal marks data
- `pddddddffffffff.php.txt`: Test PHP file
- `publicationreport.php.txt`: Publication report backup
- `assimentSave.php.txt`: Assignment save backup
- `XLstudworkshop.php.txt`: Excel workshop backup

### Student Management
- `addstudent.php`: Add new student
- `AddStudentSave.php`: Save student details
- `StudentDetail.php`: View student details
- `StudentList.php`: List all students
- `StudentOperation.php`: Student operations
- `studentSave.php`: Save student changes
- `Discontinue.php`: Discontinue student
- `discontinueSave.php`: Save discontinuation
- `compestudents.php`: Company students
- `studentcompany.php`: Student company details
- `ucompanies.php`: Update companies
- `ucompaniesdetails.php`: Company details
- `ucompanysave.php`: Save company updates
- `Alumni.php`: Alumni management
- `register.php`: Student registration
- `registerreport.php`: Registration report

### Staff Management
- `AddstaffDetail.php`: Add staff details
- `AddStaffSave.php`: Save staff details
- `StaffDetail.php`: View staff details
- `stafflist.php`: List all staff
- `StaffSave.php`: Save staff changes
- `allocatestaff.php`: Allocate staff
- `allocatestaffsave.php`: Save staff allocation
- `staffallocationdetail.php`: Staff allocation details
- `stafftransfer.php`: Staff transfer
- `stafftransfersave.php`: Save staff transfer
- `classincharge.php`: Class incharge
- `saveclassincharge.php`: Save class incharge
- `staffdeptreport.php`: Staff department report
- `staffreport.php`: General staff report
- `StaffExpList.php`: Staff experience list
- `StaffExpList2.php`: Staff experience list 2
- `staffwiseleavereport.php`: Staff leave report

### Attendance
- `attendance.php`: Attendance management
- `attendancereport.php`: Attendance report
- `attendancesave.php`: Save attendance
- `ClassAttendance.php`: Class attendance
- `classattendancereport.php`: Class attendance report
- `ClassAttendanceSave.php`: Save class attendance
- `studattendance.php`: Student attendance
- `studattendancedate.php`: Student attendance by date
- `ClassAdjustment.php`: Class adjustment
- `classAdjustmentsid.php`: Class adjustment by SID

### Assignments
- `addassignment.php`: Add assignment
- `assiment.php`: Assignment management
- `assimentSave.php`: Save assignment
- `viewassignment.php`: View assignments
- `submitassignment.php`: Submit assignment
- `assignmentreport.php`: Assignment report
- `overalassignment.php`: Overall assignment
- `sassignmentmark.php`: Assignment marks

### Notes
- `addnotes.php`: Add notes
- `notesave.php`: Save notes
- `notesreport.php`: Notes report

### Subjects
- `addsubject.php`: Add subject
- `AddSubjectSave.php`: Save subject
- `finalizedsubject.php`: Finalize subject
- `finalizedsubjectsave.php`: Save finalized subject
- `sixthhoursubject.php`: Sixth hour subject
- `sixthhoursubjectsave.php`: Save sixth hour subject
- `finalizesixthhour.php`: Finalize sixth hour
- `finalizesixthhoursave.php`: Save finalize sixth hour

### Timetables
- `timetable.php`: General timetable
- `studtimetable.php`: Student timetable
- `selecttimetable.php`: Select timetable
- `CycleTest1TimeTable.php`: Cycle test 1 timetable
- `CycleTest1TimeTableSave.php`: Save cycle test 1
- `CycleTest2TimeTable.php`: Cycle test 2 timetable
- `CycleTest2TimeTableSave.php`: Save cycle test 2
- `modeltimetable.php`: Model exam timetable
- `ModelExamTimeTableSave.php`: Save model exam
- `semtimetable.php`: Semester timetable
- `SemExamTimeTableSave.php`: Save semester exam

### Marks and Assessments
- `InternalMark.php`: Internal marks
- `internalmarktable.php`: Internal marks table
- `coeinternalmark.php`: COE internal marks
- `studinternalmark.php`: Student internal marks
- `mark.php`: Marks management
- `markSave.php`: Save marks
- `smsmark.php`: SMS marks
- `consolidated.php`: Consolidated marks

### Complaints
- `complaint.php`: Submit complaint
- `complaintsave.php`: Save complaint
- `viewcomplaint.php`: View complaints
- `complaintresolved.php`: Resolve complaint
- `complaintresolvedsave.php`: Save resolved complaint

### Events and Activities
- `ProgrammeDetail.php`: Programme details
- `ProgrammeSave.php`: Save programme
- `association.php`: Association management
- `associationactivities.php`: Association activities
- `associationdetail.php`: Association details
- `associationmember.php`: Association members
- `associationsave.php`: Save association
- `amembersave.php`: Save association members

### Labs
- `lab.php`: Lab management
- `labsave.php`: Save lab

### Publications and Achievements
- `publicationreport.php`: Publication report
- `achievements.php`: Achievements
- `achievsave.php`: Save achievements
- `achiveadd.php`: Add achievements
- `Studachivementreport.php`: Student achievement report
- `Stfachivementreport.php`: Staff achievement report
- `sidstaffachivementreport.php`: SID staff achievement report
- `savestfahivement.php`: Save staff achievement
- `SaveStudAchivement.php`: Save student achievement
- `studahivement.php`: Student achievements
- `stfahivement.php`: Staff achievements
- `studachivdisplay.php`: Student achievement display

### Work Diary
- `workdiary.php`: Work diary
- `Saveworkdiary.php`: Save work diary
- `Reportworkdiary.php`: Work diary report
- `ReportwdSID.php`: Work diary by SID
- `Rwdclass.php`: Work diary class
- `wdrpdf.php`: Work diary PDF

### Reports
- `typesofreports.php`: Types of reports
- `toolsusage.php`: Tools usage
- `otherdept.php`: Other department
- `otherdeptsave.php`: Save other department
- `XLstaffpp.php`: Excel staff PP
- `xlstaffpub.php`: Excel staff publication
- `XLstaffresult.php`: Excel staff result
- `XLstaffworkshop.php`: Excel staff workshop
- `XLstudConference.php`: Excel student conference
- `XLstudicm.php`: Excel student ICM
- `XLstudworkshop.php`: Excel student workshop
- `xlconsolidated.php`: Excel consolidated
- `XLabcd.php`: Excel ABCD
- `XLworkdiary.php`: Excel work diary

### Syllabus
- `syllabus.php`: Syllabus management
- `syllabussave.php`: Save syllabus
- `studentsyllabus.php`: Student syllabus
- `viewsyllabus.php`: View syllabus
- `rsyllabus.php`: R syllabus
- `rsyllabussave.php`: Save R syllabus

### PDF Generation
- `pdf.php`: General PDF
- `pdfinternal.php`: Internal PDF
- `pdfinternalmark.php`: Internal marks PDF
- `testpdf.php`: Test PDF

### Miscellaneous
- `aadhaar.php`: Aadhaar related
- `abcdanalysis.php`: ABCD analysis
- `achievementreport.php`: Achievement report
- `at.php`: AT
- `att1.php`: Attendance 1
- `banner.php`: Banner
- `butt.php`: Button
- `Check.php`: Check
- `demo.php`: Demo
- `my.php`: My
- `name.php`: Name
- `Testln.php`: Test line
- `testt.php`: Test
- `Update.php`: Update

### Folders
- `activities/`: Activity related files
- `assignment/`: Assignment uploads
- `css/`: Stylesheets
- `database/`: Database files or backups
- `documentation/`: Documentation files
- `dompdf/`: DOMPDF library for PDF generation
- `font/`: Font files for FPDF
- `images/`: Image assets
- `JS/`: JavaScript files
- `rsyllabus/`: R syllabus files
- `syllabus/`: Syllabus files
- `upload/`: Upload directory

## Database Schema
The system uses a MySQL database named `collegedetails`. Key tables include:
- admin: Admin users
- student: Student details
- staff: Staff details
- attendance: Attendance records
- assignments: Assignment details
- subjects: Subject information
- marks: Marks and grades
- events: College events
- complaints: Complaint records
- And many more as per the functionalities

## Technologies Used
- PHP
- MySQL
- HTML/CSS/JavaScript
- FPDF for PDF generation
- jQuery

## License
This project is licensed under the terms specified in `license.txt`.

## Contributing
Please refer to the college's IT department for contributions.

## Support
For support, contact the UG Information Technology department.</content>
<parameter name="filePath">e:\College\README.md