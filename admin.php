<?php

    include 'config.php';
    $UID = $_COOKIE['UID'];

    if ($UID != "admin") {
        echo('<script>alert("You are not a admin.... Please go back..!!!");window.location="userdboard.php"</script>');
       }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Admin - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/admin.css">
    <script defer src="java/script.js"></script>

</head>
<body>

  <header class="header">
      <img class="logo" src="images/logo1.jpeg">
      <nav class="navbar">
          <a href="./admin.php">Home</a>
          
      </nav>

      <!-- <img src="profileP-removebg-preview.png" alt="" id="profilephoto"> -->
      <div class="logout-btn">
  <input type="button" id="logoutBtn" value="Logout">
</div>
  </header>
          <div class="detailAccess-section">
            
            <a href="./adminUserDetails.php"><button class="userDetails">User Details</button></a>
            <button class="AppointmentDetails">Appointment Details</button>
            <button class="Inquiries">Inquiries</button>
          </div>
          





      <footer>
        <p class="footxt">DoseGuardian c 2023 <a class="help" href="">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      <script>
        document.getElementById("logoutBtn").addEventListener('click', function (){
          document.cookie = 'UID' +'=username; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          window.location='userdboard.php';});
      </script>


    

</body>
</html>