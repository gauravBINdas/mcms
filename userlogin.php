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
if(isset($_POST['userSubmit'])){
  $email = $_POST['userID'];
  $password = $_POST['userPwd'];
  $sql = "SELECT user_id,email_id,name,password from users where email_id='$email' and password='$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $check= mysqli_num_rows($result);
  if($check > 0){
    $_SESSION['login'] =$email;
	$_SESSION['username']=$row["name"];
	$_SESSION['user_id']=$row["user_id"];
    header("Location:userhome.php");
  }
  else{
     $message="Invalid Login";
	  echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
 }
}
?>