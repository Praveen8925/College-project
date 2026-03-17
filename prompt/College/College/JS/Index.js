function openWin()
 {
   window.open("forgotpassword.php","Forget Password","width=450","height=60");
 }
function resizeWin()
 {
   
myWindow.resizeTo(250,250);
myWindow.focus();
 }
 function isNumberKey(evt)
 {
		 var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 }
 function validateForm()
 {
   if (document.getElementById("loginid").value=="")
   {
  	alert("Enter the User Name");
	document.getElementById("loginid").focus();
	return false;
   }
   else if (document.getElementById("pass").value=="")
   {
	alert("Enter the Password");
	document.getElementById("pass").focus();
	return false;
   }		
}
function eventForm()
 {
   if (document.getElementById("eve").value=="")
   {
  	alert("Enter the Events");
	document.getElementById("eve").focus();
	return false;
   }
 }

function AddStfForm()
{   
if (document.getElementById("sid").value=="")
   {
  	alert("Enter the Staff ID");
	document.getElementById("sid").focus();
	return false;
   }
   else if (document.getElementById("name").value=="")
   {
  	alert("Enter the name");
	document.getElementById("name").focus();
	return false;
   }
 else if (document.getElementById("Dept").value=="Select")
   {
	alert("Enter the Department Name");
	document.getElementById("Dept").focus();
	return false;
   }		
 else if (document.getElementById("desigtn").value=="")
   {
	alert("Enter the designation");
	document.getElementById("desigtn").focus();
	return false;
   }		
 else if (document.getElementById("email").value=="")
   {
	alert("Enter the mail id");
	document.getElementById("email").focus();
	return false;
   }		
 }

function AddStuForm()
{   
    if (document.getElementById("studid").value=="")
   {
  	alert("Enter the Student Register Number");
	document.getElementById("studid").focus();
	return false;
   }
   else if (document.getElementById("studbat").value=="")
   {
  	alert("Enter the Student Batch of Admission");
	document.getElementById("studbat").focus();
	return false;
   }
   else if (document.getElementById("stname").value=="")
   {
  	alert("Enter the name");
	document.getElementById("stname").focus();
	return false;
   }
 else if (document.getElementById("stDept").value=="Select")
   {
	alert("Enter the Department Name");
	document.getElementById("stDept").focus();
	return false;
   }		
   else if(document.getElementById("email").value!="")
   {
       var x=document.getElementById("email").value;
        alert(x);
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
            alert("Not a valid E-mail Address");
            document.getElementById("email").focus();
            return false;
        }
   }		
 }

function courseForm()
 {
   if (document.getElementById("cname").value=="")
   {
  	alert("Enter the course name");
	document.getElementById("cname").focus();
	return false;
   }
 else if (document.getElementById("bname").value=="")
   {
	alert("Enter the branch name");
	document.getElementById("bname").focus();
	return false;
   }		
 else if (document.getElementById("sform").value=="")
   {
	alert("Enter the short form");
	document.getElementById("sform").focus();
	return false;
   }		
 else if (document.getElementById("btype").value=="")
   {
	alert("Enter the branch type");
	document.getElementById("btype").focus();
	return false;
   }		
 }


function staffForm()
 {
    if (document.getElementById("qual").value=="")
   {
	alert("Enter the Qualification");
	document.getElementById("qual").focus();
	return false;
   }		
 else if (document.getElementById("address").value=="")
   {
	alert("Enter the Address");
	document.getElementById("address").focus();
	return false;
   }
 else if (document.getElementById("dob").value=="")
   {
	alert("Enter the Date of Birth");
	document.getElementById("dob").focus();
	return false;
   }

 else if (document.getElementById("mno").value=="")
   {
	alert("Enter the Mobile no");
	document.getElementById("mno").focus();
	return false;
   }		

 else if (document.getElementById("email").value=="")
   {
	alert("Enter the E-mail id");
	document.getElementById("email").focus();
	return false;
   }
 else if (document.getElementById("date").value=="")
   {
	alert("Enter the Joining Date");
	document.getElementById("date").focus();
	return false;
   }		
  else if (document.getElementById("domain").value=="")
   {
	alert("Enter the Domain");
	document.getElementById("domain").focus();
	return false;
   }
   else if(document.getElementById("email").value!="")
   {
       var x=document.getElementById("email").value;
        alert(x);
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
            alert("Not a valid E-mail Address");
            document.getElementById("email").focus();
            return false;
        }
   }
 }

function studForm()
 {
   if (document.getElementById("name").value=="")
   {
  	alert("Enter the name");
	document.getElementById("name").focus();
	return false;
   }
 else if (document.getElementById("course").value=="")
   {
	alert("Enter the course");
	document.getElementById("course").focus();
	return false;
   }
  else if (document.getElementById("email").value=="")
   {
	alert("Enter the mail id");
	document.getElementById("email").focus();
	return false;
   }		
 else if (document.getElementById("dob").value=="")
   {
	alert("Enter the date of birth");
	document.getElementById("dob").focus();
	return false;
   }		
 else if (document.getElementById("bg").value=="")
   {
	alert("Enter the blood");
	document.getElementById("bg").focus();
	return false;
   }
 else if (document.getElementById("pname").value=="")
   {
	alert("Enter the parent name");
	document.getElementById("pname").focus();
	return false;
   }			

 else if (document.getElementById("address").value=="")
   {
	alert("Enter the address");
	document.getElementById("address").focus();
	return false;
   }		

 else if (document.getElementById("pcode").value=="")
   {
	alert("Enter the pincode");
	document.getElementById("pcode").focus();
	return false;
   }		

 else if (document.getElementById("pmno").value=="")
   {
	alert("Enter Father/Mother mobile Number");
	document.getElementById("pmno").focus();
	return false;
   }		

else if (document.getElementById("nation").value=="")
   {
	alert("Enter the nationality");
	document.getElementById("nation").focus();
	return false;
   }
else if (document.getElementById("community").value=="")
   {
	alert("Enter the community");
	document.getElementById("community").focus();
	return false;
   }		
else if (document.getElementById("caste").value=="")
   {
	alert("Enter the caste");
	document.getElementById("caste").focus();
	return false;
   }		
else if (document.getElementById("gen").value=="")
   {
	alert("Enter the gender");
	document.getElementById("gen").focus();
	return false;
   }
else if (document.getElementById("tenmark").value=="")
   {
	alert("Enter the 10th Mark");
	document.getElementById("tenmark").focus();
	return false;
   }
else if (document.getElementById("tmark").value=="")
   {
	alert("Enter the 12th Mark");
	document.getElementById("tmark").focus();
	return false;
   }


 }
function pass()
{
	if(document.getElementById("oldpwd").value=="")
  	{
		alert("Enter the Old Password");
		document.getElementById("oldpwd").focus();
		return false
	}
	//alert("Enter the Member Designation"+document.getElementById("assmd").value);
	if (document.getElementById("newpwd").value=="")
  	{
  			alert("Enter the New Password");
			document.getElementById("newpwd").focus();
  			return false;
  	}
	if (document.getElementById("newrpwd").value=="")
  	{
  			alert("Enter Retype Password");
			document.getElementById("newrpwd").focus();
  			return false;
  	}
	var x=document.getElementById("newpwd").value;
	var y=document.getElementById("newrpwd").value;
	//alert(x == y);
	if(!(x == y))
	{
	   alert("Password Mismatch");
	   document.getElementById("newpwd").value="";
	   document.getElementById("newrpwd").value="";
	   document.getElementById("newpwd").focus();
	   return false;
	}
}

function astfpub()
{
if (document.getElementById("pubt").value=="")
   {
  	alert("Enter the Title");
	document.getElementById("pubt").focus();
	return false;
   }
else if (document.getElementById("jpname").value=="")
   {
  	alert("Enter the Journal/Proceeding Name");
	document.getElementById("jpname").focus();
	return false;
   }
 else if (document.getElementById("isno").value=="")
   {
	alert("Enter the ISBN/ISSN No");
	document.getElementById("isno").focus();
	return false;
   }		
 else if (document.getElementById("vol").value=="")
   {
	alert("Enter the Volume");
	document.getElementById("vol").focus();
	return false;
   }		
else if (document.getElementById("issuem").value=="")
   {
	alert("Enter the Issue Month");
	document.getElementById("issuem").focus();
	return false;
   }		
else if (document.getElementById("issuey").value=="")
   {
	alert("Enter the Issue Year");
	document.getElementById("issuey").focus();
	return false;
   } 
else if (document.getElementById("pag").value=="")
   {
	alert("Enter the Page No");
	document.getElementById("pag").focus();
	return false;
   }
 else if (document.getElementById("pcer").value=="")
   {
	alert("Attach the Certificate");
	document.getElementById("pcer").focus();
	return false;
   }		
else if (document.getElementById("ppaper").value=="")
   {
	alert("Attach the Paper");
	document.getElementById("ppaper").focus();
	return false;
   }	

}
function astfpp()
{
if (document.getElementById("ppprg").value=="")
   {
  	alert("Enter the Program Name");
	document.getElementById("ppprg").focus();
	return false;
   }
else if (document.getElementById("insname").value=="")
   {
  	alert("Enter the Institution Name");
	document.getElementById("insname").focus();
	return false;
   }
 else if (document.getElementById("ppcer").value=="")
   {
	alert("Attach the Certificate");
	document.getElementById("ppcer").focus();
	return false;
   }		
 

}
function astfworkshop()
{
if (document.getElementById("wname").value=="")
   {
  	alert("Enter the Program Name");
	document.getElementById("wname").focus();
	return false;
   }
else if (document.getElementById("wsins").value=="")
   {
  	alert("Enter the Institution Name");
	document.getElementById("wsins").focus();
	return false;
   }
 else if (document.getElementById("sdate").value=="")
   {
	alert("Enter the Date");
	document.getElementById("sdate").focus();
	return false;
   }		
 else if (document.getElementById("wscer").value=="")
   {
	alert("Attach the Certificate");
	document.getElementById("wscer").focus();
	return false;
   }		

}

function astfresult()
{
if (document.getElementById("ccode").value=="")
   {
  	alert("Enter the Course Code");
	document.getElementById("ccode").focus();
	return false;
   }
else if (document.getElementById("cname").value=="")
   {
  	alert("Enter the Course Name");
	document.getElementById("cname").focus();
	return false;
   }
 else if (document.getElementById("year").value=="")
   {
	alert("Enter the Year");
	document.getElementById("year").focus();
	return false;
   }		
 }


function astfresearch()
{
if (document.getElementById("protitle").value=="")
   {
  	alert("Enter the Project Title");
	document.getElementById("protitle").focus();
	return false;
   }
else if (document.getElementById("agency").value=="")
   {
  	alert("Enter the Agency");
	document.getElementById("agency").focus();
	return false;
   }
 else if (document.getElementById("fund").value=="")
   {
	alert("Enter the Fund");
	document.getElementById("fund").focus();
	return false;
   }		
 }

function addsubject()
{

if (document.getElementById("courseid").value=="")
   {
  	alert("Enter the Course ID");
	document.getElementById("courseid").focus();
	return false;
   }
else if (document.getElementById("coursename").value=="")
   {
  	alert("Enter the Course Name");
	document.getElementById("coursename").focus();
	return false;
   }
}
function astudicm()
{
if (document.getElementById("regno").value=="")
   {
  	alert("Enter the Reg No");
	document.getElementById("regno").focus();
	return false;
   }
else if (document.getElementById("event").value=="")
   {
  	alert("Enter the Event");
	document.getElementById("event").focus();
	return false;
   }
else if (document.getElementById("cname").value=="")
   {
  	alert("Enter the College Name");
	document.getElementById("cname").focus();
	return false;
   }
else if (document.getElementById("icmdate").value=="")
   {
  	alert("Enter the Date");
	document.getElementById("icmdate").focus();
	return false;
   }
 else if (document.getElementById("icmcer").value=="")
   {
	alert("Attach the Certificate");
	document.getElementById("icmcer").focus();
	return false;
   }		
 }

function astudworkshop()
{
if (document.getElementById("wsname").value=="")
   {
  	alert("Enter the Program Name");
	document.getElementById("wsname").focus();
	return false;
   }
else if (document.getElementById("wsins").value=="")
   {
  	alert("Enter the Institution Name");
	document.getElementById("wsins").focus();
	return false;
   }
 else if (document.getElementById("sdate").value=="")
   {
	alert("Enter the Date");
	document.getElementById("sdate").focus();
	return false;
   }		
 else if (document.getElementById("wscer").value=="")
   {
	alert("Attach the Certificate");
	document.getElementById("wscer").focus();
	return false;
   }		
}
function astudConference()
{
if (document.getElementById("insname").value=="")
   {
  	alert("Enter the Institution Name");
	document.getElementById("insname").focus();
	return false;
   }
else if (document.getElementById("date").value=="")
   {
  	alert("Enter the Date");
	document.getElementById("date").focus();
	return false;
   }
  else if (document.getElementById("ccer").value=="")
   {
	alert("Attach the Certificate");
	document.getElementById("ccer").focus();
	return false;
   }		
}
function workdairy()
{      
       var remarks=document.getElementById("remark1");
        var remarkss=document.getElementById("remark2");
        if(remarks.checked==true)
           { 
          if (document.getElementById("reason").value=="")
            {
  	alert("Enter the Reason");
	document.getElementById("reason").focus();
	return false;
         }
            
            }
        else if(remarkss.checked==true)
           { 
          if (document.getElementById("reason").value=="")
            {
  	alert("Enter the Reason");
	document.getElementById("reason").focus();
	return false;
         }
            
            }
         else
           {
          if (document.getElementById("topic").value=="")
            {
  	alert("Enter the Topic");
	document.getElementById("topic").focus();
	return false;
         }
          }
      
}

function hide() 
{
document.getElementById("label").style.visibility = "hidden";
document.getElementById("textbox").style.visibility = "hidden";
}

function show()
 {
document.getElementById("label").style.visibility = "visible";
document.getElementById("textbox").style.visibility = "visible";
}


function a()
{
alert(document.getElementById("subcnt").value);
 var subcnt=document.getElementById("subcnt").value;
var d=document.getElementById("mmark").value;
alert(d);
for(i=0;i<subcnt;i++)
{

}
return false;
}