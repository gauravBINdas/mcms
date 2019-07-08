<?php
session_start();
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
if(!($conn))
{
  $message="failed to Connect to Database";
 echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
}
if (isset($_POST['statusSubmit'])) {
	    $status=$_POST['status'];
		$complaint_id=$_SESSION['complaintID'];
		$sql = "update complaint set status='$status' where complaint_id='$complaint_id'";
		$result = mysqli_query($conn,$sql);
		if ($result) {
			$message="Status Successfully Updated";
			$_SESSION['form']=1;
            echo "<script type='text/javascript'>alert('$message');window.location='/mcms/complaints.php';</script>";
		}
	}
?>