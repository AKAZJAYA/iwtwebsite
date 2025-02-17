<?php 
// Include the 'config.php' file to establish a database connection
include 'config.php';

// Get the value of the 'UID' cookie
$UID = $_COOKIE['UID'];

// Check if 'UID' is null or not set
if ($UID == null) {
    // If 'UID' is not set, redirect to the 'login.php' page
    echo('<script>window.location="login.php"</script>');
}


  $AID = "no";
  $centre = "no";
  $vaccineType = "no";
  $date = "no";
  $time = "no";

  $sql = "SELECT * FROM appointment WHERE userName = '".$UID."'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      // echo "id: " . $row["center"]. " - Name: " . $row["vaccineType"]. " " . $row["date"]. " " . $row["time"]. "<br>";
      $AID = $row["appointmentID"];
      $centre = $row["center"];
      $vaccineType = $row["vaccineType"];
      $date = $row["date"];
      $time = $row["time"];
    }

  
  }else{
    echo('<script>alert("You have no appointments scheduled.."); window.location="userdboard.php"</script>');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Change Appointment - DoseGuardian</title>
    <link rel="stylesheet" href="styles/changeAppointment.css">
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
      <p class="header_username" id="header_username"><?php  echo($_COOKIE['UID']); ?></p>
      <img src="images/profileP-removebg-preview.png" alt="" id="profilephoto">
  </header>

  <section class="container">

    <label for="firsttxt" class="firsttxt">Current Appointment Details</label>
    <div class="summrycontainer">

      <div class="summery">

        <label class="appointmentID">Appointment ID: </label>
        <label for="" class="appointIDLabel"><?php echo($AID) ?></label><br><br>
        <label for="" class="dateandtime">Date :  </label>
        <label for="" class="dateLabel"><?php echo($date) ?></label><br><br>
        <label for="" class="dateandtime">Time:  </label>profilere
        <label for="" class="Label"><?php echo($time) ?></label><br><br>
        <label for="" class="vaccinationtype">Vaccination Type: </label>
        <label for="" class="vaccineTypeLabel"><?php echo($vaccineType) ?></label><br><br>
        <label for="" class="vaccinecenter">Vaccine Center: </label>
        <label for="" class="vaccinecenterLabel"><?php echo($centre) ?></label><br><br>
        <!-- <label for="" class="appointmentavailability">Appointment Availability: </label> -->
        <label for="" class="vaccinecenterLabel"></label><br><br>
      </div>
    </div>
    <form action="./changeAppointment.php" method="POST">
    <div class="changeappoint">

      <label for="secondtxt" class="secondtxt">Change Appointment Details</label>

      <label for="" class="changedate-Label">Change Date: </label>
      <div class="date-select">
        <input type="date" class="dateselect"  name="date">
      </div>

      <label for="" class="changetime-Label">Change Date: </label>
      <div class="time-select">
        <input type="time" class="timeselect"  name="time">
      </div>

      <label for="" class="change-vaccinecenter-Label">Change Vaccination Center: </label>
      <div class="center-select">

      <select name="vaccinecenter" class="vaccinecenter-select" required>
          <option class="center-option" value="center1" disabled>Select Center</option>
          <option class="center-option" value="Moratuwa">Moratuwa</option>
          <option class="center-option" value="Galle">Galle</option>
          <option class="center-option" value="Kandy">Kandy</option>
          <option class="center-option" value="Kurunegala">Kurunegala</option>
          <option class="center-option" value="Ratnapura">Ratnapura</option>
          <option class="center-option" value="Badulla">Badulla</option>
        </select>
      </div>

      <label for="" class="change-vaccine-type-Label">Change Vaccine Type: </label>
      <div class="vaccine-select">

      <select name="vaccinetype" class="vaccinetype-select" required>
          <option class="center-option" value="center1" disabled>Select Vaccine</option>
          <option class="vaccine-option" value="Sinopham">Sinopham</option>
          <option class="vaccine-option" value="Pfizer">Pfizer</option>
          <option class="vaccine-option" value="Sinovac">Sinovac</option>
          <option class="vaccine-option" value="Fluarix Quadrivalent">Fluarix Quadrivalent</option>
          <option class="vaccine-option" value="Rubella (MMR)">Rubella (MMR)</option>
          <option class="vaccine-option" value="Hepatitis B.">Hepatitis B.</option>
          <option class="vaccine-option" value="Poliomyelitis">Poliomyelitis</option>
        </select>
      </div>
    </div>

    <div class="change-appointment-btn">

      <input type="submit" value="Change" class="change-appointment-button" name="changeAppointment-btn">
    </div>

    <div class="delete-appontment-btn">

      <input type="submit" value="Cancel Appointment" class="delete-appointment-button" name="cancleAppointment" onclick="return confirm('Are you sure you want to delete your appointment ?');">
    </div>
    </form>

    <!-- <div class="cancel-appontment-btn">

      <a href="userdboard.php"><button type="button" value="Cancel Appointment" class="cancel-appointment-button">Cancel Appointment</button></a>
    </div> -->
  </section>


      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      


    

</body>
</html>

<?php 


if (isset($_POST['date']) AND isset($_POST['time']) AND isset($_POST['vaccinecenter']) AND isset($_POST['vaccinetype']) AND isset($_POST['changeAppointment-btn'])) {
  $date = $_POST['date'];
  $time = $_POST['time'];
  $vaccinecenter = $_POST['vaccinecenter'];
  $vaccinetype = $_POST['vaccinetype'];
 
  $sql = "UPDATE appointment SET center = '".$vaccinecenter."', vaccineType = '".$vaccinetype."', date = '".$date."', time = '".$time."' WHERE userName = '".$UID."'";
 if(mysqli_query($conn, $sql)){
   echo('Success');
   echo('<script>window.location="changeAppointment.php";
         alert("Your Appointment change has been successfully...");
   </script>');
 }else {
   echo('Failed');
 }
}

if(isset($_POST['cancleAppointment'])){

	$sql = "DELETE FROM appointment WHERE userName = '".$UID."'";
	$result = mysqli_query($conn, $sql);

	if($result){

		echo('<script>window.location="userdboard.php";
					alert("Your appointment canceled successfully...");
					
				</script>');
	}
}

?>