<?php
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
session_start();
if (empty($_SESSION['login']))
{
  $message = "You are not logged in";
echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
}
?>
<?php
 if(isset($_POST['userSubmit'])){
 	$login = $_SESSION['login'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $street1 = $_POST['street1'];
  $street2 = $_POST['street2'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];
$zipcode =$_POST['zcode'];
$state = $_POST['state'];
$country = $_POST['country'];  
 $phone = $_POST['mnum'];
 $gender = $_POST['gen'];
$sql = "UPDATE users 
		set name='$name',
		email_id='$email',
		str1='$street1',
		str2='$street2',
		city='$city',
		landmark='$landmark',
		zipcode='$zipcode',
		state='$state',
		country='$country',
		phone='$phone',
		gender='$gender'
		where email_id='$login'";
		$_SESSION['login']=$email;
		$_SESSION['username']=$name;
  $qury  = mysqli_query($conn,$sql);
  if ($qury) {
  	echo "<script>alert('Successfully Updated');</script>";
  }
  else{
  	echo "<script>alert('!!!Failed!!!  Email-ID or Phone Number has already been taken');</script>";
  }
}?>


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
</font>
<a href="userhome.php"><button class="btn btn-default" >BACK</button></a>
<div class="container">

<form method="post"  class="form-horizontal">
<div class="form-group">
<table cellpadding="10px" cellspacing="10px" border=0 width="450px">
<?php
	$email = $_SESSION['login'];
	$query1 ="SELECT * FROM users where email_id = '$email'";
	$result = mysqli_query($conn,$query1);
$row = mysqli_fetch_assoc($result);
?>
<tr> 
   <td>Name : </td>
   <td><input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?> "></td>

</tr>
</td>
<tr> 
   <td>Email Id: </td>
   <td><input type="email_id" name="email" class="form-control" value="<?php echo $row["email_id"]; ?> "></td>
</tr>
<tr> 
   <td>Address :</td>
</tr>
<tr> 
   <td>Street1 : </td>
   <td><input type="street1" name="street1" class="form-control" value="<?php echo $row["str1"]; ?> "></td>
</tr>
<tr> 
   <td>Street2 : </td>
  <td><input type="street2" name="street2" class="form-control" value="<?php echo $row["str2"]; ?> "></td>
</tr>
<tr> 
   <td>city : </td>
  <td><input type="city" name="city" class="form-control" value="<?php echo $row["city"]; ?> "></td>
</tr>
<tr> 
   <td>landmark: </td>
   <td><input type="landmark" name="landmark" class="form-control" value="<?php echo $row["landmark"]; ?> "></td>
</tr>
<tr> 
   <td>Zip code : </td>
   <td><input type="Zip code" name="zcode" class="form-control" value="<?php echo $row["zipcode"]; ?> "></td>
</tr>
<tr> 
   <td>state : </td>
   <td><input type="state" name="state" class="form-control" value="<?php echo $row["state"]; ?> "></td>
</tr>
<tr> 
   <td>country: </td>
   <td><input type="country" name="country" class="form-control" value="<?php echo $row["country"]; ?> "></td>
</tr>

<tr> 
   <td>Phone Number : </td>
   <td><input type="Phone Number" name="mnum" class="form-control" value="<?php echo $row["phone"]; ?> "></td>
</tr>
<tr>
<td>
		Gender :
</td>
<td>
         <div class="form-inline">
		<input type="radio" name="gen" class="radio" id="gen" <?php if($row['gender']=="male") {echo "checked";}?> value="male"> male </input>
		<input type="radio" name="gen" class="radio" id="gen" <?php if($row['gender']=="female") {echo "checked";}?> value="female"> female </input>
		</div>
		</td>
</tr>
</table>
<br/>
<button type="submit" class="btn btn-default" name="userSubmit" >SAVE</button>
</div>
</form>
</div>

</body>
</html>