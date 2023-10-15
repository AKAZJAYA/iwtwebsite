<?php
// Include the 'config.php' file to establish a database connection
include 'config.php';

// Get values from the POST data
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$date = $_POST['date'];
$mobilenumber = $_POST['mobilenumber'];
$address = $_POST['address'];
$number = $_POST['number'];
$userType = "user"; // Set the user type to "user"

// Prepare an SQL query to insert data into the 'ragistration' table
$query = "INSERT INTO ragistration (userName, password, fullName, birthday, gender, mobileNumber, address, NICNumber, userType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare a statement with the query
$stmt = $conn->prepare($query);

// Bind the parameters to the prepared statement
$stmt->bind_param("sssssisis", $username, $password, $fullname, $date, $gender, $mobilenumber, $address, $number, $userType);

// Execute the prepared statement and check if it's successful
if ($stmt->execute()) {
    // If successful, show a success message and redirect to the login page
    echo "<script>alert ('Thank you for registered. Now you can Login'); window.location='login.php';</script>.";
} else {
    // If execution is unsuccessful, show an error message
    echo 'Unsuccessful...';
}
?>
