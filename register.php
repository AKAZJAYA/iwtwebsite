
<?php

    include 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $mobilenumber = $_POST['mobilenumber'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $userType = "user";

    //database connection
    // $conn = new mysqli('localhost:3306','root','','onlinevaccinationportal');

    $query = "insert into ragistration(userName, password, fullName, birthday, gender, mobileNumber, address, NICNumber, userType) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("sssssisis",$username,$password,$fullname,$date,$gender,$mobilenumber,$address,$number,$userType);
    
    if($stmt->execute()){

        echo "<script>alert ('Thank you for registered. Now you can Login'); window.location='login.php';</script>.";
    }
    else{

        echo 'Unsuccessfull...';
    }
    


?>