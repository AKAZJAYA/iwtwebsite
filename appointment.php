<!-- Appointment Scheduling Page -->

<?php

include 'config.php';

    $UID = $_COOKIE['UID'];

$sql = "SELECT * FROM appointment WHERE userName = '".$UID."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo('<script>alert("You already have an appointment scheduled.."); window.location="userdboard.php"</script>');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Schedule a Apoointment - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/appointment.css">
    <script defer src="./java/appointment.js"></script>

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
<section class="container">

    
    <div class="schedule-section">
    <form action="./appointment.php" method="POST">
        <!-- First dropdown for selecting a center -->
        <select class="option" name="vaccneCenter" required>
            <option selected disabled>Select a Center</option>
            <option>Moratuwa</option>
            <option>Galle</option>
            <option>Kandy</option>
            <option>Kurunegala</option>
            <option>Ratnapura</option>
            <option>Badulla</option>
        </select>
        <br><br><br>

        <!-- Second dropdown for selecting a vaccine -->
        <select class="option" name="vaccineType">
            <option selected disabled>Select a Vaccine</option>
            <option>Sinopham</option>
            <option>Pfizer</option>
            <option>Sinovac</option>
            <option>Fluarix Quadrivalent</option>
            <option>Rubella (MMR)</option>
            <option>Hepatitis B.</option>
            <option>Poliomyelitis</option>
        </select>
        <br><br><br>

        <input type="date" name="date" class="option"><br><br><br>

        <input type="time" name="time" class="option">

        <!-- Continue button -->
        <input type="submit" id="btn" name="continueBtn" value="Confirm">
        </form>

        <a href="./userdboard.php"><input type="button" class="btn-cancel" name="cancel" value="Cancel"></a>
    </div>

    <!-- Allow Notifications button -->
    <div class="notify-section">
        <button id="Notifications">Allow Notifications</button>
    </div>
    <br><br>

    <!-- Medical Support button -->
    <div class="support-section">
        <button id="support">Medical Support</button>
    </div>

    <!-- Calendar section -->
    <div class="calsection">
        <div class="calendar">
            <!-- Month displayed in the calendar -->
            <div class="month">October 2023</div>

            <!-- Table for displaying the calendar -->
            <table class="calendar-table">
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Calendar days will be generated here using JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

</section>

    <!---Java script part
    <script src="script.js"></script>   -->


       
      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      


    

</body>
</html>

<?php

    include 'config.php';

    $UID = $_COOKIE['UID'];

    if (isset($_POST['vaccneCenter']) AND isset($_POST['vaccineType']) AND isset($_POST['date']) AND isset($_POST['time'])) {
        $vaccneCenter = $_POST['vaccneCenter'];
        $vaccineType = $_POST['vaccineType'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        //database connection
        // $conn = new mysqli('localhost:3306','root','','onlinevaccinationportal');

        $sql = "insert into appointment(userName, center, vaccineType, date, time) values (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssss",$UID, $vaccneCenter,$vaccineType,$date,$time);
        
        if($stmt->execute()){

            echo "<script>alert ('Appointment scheduled successfully...'); window.location='userdboard.php';</script>.";
        }
        else{

            echo 'Unsuccessfull...';
        }
    
    }

    

?>