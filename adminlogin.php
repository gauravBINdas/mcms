<?php
session_start();
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
if($conn)
{
  echo"connect!!";
}
if(isset($_POST['adminSubmit'])){
  $admin = $_POST['adminID'];
  $password = $_POST['adminPwd'];
  $sql = "SELECT admin_id,password,name from admins where admin_id='$admin' and password='$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $check= mysqli_num_rows($result);
  if($check > 0){
    $_SESSION['login'] =$admin;
	$_SESSION['admin']=$row["name"];
    header("Location:adminhome.php");
  }
  else{
     $message="Invalid Login";
	  echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
 }
}

?>