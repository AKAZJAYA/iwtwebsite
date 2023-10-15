<?php
// Define database connection parameters
$servername = "localhost";  // Server name
$username = "root";         // MySQL username
$password = "";             // MySQL password (if any)
$dbname = "onlinevaccinationportal";  // Database name

// Create a new MySQLi (MySQL Improved) connection using the above parameters
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection to the database was successful
if ($conn->connect_error) {
    // If the connection failed, display an error message
    die("Connection failed: " . $conn->connect_error);
} else {
    // If the connection was successful, display a success message
    echo "Success...";
}
?>
