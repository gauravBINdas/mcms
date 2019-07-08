<?php
session_start();
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
if(!($conn))
{
  $message = "Not Connected to Database";
echo "<script type='text/javascript'>alert('$message');window.location='/mcms/adminhome.php';</script>";
}
if (empty($_SESSION['login']))
{
	$message = "You are not logged in";
echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
	
}
$admin_id = $_SESSION['login'];
$status="pending";
$sql="select c.complaint_id,c.message,c.status from admins a,complaint c,manages m where a.admin_id=m.admin_id and c.dept_id=m.dept_id and c.status='$status' and a.admin_id='$admin_id'";
$result=mysqli_query($conn,$sql);
$myJSON=mysqli_fetch_all($result,MYSQLI_ASSOC);
$status="working";
$sql="select c.complaint_id,d.dept_name,c.message,c.status from admins a,complaint c,manages m,department d where a.admin_id=m.admin_id and c.dept_id=m.dept_id and c.dept_id=d.dept_id and c.status='$status' and a.admin_id='$admin_id'";
$result1=mysqli_query($conn,$sql);
$myJSON1=mysqli_fetch_all($result1,MYSQLI_ASSOC);
$query="select dept_name from manages m,department d where m.dept_id=d.dept_id and m.admin_id='$admin_id'";
$result2=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result2);
?>
<html>
<head>
<title>AdminPage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body onload="myFunction();">
<font face="verdana" size=7 color="navyblue">
<center><b>Online Municipality Complaint System</b><br>
</font>
<font face="verdana" size=5 color="navyblue">
<b><?php echo $row["dept_name"]; ?></b><br>
</font>

<hr width=* size=6 align="center" color="navyblue"></center>
<style type="text/css">
.dropdownMenu{
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}
.dropdown-menu { right: 0; left: auto; }
a:active {
    color: gray;
}
a:visited {
    color:black;
}
#listcomplaint tr.item-row td { border: 0; vertical-align: top; }
#listcomplaint td.Description { width: 300px;}
#listcomplaint td.complaint-ID { width: 175px;}
#listcomplaint td.Status { width: 175px;}
#listcomplaint td.open_link { width: 175px;}
#listcomplaint td.Description textarea, #listcomplaint td.complaint-ID textarea { width: 100%;},#listcomplaint td.Status textarea { width: 100%;},#listcomplaint td.open_link textarea { width: 100%;}
textarea{ resize:none;}
</style>
<form class="dropdownMenu">
 <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">My Account
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
	   <li><a href="changeadminpwd.php">Change Password</a></li>
      <li><a href="logoutDemo.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
	  
    </ul>
  </div>
</form>
<div class="container">
  <h2 id="admin_name"><b><?php echo $_SESSION['admin']?></h2>
  <ul class="nav nav-tabs">
  
   <li class="active" ><a data-toggle="tab"  href="#complaint_list">Complaint List</a></li>
    
	 <li ><a data-toggle="tab" href="#working" onclick="myFunction1()">Ongoing works</a></li>
	<!-- <li ><a data-toggle="tab" href="#profile">Profile</a></li>-->
  </ul>

  <div class="tab-content">
    
	
<div id="complaint_list" class="tab-pane fade in active">
     
	    <b><p id="noRecord" align="center"></p></b>
	  <br/>
	  <div id="complaint_list_container" style="overflow-y: auto; height:47%;" class="container">
	  
	  </div>
<script type="text/javascript">

var forHeader=1;
var runTime=1;
 
  var arr=<?php echo json_encode($myJSON) ?>;
  var n=0;
  n=arr.length;
function myFunction() 
{
	if(n==0)
	{
		document.getElementById("noRecord").innerHTML ="!!!!!!No Record Found!!!!!!";
	}		 
	if(runTime==1)
	{
for(var i=0;i<n;i++)
{
	if(forHeader==1)
 {
	 var table = document.createElement("TABLE");
	id="listcomplaint";
  table.setAttribute("id",id);
  table.setAttribute("align","center");
  var header = table.createTHead();
  var row = header.insertRow();
  var cell1 = row.insertCell(0);
  cell1.innerHTML = "<b>Complaint-ID</b>";
  var cell2 = row.insertCell(1);
  cell2.innerHTML = "<b>Description</b>";
  var cell3 = row.insertCell(2);
  cell3.innerHTML = "<b>Status</b>";
  var cell4 = row.insertCell(3);
  cell4.innerHTML = "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>";
  forHeader++;
  cell1.setAttribute("class", "complaint-ID");
  cell2.setAttribute("class", "Description");
  cell3.setAttribute("class", "Status");
  cell4.setAttribute("class", "open_link");
    document.getElementById("complaint_list_container").appendChild(table);
 }
	var formElement = document.createElement("FORM");
   var id="myForm"+i;
 formElement.setAttribute("id", id);
 formElement.setAttribute("action","complaints.php");
 formElement.setAttribute("method","post");
 formElement.style.margin=0;
	var table = document.createElement("TABLE");
	id="listcomplaint";
  table.setAttribute("id",id);
  table.setAttribute("align","center");
  formElement.appendChild(table);
 
  
  var row = table.insertRow();
row.setAttribute("class","form-group");

  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
   
  cell1.setAttribute("class", "complaint-ID");
  cell2.setAttribute("class", "Description");
  cell3.setAttribute("class", "Status");
  cell4.setAttribute("class", "open_link");
 
var b=document.createElement('input');
id="btn";
b.setAttribute("type","submit")
b.setAttribute("id",id);
b.setAttribute("name",id);
b.setAttribute("class","btn btn-default");
b.value="Click to Open";

("class","form-control");
  cell1.innerHTML = "<textarea id=complaintID name=complaintID class=form-control readonly>"+arr[i].complaint_id+"</textarea>";
  cell2.innerHTML = "<textarea id=msg name=msg class=form-control readonly>"+arr[i].message+"</textarea>";
  cell3.innerHTML = "<textarea id=st name=st class=form-control readonly>"+arr[i].status+"</textarea>";
  cell4.appendChild(b);
  document.getElementById("complaint_list_container").appendChild(formElement);
   runTime++;
}
}
}

</script>
	  
 </div>
    <div id="working" class="tab-pane fade ">
	   <b><p id="noRecord1" align="center"></p></b>
	  <br/>
	  <div id="working_list_container" style="overflow-y: auto; height:47%;" class="container">
	  
	  </div>
<script type="text/javascript">

var forHeader1=1;
var runTime1=1;
 
  var arr1=<?php echo json_encode($myJSON1) ?>;
  var n1=0;
  n1=arr1.length;
function myFunction1() 
{
	if(n1==0)
	{
		document.getElementById("noRecord1").innerHTML ="!!!!!!No Record Found!!!!!!";
	}		 
	if(runTime1==1)
	{
for(var i=0;i<n1;i++)
{
	
 if(forHeader1==1)
 {
 var table = document.createElement("TABLE");
 id="listcomplaint";
  table.setAttribute("id",id);
  table.setAttribute("align","center");
  var header = table.createTHead();
  var row = header.insertRow();
  row.setAttribute("class","form-group");
  var cell1 = row.insertCell(0);
   cell1.setAttribute("class", "complaint-ID");
  cell1.innerHTML = "<b>Complaint-ID</b>";
  var cell2 = row.insertCell(1);
  cell2.setAttribute("class", "Description");
  cell2.innerHTML = "<b>Description</b>";
  var cell3 = row.insertCell(2);
   cell3.setAttribute("class", "Status");
  cell3.innerHTML = "<b>Status</b>";
  var cell4 = row.insertCell(3);
    cell4.setAttribute("class", "open_link");
  cell4.innerHTML = "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>";
 
  
 

  forHeader1++;
   document.getElementById("working_list_container").appendChild(table);
 }
  var formElement = document.createElement("FORM");
   var id="myForm1_"+i;
 formElement.setAttribute("id", id);
 formElement.setAttribute("action","complaints.php");
 formElement.setAttribute("method","post");
 formElement.style.margin=0;
	var table = document.createElement("TABLE");
	id="listcomplaint";
  table.setAttribute("id",id);
  table.setAttribute("align","center");
  formElement.appendChild(table);
  var row = table.insertRow();
row.setAttribute("class","form-group");

  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
   
  cell1.setAttribute("class", "complaint-ID");
  cell2.setAttribute("class", "Description");
  cell3.setAttribute("class", "Status");
  cell4.setAttribute("class", "open_link");
 
var b=document.createElement('input');
id="btn";
b.setAttribute("type","submit")
b.setAttribute("id",id);
b.setAttribute("name",id);
b.setAttribute("class","btn btn-default");
b.value="Click to Open";

("class","form-control");
  cell1.innerHTML = "<textarea id=complaintID name=complaintID class=form-control readonly>"+arr1[i].complaint_id+"</textarea>";
  cell2.innerHTML = "<textarea id=msg name=msg class=form-control readonly>"+arr1[i].message+"</textarea>";
  cell3.innerHTML = "<textarea id=st name=st class=form-control readonly>"+arr1[i].status+"</textarea>";
  cell4.appendChild(b);
  document.getElementById("working_list_container").appendChild(formElement);
   runTime1++;
}
}
}

</script>
	
	</div>
<!--	<div id="profile" class="tab-pane fade ">
      <h3>Profile</h3>
      <p>profile form yaha</p>
    
	
	</div> -->
  </div>
</div>
 
</body>
</html>
