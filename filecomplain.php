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
 echo "<script type='text/javascript'>alert('$message');window.location='/mcms/userhome.php';</script>";
}
if(strlen($_SESSION['login']) == ""){
    header("Location:index.php");
}
else{
if (isset($_POST['complaint_submit'])) {
		$user_id=$_SESSION['user_id'];
		$dept_id=$_POST['selectDept'];
	    $complaintmsg = $_POST['complaint_msg'];
		$complaintlocation = $_POST['complaint_loc'];
		$complaintdate=$_POST['complaint_date'];
			$imgfile=$_FILES['image']['name'];
	
		$filextension = strtolower(end(explode('.', $imgfile)));
		$extention = array("jpg","jpeg","png","gif");
		if (!in_array($filextension, $extention)) {
			$err="Use only .jpg / .jpeg / .png / .gif file extention.";
		}
		else{
			move_uploaded_file($_FILES['image']['tmp_name'],'images/'.basename($imgfile));
				
        $sql = "insert into complaint(message,picture,complaint_location,complaint_date,user_id,dept_id) 
          values('$complaintmsg','$imgfile','$complaintlocation','$complaintdate','$user_id','$dept_id')";
     
             
$result = mysqli_query($conn,$sql);
if ($result) {
	 $message="successfully uploaded";
	 echo "<script type='text/javascript'>alert('$message');window.location='/mcms/userhome.php';</script>";
}
else{
	$message="failed";
 echo "<script type='text/javascript'>alert('$message');window.location='/mcms/userhome.php';</script>";
}
}
}
}
?>