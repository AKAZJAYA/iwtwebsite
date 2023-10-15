<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />

    <title>User Dashboard - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/userdboard.css">
    <script defer src="java/script.js"></script>

</head>
<body>

  <header class="header">
      <img id="logo" src="./images/250356a297.jpeg">
      <nav class="navbar">
          <a href="index.html">Home</a>
          <a href="./news.html">News</a>
          <a href="./about.html">About</a>
          <a href="./contactUs.php">Contact Us</a>
      </nav>
      <p class="header_username" id="header_username">Welcome <?php  echo($_COOKIE['UID']); ?></p>
      <img src="./images/profileP-removebg-preview.png" alt="" class="profilephoto">

      <div class="logout-btn">
  <input type="button" id="logoutBtn" value="Logout">
</div>
  </header>

<!-- Write your code between header and footer -->
<div class="banner"></div> <!--banner-->
<div class="content"><!--heading and content-->
	<h1>WELCOME TO DOSEGUARDIAN</h1>
	<p>In this web page you can schedule your appointment,chage your appointment,
	view vaccination information and view vaccination history</p>
	
	<div>
  <a href="./appointment.php"><button type="button"><span></span>Schedule appointment</button></a>
		<a href="./changeAppointment.php"><button type="button"><span></span>Change appointment </button></a>
		<a href="./vaccineInformation.php"><button type="button"><span></span>Vaccination information</button></a>
   
	</div>
  
</div>
<div class="profile-btn">
  <a href="./useraccount.php"><input type="button" id="profile-button" value="Profile"></a>
</div>


      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      <script>
        document.getElementById("logoutBtn").addEventListener('click', function (){
          document.cookie = 'UID' +'=username; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          window.location='userdboard.php';});
      </script>


    

</body>
</html>

<?php
// Include the 'config.php' file to establish a database connection
include 'config.php';

// Get the value of the 'UID' cookie
$UID = $_COOKIE['UID'];

// Check if 'UID' is equal to 'admin'
if ($UID == 'admin') {
    // If the user is an admin, redirect to 'admin.php'
    echo "<script>window.location='admin.php';</script>";
}

// Check if 'UID' is not set
if ($UID == null) {
    // If 'UID' is not set, redirect to the 'login.php' page
    echo('<script>window.location="login.php"</script>');
}
?>
