<?php
// Include the 'config.php' file to establish a database connection
include 'config.php';

// Get the value of the 'UID' cookie
$UID = $_COOKIE['UID'];

// Initialize 'username' and 'email' variables
$username = "";
$email = "";

// Construct an SQL query to select user information from the 'ragistration' table where 'userName' matches the 'UID'
$sql = "SELECT * FROM ragistration WHERE userName = '".$UID."'";

// Execute the SQL query using the 'mysqli_query' function
$result = mysqli_query($conn, $sql);

// Check if there are any rows in the result set
if (mysqli_num_rows($result) > 0) {
    // Iterate through each row of the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract 'userName' and 'email' from the current row
        $username = $row["userName"];
        $email = $row['email'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Contact Us - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/contactUs.css">
    <script defer src="java/script.js"></script>

</head>
<body>

  <header class="header">
      <img class="logo" src="./images/250356a297.jpeg">
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
    <form action="contactUs.php" method="post">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" value="<?php  echo($username); ?>" disabled>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" value="<?php  echo($email); ?>">

        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea>

        <input type="submit" value="Send" name="submit">
    </form>
</div>

<div class="replaysection">
  <div class="replysectList">

    <h3>Inquiries</h3>
    <div id="inquiryList"></div>
    <div id="inquiry"></div><br><br><br><br><br><br>
    <h3 id="replyHeader">Reply</h3>
    <div id="replyByAdmin"></div>
  </div>

</div>

      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      


<?php

include 'config.php';
  $UID = $_COOKIE['UID'];

  $sql = "SELECT * FROM inquiries WHERE userName = '".$UID."' ORDER BY referenceNumber DESC";
  $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $username =  $row["userName"];
      $refID = $row["referenceNumber"];
      $inquiry = $row["inquiry"];
      $reply = $row["reply"];
      $status = $row["Status"];
      if($status == 'pending'){
      // echo ($username."<br>");
      echo ('<script>
        var parent = document.getElementById("inquiryList");
        var child = document.createElement("div");
        child.classList.add("nameTag");
        child.innerHTML = "'.$refID.'";
        child.id = "nameTag"+"'.$refID.'";
        var elementId = "'."nameTag".$refID.'";
        parent.appendChild(child);
        child.addEventListener("click", function (){
          document.getElementById("inquiry").innerHTML =  "'.$inquiry.'";
          document.getElementById("replyByAdmin").innerHTML =  "'.$reply.'";

        });
      </script>');
      }
      else{
        echo ('<script>
        var parent = document.getElementById("inquiryList");
        var child = document.createElement("div");
        child.classList.add("nameTag");
        child.innerHTML = "'.$refID.'";
        child.id = "nameTag"+"'.$refID.'";
        child.style.backgroundColor = "green";
        var elementId = "'."nameTag".$refID.'";
        parent.appendChild(child);
        child.addEventListener("click", function (){
          document.getElementById("inquiry").innerHTML =  "'.$inquiry.'";
          document.getElementById("replyByAdmin").innerHTML =  "'.$reply.'";

        });
      </script>');
      }
    }
  }
?>

</body>
</html>

<?php
// Include the 'config.php' file to establish a database connection
include 'config.php';

// Get the value of the 'UID' cookie
$UID = $_COOKIE['UID'];

// Check if 'UID' is not set
if ($UID == null) {
    // If not logged in, display an alert message and redirect to 'login.php'
    echo('<script>alert("You need to login first...."); window.location="login.php"</script>');
}

// Check if the 'email' and 'message' parameters are set in the POST data
if (isset($_POST['email']) && isset($_POST['message'])) {
    // Get values from the POST data
    $email = $_POST['email'];
    $message = $_POST['message'];
    $status = "pending";

    // Prepare an SQL query to insert an inquiry into the 'inquiries' table
    $query = "INSERT INTO inquiries (userName, email, inquiry, Status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Bind the parameters to the prepared statement
    $stmt->bind_param("ssss", $UID, $email, $message, $status);

    // Execute the prepared statement and check if it's successful
    if ($stmt->execute()) {
        // If successful, display a success message and redirect to 'contactUs.php'
        echo "<script>alert ('Message sent successfully...'); window.location='contactUs.php';</script>.";
    } else {
        // If execution is unsuccessful, display an error message
        echo 'Unsuccessful...';
    }
}
?>
