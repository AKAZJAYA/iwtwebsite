
<?php 
	include 'config.php';

	$UID = $_COOKIE['UID'];

	$fullname = "";
	$DOB = "";
	$gender = "";
	$email = "";
	$mobileNumber = "";
	$address = "";
	
	$sql = "SELECT * FROM ragistration WHERE userName = '".$UID."'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$fullname =  $row["fullName"];
		$DOB = $row["birthday"];
		$gender = $row["gender"];
		$email = $row['email'];
		$mobileNumber = $row["mobileNumber"];
		$address = $row["address"];
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Profile - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/useraccount.css">
    <script defer src="java/script.js"></script>

</head>
<body>

  <header class="header">
      <img id="logo" src="images/logo1.jpeg">
      <nav class="navbar">
          <a href="index.html">Home</a>
          <a href="./news.html">News</a>
            <a href="./about.html">About</a>
            <a href="./contactUs.php">Contact Us</a>
      </nav>

      <p class="header_username" id="header_username"><?php  echo($_COOKIE['UID']); ?></p>
      <img src="./images/profileP-removebg-preview.png" alt="" class="profilephoto">
  </header>


<!-- Write your code between header and footer -->

<div class="background-image"></div>
 <div class="content"></div> <!--background image-->
 
 <section class="sect"> <!--Section adding-->




 <form action="#" method="post" class="info">

	<div id="topic"> <!--topic-->
		<span id="userinfo">User Information</span> <!--user information-->
		<span id="changepw">Change password</span><!--change pw-->
	</div>
 
 <div id="container">  <!--contains fullname and old password-->
	<span>
		<input name="fullname" type="text" id="name"  placeholder="Full name" value="<?php echo $fullname ?>"> <!--full name text box-->
	</span>
	
	<span>
         <input type="password" id="oldpw" maxlength="12" placeholder="Enter old password" name="oldPass"> <!--old password-->
	</span>
</div>	 

	<div id="container1"> <!--contains date of birth and new password-->
		<span>
			<label for="date" id="dob">Date of birth</label><br>
			<input name="dob" type="date" id="bdate" name="bdate" value="<?php echo $DOB ?>">            <!--date of birth-->
		</span>
	
		<span>  <!--new password-->
			<input type="password" id="newpass" name="nwpass" maxlength="12" placeholder="Enter new password" >
		</span>
	</div>
	
	<div id="container2"> <!--contains dropdown box and confirm password--> 
		<span>
            <label for="ge" id="gen">Gender</label><br><!--gender text-->
				<select id="gender" name="gender">
					<option value="male">Male</option> <!--gender dropdown box-->
					<option value="female">Female</option>
					<option value="other">Other</option>
				</select>
		</span>
	 
		<span>  <!--confirm password-->
			<input type="password" id="conpass" name="cpass" maxlength="12" placeholder="Confirm password" >
		</span>
	 </div>

	 <div class="updatePassword">
		<input type="submit" class="updatePassword-btn" value="Update Password" name="updatePassword">
	 </div>
	 
	<div id="container3"><!--conains contact information and proilfe page-->
		<span id="contact">Contact information</span>
		<!-- <span id="profile">Profile picture</span> -->
		
	</div>
	
	<div id="container4"><!--contains email ,profile pic-->
		<span>
			<input name="email" type="text" id="email"  placeholder="Email" value="<?php echo $email ?>"> <!--email text box-->
		</span>
		<span>
			<!-- <input type="file" name="fileToUpload" id="image" > profile picture upload -->
		</span>
	</div>
	
	<div id ="container5"> <!--Contains mobile number, account deletion heading-->
		<span>
			<input name="mobileNumber" type="text" id="number"  placeholder="Mobile number" value="<?php echo $mobileNumber ?>"> <!--mobile number text box-->
		</span>
		<span id="delete">Account deletion</span> <!--Account deletion heading-->
	</div>
	
	<div id="container6"> <!--contains address text box,account delete button-->
		<span>
			<input name="address" type="text" id="add"  placeholder="Address" value="<?php echo $address ?>"> <!--address text box-->
		</span>
		<span>
		<input type="submit" id="deleteaccount" name="delete_account" class="btn btn-danger" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account ?');">
		</span>
	</div>
	
	<input type="submit"  value="Save changes" id="subbutton" name="updateUserDetalis">
	 
 </form>
</section>

      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="">Help and Support</a><br>The Vaccination Management System</p>
      </footer>


    

</body>
</html>

<?php 

if (isset($_POST['fullname']) AND isset($_POST['dob']) AND isset($_POST['email']) AND isset($_POST['mobileNumber']) AND isset($_POST['address']) AND isset($_POST['updateUserDetalis'])) {
	$fullname = $_POST['fullname'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$mobileNumber = $_POST['mobileNumber'];
	$address = $_POST['address'];

	$sql = "UPDATE ragistration SET fullName = '".$fullname."', birthday = '".$dob."', email = '".$email."', mobileNumber = '".$mobileNumber."', address = '".$address."' WHERE userName = '".$UID."'";
	if(mysqli_query($conn, $sql)){
	echo('Success');
	echo('<script>window.location="useraccount.php";
			alert("Your profile updated successfully...");
	</script>');
	}else {
	echo('Failed');
	}

}

if(isset($_POST['oldPass']) AND isset($_POST['nwpass']) AND isset($_POST['cpass']) AND isset($_POST['updatePassword'])){
	$oldPass = $_POST['oldPass'];
	$nwpass = $_POST['nwpass'];
	$cpass = $_POST['cpass'];

	if($nwpass != $cpass){
		echo('<Script>alert("New password and Confirm password dose not match...")</script>');
	}
	else{

		$sql2 = "SELECT password FROM ragistration WHERE userName = '".$UID."'";
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result2) > 0) {
		while($row = mysqli_fetch_assoc($result2)) {
			$oldPassword =  $row["password"];

			if ($oldPassword == $oldPass) {
				$sql = "UPDATE ragistration SET password = '".$nwpass."' WHERE userName = '".$UID."'";
				if(mysqli_query($conn, $sql)){
					echo('Success');
					echo('<script>window.location="useraccount.php";
							alert("Your password updated successfully...");
					</script>');
				}
			}else {
			echo('<script>alert("Old password dose not match...");</script>');
			}
		}
		}
	}
}

if(isset($_POST['delete_account'])){

	$sql = "DELETE FROM ragistration WHERE userName = '".$UID."'";
	$result = mysqli_query($conn, $sql);

	if($result){

		echo('<script>window.location="index.html";
					alert("Your account deleted successfully...");
					document.cookie = "UID" +"=username; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
				</script>');
	}
}
	


	if ($UID == null) {
	echo('<script>window.location="login.php"</script>');
	}

?>