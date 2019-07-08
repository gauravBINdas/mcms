<html>
<head>
<title>Change password</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="chPwd" class="container">
 <form id="pwdChange" action="changeadminpwd.php" method="post">
 <table align="center" bgcolor="navyblue" cellpadding="10px" cellspacing="10px" border=0 width="450px">
	  <tr>
	  <td>
	    <div class="form-group">
	    Current Password :
		<input type="text" name="crpwd" class="form-control" id="crpwd" maxlength=20 size=20 required></input>
		</div>
       </tr>
	   <tr>
	   <td>
	   <div class="form-group">
	    New Password :
		<input type="text" name="newpwd" class="form-control" id="newpwd" maxlength=20 size=20 required></input>
		</div>
        </tr>
		<tr>
	   <td>
	   <div class="form-group">
	    Confirm New Password :
		<input type="password" name="cnfpwd" class="form-control" id="cnfpwd" maxlength=20 size=20 required></input>
		</div>
        </tr>
		<tr>
		<td>
		<input type="submit" name="pwdSubmit" class="btn btn-default" id="pwdSubmit" value="Submit"></input>
		</tr>
	</table>
 </form>
 </div>
 </body>
 </html>
<?php
session_start();
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
if($conn)
{
if(isset($_POST['pwdSubmit'])){
  $curr_pwd =$_POST['crpwd'];
  $new_pwd=$_POST['newpwd'];
  $cnf_pwd=$_POST['cnfpwd'];
  $admin=$_SESSION['login'];
  if($new_pwd!=$cnf_pwd)
  { 
	   $message="Confirm password not matched";
	  echo "<script type='text/javascript'>alert('$message');window.location='/mcms/changeadminpwd.php';</script>";
  }
  else{
  $sql1="select password from admins where admin_id='$admin'";
  $result1=mysqli_query($conn,$sql1);
  $row = mysqli_fetch_assoc($result1);
  if($row["password"]==$curr_pwd)
  {
  $sql = "update admins set password='$cnf_pwd' where admin_id='$admin'";
  $result = mysqli_query($conn,$sql);
  if($result)
  {
    $message="Password updated successfully!!!!";
	 echo "<script type='text/javascript'>alert('$message');window.location='/mcms/adminhome.php';</script>";
	
  }
    else{
     echo "error";
       }
  }
  else{
	  $message="Current password not matched";
	  echo "<script type='text/javascript'>alert('$message');window.location='/mcms/changeadminpwd.php';</script>";
       }
}
}
}
?>