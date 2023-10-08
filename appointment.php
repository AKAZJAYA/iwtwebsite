<!-- Appointment Scheduling Page -->

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
          <a href="">News</a>
          <a href="">About</a>
          <a href="">Contact Us</a>
      </nav>

      
  </header>
  

<!-- Write your code between header and footer -->
<section class="container">

    
    <div class="schedule-section">
    <form action="./appointment.php" method="POST">
        <!-- First dropdown for selecting a center -->
        <select class="option" name="vaccneCenter" required>
            <option selected disabled>Select a Center</option>
            <option value="">Moratuwa</option>
            <option value="">Galle</option>
            <option value="">Kandy</option>
            <option value="">Kurunegala</option>
            <option value="">Ratnapura</option>
            <option value="">Badulla</option>
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
        <input type="submit" id="btn" name="continueBtn" value="Continue">
        </form>
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
        <p class="footxt">DoseGuardian c 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      


    

</body>
</html>

<?php

    include 'config.php';

    $vaccneCenter = $_POST['vaccneCenter'];
    $vaccineType = $_POST['vaccineType'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    //database connection
    // $conn = new mysqli('localhost:3306','root','','onlinevaccinationportal');

    $sql = "insert into appointment(center, vaccineType, date, time) values (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssss",$vaccneCenter,$vaccineType,$date,$time);
    
    if($stmt->execute()){

        echo "<script>alert ('Appointment scheduled successfully...'); window.location='userdboard.php';</script>.";
    }
    else{

        echo 'Unsuccessfull...';
    }
    

?>