<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Define the document's character set and compatibility -->
    <title>Login - DoseGuardian</title>
    <!-- Set the page title and link to an external stylesheet -->
    <link rel="stylesheet" href="styles/loginStyles.css">
    <!-- Link to the stylesheet for login page -->
    <script defer src="java/login.js"></script>
</head>

<body>

    <!-- Header Section -->
    <header class="header">
        <!-- Logo and Navigation Bar -->
        <img id="logo" src="./images/250356a297.jpeg">
        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="./news.html">News</a>
            <a href="./about.html">About</a>
            <a href="./contactUs.php">Contact Us</a>
        </nav>
  
        <!-- Register Button -->
        <!-- <button type="button" id="register">Register</button> -->
    </header>
    <form action="login.php" method="post">
    <!-- Login Form Container -->
    <div class="container">
        <!-- Design Elements -->
        <div class="design">
            <div class="pill-1 rotate-45"></div>
            <div class="pill-2 rotate-45"></div>
            <div class="pill-3 rotate-45"></div>
            <div class="pill-4 rotate-45"></div>
        </div>
        <!-- Login Form -->
        <div class="login">
            <!-- Login Title -->
            <h3 class="title">User Login</h3>
            <!-- Username Input -->
            <div class="text-input">
                <i class="ri-user-fill"></i>
                <input type="text" placeholder="Username" required name="username">
            </div>
            <!-- Password Input -->
            <div class="text-input">
                <i class="ri-lock-fill"></i>
                <input type="password" placeholder="Password" required name="password">
            </div>
            <!-- Login Button -->
            <button type="submit" class="login-btn">LOGIN</button>
            <!-- Link to Registration -->
            <a href="#" class="haveAcc">Don't you have an account?</a>
            <!-- Register Button -->
            <button type="button" id="reg-btn">REGISTER</button>
            <!-- Create Account Section -->
            <div class="create">
                <!-- Arrow Icon -->
                <i class="ri-arrow-right-fill"></i>
            </div>
        </div>
    </form>
    </div>

    <!-- Footer Section -->
    <footer>
        <!-- Copyright and Help Link -->
        <p class="footxt">DoseGuardian © 2023 <a class="help" href="./faq.html">Help and Support</a><br>The Vaccination Management System</p>
    </footer>
</body>

</html>


<?php
// Check if a cookie named 'UID' is set
if(isset($_COOKIE['UID'])) {
    // If the cookie is set, redirect to 'userdboard.php'
    echo('<script>window.location="userdboard.php"</script>');
}

// Check if any POST data has been submitted
if (count($_POST) > 0) {
    // Include the 'config.php' file
    include 'config.php';

    // Get the 'username' and 'password' from the POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL query to select a user from the 'ragistration' table where 'userName' matches the given username
    $query = "select * from ragistration where userName = ?";
    $stmt = $conn->prepare($query);

    // Bind the 'username' parameter to the prepared statement
    $stmt->bind_param("s",$username);
    // Execute the prepared statement
    $stmt->execute();

    // Get the result of the executed statement
    $stmt_result = $stmt->get_result();

    // Check if there are any rows in the result
    if($stmt_result->num_rows > 0){

        // Fetch the data for the first row
        $data = $stmt_result->fetch_assoc();

        // Check if the retrieved password matches the submitted password
        if($data['password'] === $password){
            // Set a cookie named 'UID' with the 'username' value, valid for 24 hours (86400 seconds)
            setcookie('UID', $username, time() + (86400), "/");
            
            // Check if the user is not an admin, and if so, show a success message and redirect to 'userdboard.php'
            if($username != "admin"){
                echo "<script>alert ('Login Successfully....'); window.location='userdboard.php';</script>";
            }
            // If the user is an admin, show a different success message and redirect to 'admin.php'
            else{
                echo "<script>alert ('Logged as an Admin....'); window.location='admin.php';</script>";
            }
        }
        else{
            // If the password doesn't match, show an error message and redirect to 'login.php'
            echo "<script>alert ('Invalid Email or Password..<br>Enter again...'); window.location='login.php';</script>";
        }
    }
    else{
        // If no matching user is found, show an error message and redirect to 'login.php'
        echo "<script>alert ('Invalid Email or Password..<br>Enter again...'); window.location='login.php';</script>";
    }
}
?>
