<?php
// Include the 'config.php' file to establish a database connection
include 'config.php';

// Get the value of the 'UID' cookie
$UID = $_COOKIE['UID'];

// Check if 'UID' is not set
if ($UID == null) {
    // If 'UID' is not set, redirect to the 'login.php' page
    echo('<script>window.location="login.php"</script>');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Vaccination Information - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/vaccineInformation.css">
    <script defer src="./java/vaccineInformation.js"></script>
</head>
<body>
    <header class="header">
        <img id="logo" src="./images/250356a297.jpeg" alt="DoseGuardian Logo">
        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="./news.html">News</a>
            <a href="./about.html">About</a>
            <a href="./contactUs.php">Contact Us</a>
        </nav>
        
        <p class="header_username" id="header_username"><?php  echo($_COOKIE['UID']); ?></p>
      <img src="./images/profileP-removebg-preview.png" alt="" class="profilephoto">
    </header>



    <div class="content">
        <div class="vaccination-info">
            <h1 class="vaccination-title">Welcome to DoseGuardian Vaccination Portal</h1>

                <div class="vaccination-buttons">
                    <div class="vaccination-category">
                        <button class="vaccination-button" data-info="COVID-19 Vaccination">COVID-19 Vaccination</button>
                    </div>
                    <div class="vaccination-category">
                        <button class="vaccination-button" data-info="Routine Vaccinations">Routine Vaccinations</button>
                    </div>
                    <div class="vaccination-category">
                        <button class="vaccination-button" data-info="Influenza (Flu) Vaccination">Influenza Vaccination</button>
                    </div>
                    <div class="vaccination-category">
                        <button class="vaccination-button" data-info="Travel Vaccinations">Travel Vaccinations</button>
                    </div>
                    <div class="vaccination-category">
                        <button class="vaccination-button" data-info="Childhood Vaccination Schedules">Childhood Vaccination</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="vaccination-image">
            <img id="vaccination-image" src="" alt="Vaccination Image">
        </div>
        <div class="vaccination-details">
            <p class="vaccination-text"></p>
        </div>

    </div>
        

    <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
    </footer>
</body>
</html>


