<html>
<head>
<title>HomePage</title>
</head>
<body>
<font face="verdana" size=7 color="navyblue">
<center><b>Online Municipality Complaint System</b><br>
</font>
<hr width=* size=6 align="center" color="navyblue">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript"> 
        function displayForm(c){ 
            if(c.value == "usr"){ 

              jQuery('#userformContainer').toggle('show');
              jQuery('#adminformContainer').hide();
			  jQuery('#userregformContainer').hide();
            } 
            else if(c.value =="admin"){ 
                jQuery('#adminformContainer').toggle('show');
                jQuery('#userformContainer').hide();
				jQuery('#userregformContainer').hide();
            } 
            else if(c.value=="usrreg")
            {
			  jQuery('#userregformContainer').toggle('show');
                jQuery('#userformContainer').hide();
				jQuery('#adminformContainer').hide();
            } 
			else
			{
			
			}
			
         }         
 </script>
 <div class="form-group">
	    <div class="form-inline">
<input type="radio" name="party" class="radio" id="usr" value="usr" onclick="displayForm(this)" required>
<label for="usr"><b>User</label>
&nbsp;&nbsp;
<input type="radio" name="party" class="radio" id="admin" value="admin" onclick="displayForm(this)" required>
<label for="admin"><b>Admin</label>
&nbsp;&nbsp;
<input type="radio" name="party" class="radio" id="usrreg" value="usrreg" onclick="displayForm(this)">
<label for="usrreg"><b>User Registration</label>
</div>
</div>
 <div style="display:none" id="userformContainer" class="container">
 <form id="userform" action="userlogin.php" method="post">
 <table align="center" bgcolor="navyblue" cellpadding="10px" cellspacing="10px" border=0 width="450px">
	  <tr>
	  <td>
	    <div class="form-group">
	    Email ID :
		<input type="text" name="userID" class="form-control" id="userID" maxlength=40 size=20 required></input>
		</div>
       </tr>
	   <tr>
	   <td>
	   <div class="form-group">
	    Password :
		<input type="password" name="userPwd" class="form-control" id="userPwd" maxlength=20 size=20 required></input>
		</div>
        </tr>
		<tr>
		<td>
		<input type="submit" name="userSubmit" class="btn btn-default" id="userSubmit" value="Login"></input>
		</tr>
	</table>
 </form>
 </div>
  <div style="display:none" id="adminformContainer" class="container">
  <form id="adminform" action="adminlogin.php" method="post" >
    <table align="center" bgcolor="navyblue" cellpadding="10px" cellspacing="10px" border=0 width="450px">
	  <tr>
	  <td>
	     <div class="form-group">
	    Admin ID :
		<input type="text" name="adminID" class="form-control" id="adminID" maxlength=10 size=20 required></input>
		</div>
       </tr>
	   <tr>
	   <td>
	     <div class="form-group">
	    Password :
		<input type="password" name="adminPwd" class="form-control" id="adminPwd" maxlength=10 size=20 required></input>
		</div>
        </tr>
		<tr>
		<td>
		<input type="submit" name="adminSubmit" class="btn btn-default" id="adminSubmit" value="Login"></input>
		</tr>
	</table>
		</form>
  </div>
  <div style="display:none;overflow-y:auto; height:470px;"id="userregformContainer"  class="container">
  <form id="userregform" action="insert.php" method="post" class="form-horizontal">
  <table align="center" cellpadding="10px" cellspacing="10px" border=0 width="450px">
    <tr>
	  <td>
	    <div class="form-group">
	    Name :
		<input type="text" name="username" class="form-control" id="username" maxlength=30 size=30 required></input>
		</div>
     </tr>
	 <tr>
	  <td>
	    <div class="form-group">
	    <div class="form-inline">
		Gender :
		<input type="radio" name="gen" class="radio" id="gen" value="male"> male </input>
		<input type="radio" name="gen" class="radio" id="gen" value="female"> female </input>
		</div>
		</div>
       </tr>
	   <tr>
	   <td>
	   <div class="form-group">
	   Address:
	   </tr>
	   <tr><td>
	   <div class="form-group">
	   <i>street1 :</i>
	  <input type="text" name="address1" class="form-control" id="str1" maxlength=50 size=50 required></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  <i>street2 :</i>
	  <input type="text" name="address2" class="form-control" id="str2" maxlength=50 size=50></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  <i>landmark :</i>
	  <input type="text" name="address3" class="form-control" id="landmark" maxlength=50 size=50 required></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	   <i>city :</i>
	  <input type="text" name="address7" class="form-control" id="city" maxlength=50 size=50 required></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  <i>zipcode :</i>
	  <input type="text" name="address4" class="form-control" id="zipcode" maxlength=6 size=6 required></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  <i>state :</i>
	  <input type="text" name="address5" class="form-control" id="state" maxlength=30 size=30 required></input>
	  </tr>
	  <tr><td>
	  <div class="form-group">
	  <i>country :</i>
	  <input type="text" name="address6" class="form-control" id="country" maxlength=20 size=20 required></input>
	  </tr>
	   <tr>
	  <td>
	   <div class="form-group">
		Password :
	   <input type="text" name="password" class="form-control" id="password" maxlength=10 size=20 required></input>
	   </tr>
	   <tr>
	  <td>
	    <div class="form-group">
	    Confirm Password :
	   <input type="password" name="cnfpassword" class="form-control" id="cnfpassword" maxlength=10 size=20 required></input>
	   </tr>
	  <tr>
	  <td>
	   <div class="form-group">
	    Email id:
	   <input type="text" name="email" class="form-control" id="email" maxlength=30 size=30 required></input>
	   </tr>
	   <tr>
	   <td>
	     <div class="form-group">
	     Phone :
		  <input type="text" name="phone" class="form-control" id="phone" maxlength=13 size=13></input>
		</tr>
		<tr>
		<td>
		<center>
		<input type="submit" name="regSubmit" class="btn btn-default" id="regSubmit" value="Submit"></input>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" name="regReset" class="btn btn-default" id="regReset" value="Reset"></input>
		</tr>
  </table>
  </form>
  </div>
</body>
<html>