<?php

include 'config.php';
$UID = $_COOKIE['UID'];

  $username = "";
  $email = "";

  $sql = "SELECT * FROM ragistration WHERE userName = '".$UID."'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $username =  $row["userName"];
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
    <div id="reply"></div>
  </div>

</div>

      <footer>
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
      </footer>

      


<?php

include 'config.php';
  $UID = $_COOKIE['UID'];

  $sql = "SELECT * FROM inquiries";
  $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $username =  $row["userName"];
      $refID = $row["referenceNumber"];
      $inquiry = $row["inquiry"];
      if($username == $UID){
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
            document.getElementById("reply").innerHTML =  "'.$inquiry.'";

          });
        </script>');
      }
    }
  }
?>

</body>
</html>

<?php 
include 'config.php';
  $UID = $_COOKIE['UID'];
  // echo($UID);
  if ($UID == null) {
   echo('<script>alert("You need to login first...."); window.location="login.php"</script>');
  }

if(isset($_POST['email']) AND isset($_POST['message'])){
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "insert into inquiries(userName, email, inquiry) values (?, ?, ?)";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("sss",$UID,$email,$message);

    if($stmt->execute()){

      echo "<script>alert ('Message sent successfully...'); window.location='contactUs.php';</script>.";
    }
    else{

        echo 'Unsuccessfull...';
    }
}
  

  



?>