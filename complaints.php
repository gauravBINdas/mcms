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
}
$comp_id="";
if (isset($_POST['btn'])) 
{
	$_SESSION['complaintID']=$_POST['complaintID'];
	$_SESSION['form']=1;
}
$comp_id=$_SESSION['complaintID'];
$sql="select * from complaint where complaint_id='$comp_id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
textarea{ resize:none;}
img{
max-width:100%;
max-height:100%
}
.auto-resize-portrait {
height: 350px;
width: 500px;
}
</style>
<body onload="displayForm(<?php echo $_SESSION['form'];?>)">
<script type="text/javascript">
 

 function displayForm(c){ 
            if(c==1){ 
              jQuery('#complaint_details').toggle('show');
              jQuery('#update_details').hide();
            } 
            else if(c==2){
				<?php $_SESSION['form']=2;?>
                jQuery('#update_details').toggle('show');
                jQuery('#complaint_details').hide();
            }
		}

</script>
<font face="verdana" size=7 color="navyblue">
<center><b>Online Municipality Complaint System</b><br>
</font>
<font face="verdana" size=5 color="navyblue">
<b>Complaint Details</b><br>
</center>
</font>
<button style="font-size:18px" class="btn btn-default" onclick="window.location='/mcms/adminhome.php';"><i class="fa fa-arrow-circle-o-left"></i> Back to Home</button>
 
 
 
 
 
 <div style="overflow-y:auto; height:470px;display:none;" id="complaint_details"  class="container">
 <br/><br/>
 
  <form id="complaint_info" class="form-horizontal">
  <table align="left" cellpadding="10px" cellspacing="10px" border=0 width="450px">
  <tr>
	  <td>
	    <div class="form-group" id="img_div">
		<div class="auto-resize-portrait">
		<img src="images/<?php echo $row["picture"];?>"></img>
		</div>
		</div>
     </tr>
    <tr>
	  <td>
	    <div class="form-group">
	    <p><b>Complaint ID :</b><?php echo $row["complaint_id"];?></p>
		</div>
     </tr>
	 <tr>
	  <td>
	    <div class="form-group">
	    <p><b>Location :</b><?php echo $row["complaint_location"];?></p>
		</div>
     </tr>
	<tr>
	  <td>
	    <div class="form-group">
	    <p><b>Message :</b>
		<?php echo $row["message"]; ?></p>
		</div>
     </tr>
	 <tr>
	  <td>
	    <div class="form-group">
	    <p><b>Status :</b><font color="red"><?php echo $row["status"];?></font></p>
		</div>
     </tr>
	  <tr>
	  <td>
	    <div class="form-group">
	   <button style="font-size:18px" class="btn btn-default" onclick="displayForm(2);">Update</button>
		</div>
     </tr>
  </table>
  </form>
  </div>

  
  <div style ="overflow-y:auto; height:470px;display:none;" id="update_details"  class="container">
 
<form id="update_complaint_info" class="form-horizontal" action="updatestatus.php" method="post">
<table align="left" cellpadding="10px" cellspacing="10px" border=0 width="450px">
<tr>
	  <td>
	    <div class="form-group" id="img_div">
		<div class="auto-resize-portrait">
		<img src="images/<?php echo $row["picture"];?>"></img>
		</div>
		</div>
     </tr>
    <tr>
	  <td>
	    <div class="form-group">
	    <b>Complaint ID :</b><?php echo $row["complaint_id"];?></p>
		</div>
     </tr>
	 <tr>
	  <td>
	    <div class="form-group">
	    <p><b>Location :</b><?php echo $row["complaint_location"];?></p>
		</div>
     </tr>
	<tr>
	  <td>
	    <div class="form-group">
	    <p><b>Message :</b>
		<?php echo $row["message"]; ?></p>
		</div>
     </tr>
	 <tr>
	  <td>
	    <div class="form-group">
	    <p><b>Status :</b></p>
		<select name="status" class="col-xs-4" id="status">
			<option value="pending">Pending</option>
			<option value="working">Working</option>
			<option value="cleared">Cleared</option>
		</div>
     </tr>
	  <tr>
	  <td>
	    <div class="form-group">
		<br/>
	   <input type="submit" style="font-size:18px" class="btn btn-default" id="statusSubmit" name="statusSubmit" value="Submit"></input>
		</div>
     </tr>
</table>
</form>
</div>
</body>
</html>