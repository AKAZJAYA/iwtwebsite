<?php

    include 'config.php';
    $UID = $_COOKIE['UID'];

    if ($UID != "admin") {
        echo('<script>alert("You are not a admin.... Get the fuck outter here");window.location="userdboard.php"</script>');
       }

    $username = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Admin User Details - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/adminInquiryDetails.css">
    <script defer src="java/script.js"></script>

</head>
<body>

  <header class="header">
      <img class="logo" src="images/logo1.jpeg">
      <nav class="navbar">
          <a href="./admin.php">Home</a>
          
      </nav>

      <!-- <img src="profileP-removebg-preview.png" alt="" id="profilephoto"> -->
  </header>

  <!-- <div class="replaysection">
  <div class="replysectList">

    <h3>Inquiries</h3>
    <div id="inquiryList"></div>
    <div id="reply"></div>
  </div> -->

  <div class="replydiv">

       <div class="inquiryDivList">

       <h3>Inquiries</h3>
       <div id="inquiryList"></div>
       <div id="inquiry"></div>
       <form action="adminInquiryReply.php" method="POST">

        <input type="text" name="adminReply" id="adminReply" class="adminReply">
        <input type="submit" name="submit-btn" id="submit-btn" class="submit-btn" value="Send">
       </form>
       </div>
  </div>

  <footer>
    <p class="footxt">DoseGuardian c 2023 <a class="help" href="">Help and Support</a><br>The Vaccination Management System</p>
  </footer>

  <script>
    // document.addEventListener("click", ()=>{
    //   document.getElementById('userNameInput').innerHTML = 
    // });
  </script>

<?php
  $sql = "SELECT * FROM inquiries";
  $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $username =  $row["userName"];
      $refID = $row["referenceNumber"];
      $inquiry = $row["inquiry"];
      $status2 = $row["Status"];
      if($username != "admin"){
        if($status2 == "pending"){
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
          });
        </script>');
        }
      }
    }
  }
?>
</body>
</html>

<?php
    include 'config.php';

  if(isset($_POST['adminReply'])){

    $adminReply = $_POST['adminReply'];
    $Status = "Replyed";

    $query = "UPDATE inquiries SET reply = '".$adminReply."', Status = '".$Status."' WHERE referenceNumber = '".$refID."'";
    if(mysqli_query($conn, $query)){
        echo('Success');
        echo('<script>window.location="adminInquiryReply.php";
                alert("Reply sent successfully...");
        </script>');
        }else {
        echo('Failed');
        }
    }
?>

