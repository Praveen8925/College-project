<?php
    	 
include_once 'database.php';
    include_once 'Check.php';
    $ut=$_SESSION['usertype'];

?>
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/Web.css">
   <script src="JS/jquery-1.11.3.min.js"></script>
   <script src="JS/script.js"></script>
   <title>SREE SARASWATHI THYAGARAJA COLLEGE</title>
</head>
<body>
<table width="1024">
<tr>
<td rowspan="2"><img src="images/LOGO3.png">
</td>
<td class="heading">SREE SARASWATHI THYAGARAJA COLLEGE</td>
</tr>
<tr>
<td class="address">
An Autonomous, NAAC Re-Accredited with 'A' Grade, ISO 9001:2008 Certified Institution,<br>
Affiliated to Bharathiar University, Coimbatore
</td>
<td><input type="button" value="Logout" class="btn" onClick="location.href='Logout.php'">
</td>
</tr>
<tr class="font-stylec">
<td colspan="2">
</td>
<td align="center">
<?php
 if(strcasecmp($ut,"Student")==0 or strcasecmp($ut,"Alumni")==0)
  {
   $uid=$_SESSION['AU'];   
      $SQL = "SELECT * FROM student where RegNo ='$uid'";
      $result1 = mysql_query($SQL);
      while($row=mysql_fetch_assoc($result1))
          {      
                     $name=$row['Name'];
                       
          }
 print 'Welcome'.'<br>'.$name.'<br>'.$uid;
  }
  else if(strcasecmp($ut,"hod")==0)
   {
    $uid=$_SESSION['AU'];   
      $SQL = "SELECT * FROM  addstaff where SID ='$uid'and Designation='HOD'";
      $result1 = mysql_query($SQL);
      while($row=mysql_fetch_assoc($result1))
          {      
                     $name=$row['Name'];
                       
          }
 print 'Welcome'.'<br>'.$name.'<br>'.$uid.'<br>HOD';
   }
   
   else if(strcasecmp($ut,"Staff")==0)
   {
    $uid=$_SESSION['AU'];   
      $SQL = "SELECT * FROM  addstaff where SID ='$uid'";
      $result1 = mysql_query($SQL);
      while($row=mysql_fetch_assoc($result1))
          {      
                     $name=$row['Name'];
                       
          }
 print 'Welcome'.'<br>'.$name.'<br>'.$uid;
   }
   
  else if(strcasecmp($ut,"director")==0)
   {
    $uid=$_SESSION['AU'];   
      $SQL = "SELECT * FROM  addstaff where SID ='$uid'and Designation='director'";
      $result1 = mysql_query($SQL);
      while($row=mysql_fetch_assoc($result1))
          {      
                     $name=$row['Name'];
                       
          }
 print 'Welcome'.'<br>'.$name.'<br>'.$uid.'<br>Director';
   }
   
   else if(strcasecmp($ut,"assistantStaff")==0)
   {
    $uid=$_SESSION['AU'];   
      $SQL = "SELECT * FROM  addstaff where SID ='$uid'";
      $result1 = mysql_query($SQL);
      while($row=mysql_fetch_assoc($result1))
          {      
                     $name=$row['Name'];
                       
          }
 print 'Welcome'.'<br>'.$name.'<br>'.$uid;
   } 
   
   else if(strcasecmp($ut,"coe")==0)
   {
    $uid=$_SESSION['AU'];   
      $SQL = "SELECT * FROM  coe where id ='$uid'";
      $result1 = mysql_query($SQL);
      
 print 'Welcome'.'<br>'.$uid;
   }
?>
</td>
</tr>
<?PHP
   if(strcasecmp($ut,"admin")==0)
   {
?>
<tr>
<td colspan="3">
<div id='cssmenu'>
<ul>
   <li class='active'>
   <li><a href='#'>Events</a>
      <ul>
          <li><a href='EventsAdd.php' target='inlineframe'>Add</a>
          
          <li><a href='EventList.php'  target='inlineframe'>List</a>
         </li>

      </ul>
    <li>
   </li>
   <li><a href='#'>Add</a>
    <ul>
         <li><a href='ProgrammeDetail.php' target='inlineframe'>Programme</a>
         <li><a href='otherdept.php' target='inlineframe'>Other Department</a>
         <li><a href='achiveadd.php' target='inlineframe'>Achievement Name</a>
          
           
         </li>
      </ul>
    </li>
  <li ><a href='#'>Staff</a>
      <ul>
         <li><a href='AddstaffDetail.php' target='inlineframe'>Add</a>
         <li><a href='stafftransfer.php' target='inlineframe'>Staff Transfer</a>
               
         </li>
      </ul>
   </li>
<li ><a href='#'>Student</a>
      <ul>
         <li><a href='addstudent.php' target='inlineframe'>Add</a>
         
         </li>
      </ul>
   </li>
  <li ><a href='#'>Account </a>
      <ul>
         <li><a href='Change.php' target='inlineframe'>Change Password</a>
          </li>
     </ul>
	 
	 
	 
	 
      <li ><a href='#'>Report</a>
        <ul>
            <li><a href='ReportwdSID.php' target='inlineframe'>Staff Report</a>
                <li><a href='Rwdclass.php' target='inlineframe'>Class wise Report</a>
                <li><a href='classAdjustmentsid.php' target='inlineframe'>Class Adjustment Report</a>
                <li><a href='Stfachivementreport.php' target='inlineframe'>Staff Achievement</a>
                <li><a href='StaffExpList2.php' target='inlineframe'>Exp List</a>
     </ul>
      <li ><a href='#'>Class Incharge</a>
        <ul>
            <li><a href='classincharge.php' target='inlineframe'>Enter</a>
   </li>

</ul>

<li ><a href='#'>Academic</a>
      <ul>
         <li><a href='addsubject.php' target='inlineframe'>Add Subject</a>
		<!-- <li><a href='sixthhoursubject.php' target='inlineframe'>Add 6th hour subject</a>-->
          <li><a href='finalizedsubject.php' target='inlineframe'>Finalize Subject</a> 
          
			<!--<li><a href='finalizesixthhour.php' target='inlineframe'>Finalize 6th hour Subject</a>    -->
          <li><a href='#' >Time Table</a>
                 <ul>
                     <li><a href='cycletest1timetable.php' target='inlineframe'>Cycle Test I</a> 
                     <li><a href='cycletest2timetable.php' target='inlineframe'>Cycle Test II</a>
                     <li><a href='modeltimetable.php' target='inlineframe'>Model Exam</a>
					 <li><a href='semtimetable.php' target='inlineframe'>Sem</a>
                   </ul>

</div>
</td>
</tr>
<?PHP
}
else if(strcasecmp($ut,"staff")==0)
    {
 ?>
<tr>
<td colspan="3">
<div id='cssmenu'>
<ul>
      <li><a href='#'>Events</a>
      <ul>
          <li><a href='EventsAdd.php' target='inlineframe'>Request</a>
          <li><a href='EventList.php'  target='inlineframe'>List</a>
         </li>

      </ul>

    <li>
   </li>
   
  <li ><a href='#'>Staff </a>
      <ul>
         <li><a href='StaffDetail.php' target='inlineframe'>Edit</a>
 <li><a href='stfahivement.php' target='inlineframe'>Achievements</a>
 
         </li>
      </ul>
   </li>
<li ><a href='#'>Student </a>
      <ul>
	  
	     <li><a href='StudentList.php' target='inlineframe'>Edit</a>
         <li><a href='studahivement.php' target='inlineframe'>Achievements</a>
         <li><a href='ClassAttendance.php' target='inlineframe'>Attendance</a>
         </li>
      </ul>
   </li>
<li ><a href='#'>Account </a>
      <ul>
         <li><a href='Change.php' target='inlineframe'>Change Password</a>
          </li>
      </ul>
   </li>
<li ><a href='#'>Staff List </a>
      <ul>
         <li><a href='stafflist.php' target='inlineframe'>EXP Details</a>
                        
         </li>
      </ul>
   </li>
<li ><a href='#'>Report</a>
      <ul>
         
                  
                  <li><a href='sidstaffachivementreport.php' target='inlineframe'>Staff Achievement</a> 
                   <li><a href='achievementreport.php' target='inlineframe'>Student Achievement</a>
                    <li><a href='viewcomplaint.php' target='inlineframe'>Complaints</a>
                   <!--<li><a href='attendancereport.php' target='inlineframe'>Attendance Report</a>-->
				   <li><a href='classattendancereport.php' target='inlineframe'>ClassAttendance Report</a>
                   <li><a href='staffdeptreport.php' target='inlineframe'>Department Report</a>
		   <li><a href='abcdanalysis.php' target='inlineframe'>ABCD Analysis</a>
		   <li><a href='consolidated.php' target='inlineframe'>Consolidate</a>
		   <li><a href='toolsusage.php' target='inlineframe'>Tools usage</a>
		   <li><a href='overalassignment.php' target='inlineframe'>Assignment Report</a>
		   
		   
</li>
      </ul>
<li ><a href='#'>Academic</a>
      <ul>
				 <li ><a href='#'>Association</a>
				<ul>
				    <li><a href='association.php' target='inlineframe'>Add Association</a>
				    <li><a href='associationmember.php' target='inlineframe'>Add Member</a>
				    <li><a href='associationdetail.php' target='inlineframe'>Association Details</a>
				    <li><a href='associationactivities.php' target='inlineframe'>Association Activities</a>
					
				</ul>	
				<li><a href='viewsyllabus.php' target='inlineframe'>Syllabus</a>
               <li><a href='mark.php' target='inlineframe'>Add Mark</a>
			   <li><a href='addnotes.php' target='inlineframe'>Add Notes</a>
			   <li ><a href='#'>Assignment</a>
				<ul>
			   <li><a href='addassignment.php' target='inlineframe'>Create Assignment</a>
			   <li><a href='assignmentreport.php' target='inlineframe'>Review</a>
			   
			   </ul>
                <li><a href='InternalMark.php' target='inlineframe'>Internal Mark</a>
                <li><a href='assiment.php' target='inlineframe'>Assignment Mark</a>
            <!--<li><a href='attendance.php' target='inlineframe'>Attendance Mark</a>
               <li><a href='lab.php' target='inlineframe'>Record And Lab  Performance</a>-->
				<li><a href='register.php' target='inlineframe'>Register</a>
</li>
      </ul>
<li ><a href='#'>Work Diary</a>
        <ul>
            <li><a href='workdiary.php' target='inlineframe'>Enter</a>
                <li><a href='Reportworkdiary.php' target='inlineframe'>Report</a>
                <li><a href='ClassAdjustment.php' target='inlineframe'>Class Adjustment</a>
                <li><a href='staffwiseleavereport.php' target='inlineframe'>Staffwise Leave</a>
   </li>
</ul>
</div>
</td>
</tr>


<?PHP
}

else if(strcasecmp($ut,"coe")==0)
    {
 ?>
<tr>
<td colspan="3">
<div id='cssmenu'>
<ul>
    <li><a href='coeinternalmark.php' target='inlineframe'>Internal Mark</a>
</ul>
</div>
</td>
</tr>


<?PHP
}

else if(strcasecmp($ut,"hod")==0)
    {
 ?>
<tr>
<td colspan="3">
<div id='cssmenu'>
<ul>
      <li><a href='#'>Events</a>
      <ul>
          <li><a href='EventsAdd.php' target='inlineframe'>Request</a>
          <li><a href='EventList.php'  target='inlineframe'>List</a>
         </li>

      </ul>

    <li>
   </li>
   
  <li ><a href='#'>Staff </a>
      <ul>
         <li><a href='StaffDetail.php' target='inlineframe'>Edit</a>
 <li><a href='stfahivement.php' target='inlineframe'>Achievements</a>
 
         </li>
      </ul>
   </li>
<li ><a href='#'>Student </a>
      <ul>
	  
	     <li><a href='StudentList.php' target='inlineframe'>Edit</a>
         <li><a href='studahivement.php' target='inlineframe'>Achievements</a>
         <li><a href='ClassAttendance.php' target='inlineframe'>Attendance</a>
         </li>
      </ul>
   </li>
<li ><a href='#'>Account </a>
      <ul>
         <li><a href='Change.php' target='inlineframe'>Change Password</a>
          </li>
      </ul>
   </li>
<li ><a href='#'>Staff List </a>
      <ul>
         <li><a href='stafflist.php' target='inlineframe'>EXP Details</a>
                        
         </li>
      </ul>
   </li>
<li ><a href='#'>Report</a>
      <ul>
         
                  
                  <li><a href='sidstaffachivementreport.php' target='inlineframe'>Staff Achievement</a> 
                   <li><a href='Studachivementreport.php' target='inlineframe'>Student Achievement</a>
                   <li><a href='association.php' target='inlineframe'>Association</a>
                   <li><a href='viewcomplaint.php' target='inlineframe'>Complaints</a>
                   
                   <!--<li><a href='attendancereport.php' target='inlineframe'>Attendance Report</a>-->
				   <li><a href='classattendancereport.php' target='inlineframe'>ClassAttendance Report</a>
                   <li><a href='staffdeptreport.php' target='inlineframe'>Department Report</a>
		   <li><a href='abcdanalysis.php' target='inlineframe'>ABCD Analysis</a>
		   <li><a href='consolidated.php' target='inlineframe'>Consolidate</a>
		   <li><a href='toolsusage.php' target='inlineframe'>Tools usage</a>
		   <li><a href='overalassignment.php' target='inlineframe'>Assignment Report</a>
		   
</li>
      </ul>
<li ><a href='#'>Academic</a>

      <ul>
        <li ><a href='#'>subjects</a>
      <ul>
         <li><a href='addsubject.php' target='inlineframe'>Add Subject</a>
		<!-- <li><a href='sixthhoursubject.php' target='inlineframe'>Add 6th hour subject</a>-->
          <li><a href='finalizedsubject.php' target='inlineframe'>Finalize Subject</a> 
		  <li><a href='allocatestaff.php' target='inlineframe'>Allocate Staff</a> 
		  <li><a href='staffallocationdetail.php' target='inlineframe'>Staff Allocation Detail</a> 
		<!--	<li><a href='finalizesixthhour.php' target='inlineframe'>Finalize 6th hour Subject</a>   --> 
               </ul>
			   <li ><a href='#'>subjects</a>
      <ul>
			   <li><a href='syllabus.php' target='inlineframe'>Upload</a>
			   <li><a href='rsyllabus.php' target='inlineframe'>Retified Syllabus</a>
			   <li><a href='viewsyllabus.php' target='inlineframe'>View</a>
			   
			   </ul>
			   <li><a href='selecttimetable.php' target='inlineframe'>Add TimeTable</a>
			   <li><a href='mark.php' target='inlineframe'>Add Mark</a>
			   <li><a href='addnotes.php' target='inlineframe'>Add Notes</a>
			   <li ><a href='#'>Assignment</a>
				<ul>
			   <li><a href='addassignment.php' target='inlineframe'>Create Assignment</a>
			   <li><a href='assignmentreport.php' target='inlineframe'>Review</a>
			   
			   </ul>
                <li><a href='InternalMark.php' target='inlineframe'>Internal Mark</a>
                <li><a href='assiment.php' target='inlineframe'>Assignment Mark</a>
              <!--  <li><a href='attendance.php' target='inlineframe'>Attendance Mark</a>-->
                <li><a href='lab.php' target='inlineframe'>Record And Lab  Performance</a>
				<li><a href='register.php' target='inlineframe'>Register</a>
</li>
      </ul>
<li ><a href='#'>Work Diary</a>
        <ul>
            <li><a href='workdiary.php' target='inlineframe'>Enter</a>
                <li><a href='Reportworkdiary.php' target='inlineframe'>Report</a>
                <li><a href='ClassAdjustment.php' target='inlineframe'>Class Adjustment</a>
                <li><a href='staffwiseleavereport.php' target='inlineframe'>Staffwise Leave</a>
   </li>
</ul>

</div>
</td>
</tr>
<?PHP
}
else if(strcasecmp($ut,"Student")==0)
    {
 ?>
<tr>
<td colspan="3">
<div id='cssmenu'>

<ul>
<li ><a href='#'>Academic</a>
        <ul>
      <li><a href='studinternalmark.php' target='inlineframe' >Internal Mark</a>
      <li><a href='studtimetable.php' target='inlineframe' >Time Table</a>    
	  
	  <li><a href='studentsyllabus.php' target='inlineframe'>Syllabus</a>
	  
</ul>	  
<li ><a href='#'>Report</a>
        <ul>
		<li><a href='studattendance.php' target='inlineframe'>Attendance</a>
		<li><a href='studattendancedate.php' target='inlineframe'> date Attendance</a>
		<li><a href='studachivdisplay.php' target='inlineframe'>Achievements</a>
		 <li><a href='notesreport.php' target='inlineframe'>Notes</a>
		</ul>
	  
      <li><a href='profile.php' target='inlineframe'>Profile</a>
	 <!--
	  <li ><a href='#'>Assignment</a>
	  <ul>
	  <li><a href='viewassignment.php' target='inlineframe'>view Assignment</a>
	  <li><a href='submitassignment.php' target='inlineframe'>Submit Assignment</a>
	  </ul>-->
	  
	  <li><a href='complaint.php' target='inlineframe'>Complaint</a>
	  <li><a href='studentcompany.php' target='inlineframe'>companies</a>
	  
	  </ul>
    
   </li>
   
  </ul>
</div>
</td>
</tr>
<?PHP
}
else if(strcasecmp($ut,"Alumni")==0)
    {
?>

<tr>
<td colspan="3"><img src="images/underconstruction.jpg" width="1000" height="600">
</td>
</tr>

<?php
}
else if(strcasecmp($ut,"director")==0)
    {
?>
<tr>
<td colspan="3">
<div id='cssmenu'>

<ul>
<li ><a href='#'>Companies</a>
      <ul>
      <li><a href='ucompanies.php' target='inlineframe' >Upcoming</a>
	  <li><a href='ucompaniesdetails.php' target='inlineframe' >Upcoming Details</a>
	  <li><a href='compestudents.php' target='inlineframe' >Elegibility students</a>
		</ul>
   
  </ul>
</div>
</td>
</tr>
<?php
}
else if(strcasecmp($ut,"placementstaff")==0)
    {
?>
<tr>
<td colspan="3"><img src="images/underconstruction.jpg" width="1000" height="600">
</td>
</tr>

<?php
}

?>
</table>

</body>
<html>
