<?php
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "mcms";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("connection failed");
if($conn)
{
  echo"connect!!";
}
if (isset($_POST['regSubmit'])) {
		$name = $_POST['username'];echo $name;
		$addr2=$_POST['address2'];echo $addr2;
		$addr1 = $_POST['address1'];echo $addr1;
		$city=$_POST['address7'];echo $city;
		$landmark=$_POST['address3'];echo $landmark;
		$zipcode=$_POST['address4'];echo $zipcode;
		$state=$_POST['address5'];echo $state;
		$country=$_POST['address6'];echo $country;
		$email=$_POST['email'];echo $email;
		$phone=$_POST['phone'];echo $phone;
		$gender=$_POST['gen'];echo $gender;
		$password=$_POST['password'];echo $password;
		$cnfpassword=$_POST['cnfpassword'];echo $cnfpassword;
		if($password==$cnfpassword)
		{
		$sql = "insert into users(name,password,str1,str2,city,landmark,zipcode,state,country,email_id,phone,gender) values('$name','$password','$addr1','$addr2','$city','$landmark','$zipcode','$state','$country','$email','$phone','$gender')";
		$result = mysqli_query($conn,$sql);
		if ($result) {
			$message="Successfully Registered";
            echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
		}
		else{
			$message="failed to Connect to Database";
 echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";
		}
	    }
	    else
	    {
		$message="Confirm password not matched";
 echo "<script type='text/javascript'>alert('$message');window.location='/mcms';</script>";            
	    }
	}
?>