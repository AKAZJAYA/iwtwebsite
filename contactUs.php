<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Contact Us - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/contactUs.css">
    <script defer src="java/script.js"></script>

</head>
<body>

  <header class="header">
      <img class="logo" src="images/logo1.jpeg">
      <nav class="navbar">
          <a href="index.html">Home</a>
          <a href="./news.html">News</a>
          <a href="./about.html">About</a>
          <a href="./contactUs.php">Contact Us</a>
      </nav>
      <p class="header_username" id="header_username"><?php  echo($_COOKIE['UID']); ?></p>
      <img src="./images/profileP-removebg-preview.png" alt="" id="profilephoto">
  </header>

  <div class="contact-form">
    <h2>Contact Us</h2>
    <form action="submit_form.php" method="post">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" value="Submit">
    </form>
</div>

      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      


    

</body>
</html>

<?php 
include 'config.php';
  $UID = $_COOKIE['UID'];
  // echo($UID);
  if ($UID == null) {
   echo('<script>alert("You need to login first...."); window.location="login.php"</script>');
  }

?>