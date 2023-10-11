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
    <link rel="stylesheet" href="./styles/adminUserDetails.css">
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

  <div class="UserInfoListDiv">
    <div class="UserInfoListUsers" id="UserInfoListUsers">
      <h3>Users</h3>
      <div id="UserInfoListUsersList"></div>
      <form action="./adminUserDetails.php" method="post">
        <table>
          <tr>
            <td>Username</td>
            <td><input type="text" id="usernameInput" name="usernameInput" disabled></td>
          </tr>
          <tr>
            <td>Full Name</td>
            <td><input type="text" id="fullNameInput" name="fullNameInput"></td>
          </tr>
          <tr>
            <td>Birthday</td>
            <td><input type="date" id="birthdayInput" name="birthdayInput"></td>
          </tr>
          <tr>
            <td>Mobile Number</td>
            <td><input type="tel" maxlength="10" id="mobileNumInput" name="mobileNumInput"></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><input type="text" id="addressInput" name="addressInput"></td>
          </tr>
          <tr>
            <td>NIC Number</td>
            <td><input type="number" id="NICNumberInput" name="NICNumberInput"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" id="submit-btn" name="submit-btn"></td>
          </tr>
        </table>
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
  $sql = "SELECT * FROM ragistration";
  $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $username =  $row["userName"];
      if($username != "admin"){
        // echo ($username."<br>");
        echo ('<script>
          var parent = document.getElementById("UserInfoListUsersList");
          var child = document.createElement("div");
          child.classList.add("nameTag");
          child.innerHTML = "'.$username.'";
          child.id = "nameTag"+"'.$username.'";
          var elementId = "'."nameTag".$username.'";
          parent.appendChild(child);
          child.addEventListener("click", function (){
            document.getElementById("usernameInput").value =  "'.$username.'";
            document.getElementById("fullNameInput").value =  "'.$row['fullName'].'";
            document.getElementById("birthdayInput").value =  "'.$row['birthday'].'";
            document.getElementById("mobileNumInput").value =  "'.$row['mobileNumber'].'";
            document.getElementById("addressInput").value =  "'.$row['address'].'";
            document.getElementById("NICNumberInput").value =  "'.$row['NICNumber'].'";
          });
        </script>');
      }
    }
  }
?>
</body>
</html>

<?php

if (isset($_POST['usernameInput']) AND isset($_POST['fullNameInput']) AND isset($_POST['birthdayInput']) AND isset($_POST['mobileNumInput']) AND isset($_POST['addressInput']) AND isset($_POST['NICNumberInput']) AND isset($_POST['submit-btn'])) {
  $usernameInput = $_POST['usernameInput'];
  $fullNameInput = $_POST['fullNameInput'];
  $birthdayInput = $_POST['birthdayInput'];
  $mobileNumInput = $_POST['mobileNumInput'];
  $addressInput = $_POST['addressInput'];
  $NICNumberInput = $_POST['NICNumberInput'];

  $sql = "UPDATE ragistration SET fullName = '".$fullNameInput."', birthday = '".$birthdayInput."', mobileNumber = '".$mobileNumInput."', address = '".$addressInput."', NICNumber = '".$NICNumberInput."' WHERE userName = '".$usernameInput."'";
  if(mysqli_query($conn, $sql)){
  echo('Success');
  echo('<script>window.location="adminUserDetails.php";
      alert("Your profile updated successfully...");
  </script>');
  }else {
  echo('Failed');
  }

}
?>

