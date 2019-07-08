<?php
session_start();
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
if(!($conn))
{
  echo "Not Connected to Database";
}
if (empty($_SESSION['login']))
{
	$message = "You are not logged in";
echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
	#header("Location:index.php");
}
$userid = $_SESSION['user_id'];
$email = $_SESSION['login'];
$sql="select complaint_id,message,status from complaint where user_id='$userid'";
$result=mysqli_query($conn,$sql);
$myJSON=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<html>
<head>
<title>UserPage</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<font face="verdana" size=7 color="navyblue">
<center><b>Online Municipality Complaint System</b><br>
</font>
<hr width=* size=6 align="center" color="navyblue"></center>
<style type="text/css">
.dropdownMenu{
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}
.dropdown-menu { right: 0; left: auto; }

#statusTable tr.item-row td { border: 0; vertical-align: top; }
#statusTable td.description { width: 300px;}
#statusTable td.complaint-id { width: 175px;}
#statusTable td.status-report { width: 175px;}
#statusTable td.description textarea, #statusTable td.complaint-id textarea { width: 100%;},#statusTable td.status-report textarea { width: 100%;}
textarea{ resize:none;}

</style>


<form class="dropdownMenu">
 <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">My Account
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
	<li><a href="changeuserpwd.php">Change password</a></li>
    <li><a href="logoutDemo.php"> <span class="glyphicon glyphicon-log-out"></span>   Log out</a></li>
	</ul>
  </div>
</form>
<div class="container">
  <h2 id="name"><b><?php echo $_SESSION['username']?></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#complaint">File Complaint</a></li>
      <li><a data-toggle="tab" href="#profile">Profile</a></li>
    <li><a data-toggle="tab" href="#status" onclick="myFunction()">Status</a></li>
  </ul>
</b>
  <div class="tab-content">
    <div id="complaint"  class="tab-pane fade in active">
	  <br/>
	  <form id="filecomplaintform" action="filecomplain.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <table align="center" cellpadding="10px" cellspacing="10px" border=0 width="450px">
  <tr>
<td>
<div class="form-group">
Department:
<select  name="selectDept" class="form-control" autocomplete="off"  required>
	<option disabled selected value="">--Select Department--</option>
	<?php
	$sql = "SELECT dept_id,dept_name from department";
	$result=mysqli_query($conn,$sql);
	while($d = mysqli_fetch_assoc($result)){ ?>
	<option value="<?php echo htmlentities($d['dept_id']); ?>"><?php echo htmlentities($d['dept_name']);?></option>
    <?php } ?>
	</select>
</td>
</tr>
    <tr>
	  <td>
	    <div class="form-group">
		Message :<textarea name="complaint_msg" class="form-control" id="complaint_msg" rows=6 cols=50 placeholder="Enter your Complaint here(max 250 words)..." required></textarea>
		</div>
		</tr>
		<tr><td>
		<div class="form-group">
		
		                    Upload Image :
							<input type="file" name="image" id="image"></input>
		
		</div>
     </tr>
	 <tr>
	  <td>
	   <div class="form-group">
	   Complaint Location :<textarea name="complaint_loc" class="form-control" id="complaint_loc" rows=3 cols=50 placeholder="Enter complaint location"required></textarea>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  complaint date:<input type="date" name="complaint_date" class="form-control" id="complaint_date" required></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  <center>
	  <input type="submit" name="complaint_submit" align="center" class="btn btn-default" id="complaint_submit" value="Submit"></input>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="reset" name="complaint_reset" align="center" class="btn btn-default" id="complaint_reset" value="Reset"></input>
	  </center>
	  </tr>
  </table>
  </form>
    </div>
    
	
	
	
<div id="profile"  class="tab-pane fade">
<br/><br/>
     
      <?php
$query1 ="SELECT * FROM users where email_id = '$email'";
$result = mysqli_query($conn,$query1);
//$i=0;
$row = mysqli_fetch_assoc($result);
?>
<div class="form-group">
<table cellpadding="10px" cellspacing="10px" border=0 width="450px">
<tr> 
   <td>Name : </td>
   <td><input type="text" name="name" class="form-control" readonly value="<?php echo $row["name"]; ?> ">

</tr>
</td>
<tr> 
   <td>Email Id: </td>
   <td><input type="email_id" name="email" class="form-control" readonly value="<?php echo $row["email_id"]; ?> ">
</tr>
<tr> 
   <td>Address : </td>
</tr>
<tr> 
   <td>Street1 : </td>
   <td><input type="street1" id ="name" name="street1" class="form-control" readonly value="<?php echo $row["str1"]; ?> "></textarea></td>
</tr>
<tr> 
   <td>Street2 : </td>
  <td><input type="street2" id ="name" name="street2" class="form-control" readonly value="<?php echo $row["str2"]; ?> "></textarea></td>
</tr>
<tr> 
   <td>city : </td>
  <td><input type="city" id ="name" name="city" class="form-control" readonly value="<?php echo $row["city"]; ?> "></textarea></td>
</tr>
<tr> 
   <td>landmark: </td>
   <td><input type="landmark" id ="name" name="landmark" class="form-control" readonly value="<?php echo $row["landmark"]; ?> "></textarea></td>
</tr>
<tr> 
   <td>Zip code : </td>
   <td><input type="Zip code" id ="name" name="zcode" class="form-control" readonly value="<?php echo $row["zipcode"]; ?> "></td>
</tr>
<tr> 
   <td>state : </td>
   <td><input type="state" id ="name" name="state" class="form-control" readonly value="<?php echo $row["state"]; ?> "></textarea></td>
</tr>
<tr> 
   <td>country: </td>
   <td><input type="country" id ="name" name="country" class="form-control" readonly value="<?php echo $row["country"]; ?> "></textarea></td>
</tr>

<tr> 
   <td>Phone Number : </td>
   <td><input type="Phone Number" id ="name" name="mnum" class="form-control" readonly value="<?php echo $row["phone"]; ?> "></td>
</tr>
<tr>
<td>Gender : </td>
<td><input type="text" name="gender" class="form-control" readonly value="<?php echo $row["gender"]; ?>"></td>
</tr>
</table>
<br/>
<button class="btn btn-default" onclick="window.location='update_user.php'">Edit</button></a>
	
	</div>
</div>
	
	
    <div id="status" style="overflow-y: auto; height:350px;" class="tab-pane fade"><br/>
	  <b><p id="noRecord" align="center"></p></b>
	  <br/>
<script>
var forHeader=1;
var runTime=1;
 var table = document.createElement("TABLE");
  table.setAttribute("id","statusTable");
  table.setAttribute("align","center");
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
  var header = table.createTHead();
  var row = header.insertRow();
  var cell1 = row.insertCell(0);
  cell1.innerHTML = "<b>Complaint-ID</b>";
  var cell2 = row.insertCell(1);
  cell2.innerHTML = "<b>Description</b>";
  var cell3 = row.insertCell(2);
  cell3.innerHTML = "<b>Status</b>";
  forHeader++;
 }
  var row = table.insertRow();
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
   cell1.setAttribute("class", "complaint-id");
  cell2.setAttribute("class", "description");
  cell3.setAttribute("class", "status-report");
  cell1.innerHTML = "<textarea class=form-control readonly>"+arr[i].complaint_id+"</textarea>";
  cell2.innerHTML = "<textarea class=form-control readonly>"+arr[i].message+"</textarea>";
  cell3.innerHTML = "<textarea class=form-control readonly>"+arr[i].status+"</textarea>";
   document.getElementById("status").appendChild(table);
   runTime++;
}
}
}
</script>

    </div>
  </div>
</div>
</body>
</html>