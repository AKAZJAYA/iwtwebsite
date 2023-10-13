<?php

    include 'config.php';
    $UID = $_COOKIE['UID'];

    if ($UID != "admin") {
        echo('<script>alert("You are not a admin....Please go back...");window.location="userdboard.php"</script>');
       }

    $username = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Admin User Details - DoseGuardian</title>
    <link rel="stylesheet" href="./styles/adminAppointmentDetails.css">
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

  <div class="AppointmentInfoListDiv">
    <div class="AppointmentInfoListAppointment" id="AppointmentInfoListAppointment">
      <h3>Appointments</h3>
      <div id="AppointmentInfoListUsersList"></div>
      <form action="./adminAppointmentDetails.php" method="POST">
        <table>
          <tr>
            <td>Username</td>
            <td><input style="display: none;" type="text" id="usernameInput" name="usernameInput">
                <input type="text" id="usernameInputDisplay" disabled>
          </td>
          </tr>
          <tr>
            <td>Center</td>
            <td><select class="option" name="centerInput" id="centerInput" required>
            <option selected disabled>Select a Center</option>
            <option>Moratuwa</option>
            <option>Galle</option>
            <option>Kandy</option>
            <option>Kurunegala</option>
            <option>Ratnapura</option>
            <option>Badulla</option>
        </select></td>
          </tr>
          <tr>
            <td>Vaccine</td>
            <td><select class="option" name="vaccineTypeInput" id="vaccineTypeInput">
            <option selected disabled>Select a Vaccine</option>
            <option>Sinopham</option>
            <option>Pfizer</option>
            <option>Sinovac</option>
            <option>Fluarix Quadrivalent</option>
            <option>Rubella (MMR)</option>
            <option>Hepatitis B.</option>
            <option>Poliomyelitis</option>
        </select></td>
          </tr>
          <tr>
            <td>Date</td>
            <td><input type="tel" maxlength="10" id="dateInput" name="dateInput"></td>
          </tr>
          <tr>
            <td>Times</td>
            <td><input type="text" id="timeInput" name="timeInput"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" id="submit-btn" name="submit-btn"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" id="delete-btn" name="delete-btn" value="Delete"></td>
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
  $sql = "SELECT * FROM appointment";
  $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $username =  $row["userName"];
      if($username != "admin"){
        // echo ($username."<br>");
        echo ('<script>
          var parent = document.getElementById("AppointmentInfoListUsersList");
          var child = document.createElement("div");
          child.classList.add("nameTag");
          child.innerHTML = "'.$username.'";
          child.id = "nameTag"+"'.$username.'";
          var elementId = "'."nameTag".$username.'";
          parent.appendChild(child);
          child.addEventListener("click", function (){
            document.getElementById("usernameInput").value =  "'.$username.'";
            document.getElementById("usernameInputDisplay").value =  "'.$username.'";
            document.getElementById("centerInput").value =  "'.$row['center'].'";
            document.getElementById("vaccineTypeInput").value =  "'.$row['vaccineType'].'";
            document.getElementById("dateInput").value =  "'.$row['date'].'";
            document.getElementById("timeInput").value =  "'.$row['time'].'";
          });
        </script>');
      }
    }
  }
?>
</body>
</html>

<?php

if (isset($_POST['usernameInput']) AND isset($_POST['centerInput']) AND isset($_POST['vaccineTypeInput']) AND isset($_POST['dateInput']) AND isset($_POST['timeInput']) AND isset($_POST['submit-btn'])) {
  $usernameInput = $_POST['usernameInput'];
  $centerInput = $_POST['centerInput'];
  $vaccineTypeInput = $_POST['vaccineTypeInput'];
  $dateInput = $_POST['dateInput'];
  $timeInput = $_POST['timeInput'];

  // echo('<script>alert("good")</script>');

  $sql = "UPDATE appointment SET center = '".$centerInput."', vaccineType = '".$vaccineTypeInput."', date = '".$dateInput."', time = '".$timeInput."' WHERE userName = '".$usernameInput."'";
  if(mysqli_query($conn, $sql)){
  echo('Success');
  echo('<script>window.location="adminAppointmentDetails.php";
      alert("Your profile updated successfully...");
  </script>');
  }else {
  echo('<script>window.location="adminAppointmentDetails.php";
  alert("Failed...");
</script>');
  }

}

if(isset($_POST['usernameInput']) AND isset($_POST['delete-btn'])){

  $usernameInput = $_POST['usernameInput'];

  $sql = "DELETE FROM appointment WHERE userName = '".$usernameInput."'";
	$result = mysqli_query($conn, $sql);

	if($result){

		echo('<script>window.location="adminAppointmentDetails.php";
					alert("Appointment deleted successfully...");
				</script>');
	}
}
?>

