function validateForm_employer_help() {
  var x = document.forms["employerhelp"]["company_email"].value;
  if (x == null || x == "") {
    alert("Email must be filled out");
    return false;
  }
}

function validateForm_employer() {
  var x = document.forms["employer"]["employer_id"].value;
  if (x == null || x == "") {
    alert("Employer ID must be filled out");
    return false;
  }

  var y = document.forms["employer"]["employer_password"].value;
  if (y == null || y == "") {
    alert("Password must be filled out");
    return false;
  }
}

function validateForm_seaman() {
  var x = document.forms["seaman"]["job_seeker_id"].value;
  if (x == null || x == "") {
    alert("Email must be filled out");
    return false;
  }

  var y = document.forms["seaman"]["job_seeker_password"].value;
  if (y == null || y == "") {
    alert("Password must be filled out");
    return false;
  }
}


function validateForm_seaman_login() {
  var x = document.forms["seaman1"]["job_seeker_id"].value;
  if (x == null || x == "") {
    alert("Email must be filled out");
    return false;
  }

  var y = document.forms["seaman1"]["job_seeker_password"].value;
  if (y == null || y == "") {
    alert("Password must be filled out");
    return false;
  }
}

function validateForm_apply() {
  var x = document.forms["apply"]["job_seeker_id"].value;
  if (x == null || x == "") {
    alert("Email must be filled out");
    return false;
  }

  var y = document.forms["apply"]["job_seeker_password"].value;
  if (y == null || y == "") {
    alert("Password must be filled out");
    return false;
  }
}



function validateForm_seaman_help() {
  var x = document.forms["seaman_help"]["seeker_email"].value;
  if (x == null || x == "") {
    alert("Email must be filled out");
    return false;
  }

  var y = document.forms["seaman_help"]["month"].value;
  if (y == "-") {
    alert("Birthday (month) must be filled out");
    return false;
  }




  var y1 = document.forms["seaman_help"]["day"].value;
  if (y1 == "-") {
    alert("Birthday (day) must be filled out");
    return false;
  }


  var y2 = document.forms["seaman_help"]["year"].value;
  if (y2 == "-") {
    alert("Birthday (year) must be filled out");
    return false;
  }
}




function validateForm_edit_seaman_profile() {
  var x = document.forms["edit_seaman_profile"]["birthday"].value;
  if (x == null || x == "") {
    alert("Email must be filled out");
    return false;
  }

  var x1 = document.forms["edit_seaman_profile"]["status"].value;
  if (x1 == "-") {
    alert("Marital Status must be filled out");
    return false;
  }


  var x2 = document.forms["edit_seaman_profile"]["religion"].value;
  if (x2 == "") {
    alert("Religion must be filled out");
    return false;
  }

  var x3 = document.forms["edit_seaman_profile"]["address"].value;
  if (x3 == "") {
    alert("Home Address must be filled out");
    return false;
  }


  var x4 = document.forms["edit_seaman_profile"]["cellphone"].value;
  if (x4 == "") {
    alert("Cellphone number must be filled out");
    return false;
  }

  var x5 = document.forms["edit_seaman_profile"]["language"].value;
  if (x5 == "") {
    alert("Language and dialects number must be filled out");
    return false;
  }

  var x6 = document.forms["edit_seaman_profile"]["educ_training"].value;
  if (x6 == "") {
    alert("Education and Training must be filled out");
    return false;
  }


  var x7 = document.forms["edit_seaman_profile"]["passwrd"].value;
  if (x7 == "") {
    alert("Password must be filled out");
    return false;
  }

}

function validateForm_date_check()
{
var x=document.forms["date_check"]["date_start"].value;
if (x==null || x=="")
  {
  alert("You need to enter Starting Date (YYYY-MM-DD)");
  return false;
  }
  
  var y=document.forms["date_check"]["date_end"].value;
if (y==null || y=="")
  {
  alert("You need to enter Ending Date (YYYY-MM-DD)");
  return false;
  }
}


function validateForm_job_request_check()
{
var x=document.forms["job_request"]["job_title"].value;
if (x==null || x=="")
  {
  alert("Job Position must be filled out!");
  return false;
  }
  
  var y=document.forms["job_request"]["request_by"].value;
if (y==null || y=="")
  {
  alert("Request by must be filled out!");
  return false;
  }
  
  var y=document.forms["job_request"]["request_by2"].value;
if (y==null || y=="")
  {
  alert("Contact Number must be filled out!");
  return false;
  }
}


function validateForm_register_seaman()
{
var x=document.forms["register_seaman"]["prefer_job"].value;
if (x==null || x=="")
  {
  alert("Select your Prefer Job Position");
  return false;
  }
  
  var x=document.forms["register_seaman"]["prefer_job"].value;
if (x==null || x=="Choose Below")
  {
  alert("Select your Prefer Job Position");
  return false;
  }


var x=document.forms["register_seaman"]["first_name"].value;
if (x==null || x=="")
  {
  alert("First Name is required!");
  return false;
  }


  var x=document.forms["register_seaman"]["middle_name"].value;
if (x==null || x=="")
  {
  alert("Middle Name is required!");
  return false;
  }


  var x=document.forms["register_seaman"]["last_name"].value;
if (x==null || x=="")
  {
  alert("Last Name is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["month"].value;
if (x==null || x=="")
  {
  alert("Date of Birth (Month) is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["day"].value;
if (x==null || x=="")
  {
  alert("Date of Birth (Day) is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["year"].value;
if (x==null || x=="")
  {
  alert("Date of Birth (Year) is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["sex"].value;
if (x==null || x=="")
  {
  alert("Gender is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["nationality"].value;
if (x==null || x=="")
  {
  alert("Nationality is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["status"].value;
if (x==null || x=="")
  {
  alert("Marital Status is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["religion"].value;
if (x==null || x=="")
  {
  alert("Religion is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["address"].value;
if (x==null || x=="")
  {
  alert("Home Address is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["cellphone"].value;
if (x==null || x=="")
  {
  alert("Contact Number (cellphone) is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["email"].value;
if (x==null || x=="")
  {
  alert("Email Address is required!");
  return false;
  }
  
  var x=document.forms["register_seaman"]["email2"].value;
if (x==null || x=="")
  {
  alert("Confirm your Email Address!");
  return false;
  }
}


function validateForm_post_job()
{
var x=document.forms["post_job"]["job_title"].value;
if (x==null || x=="")
  {
  alert("Job Title is required!");
  return false;
  }
  
  if (x==null || x=="Choose Below")
  {
  alert("Job Title is required!");
  return false;
  }
  
  var x=document.forms["post_job"]["job_description1"].value;
if (x==null || x=="")
  {
  alert("Job description is required!");
  return false;
  }
  
  var x=document.forms["post_job"]["job_requirement1"].value;
if (x==null || x=="")
  {
  alert("Job requirement is required!");
  return false;
  }
  
  var x=document.forms["post_job"]["job_password"].value;
if (x==null || x=="")
  {
  alert("Employer Password is required!");
  return false;
  }
  
}
