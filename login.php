<?php

    include 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from ragistration where userName = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("s",$username);
    $stmt->execute();

    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0){

        $data = $stmt_result->fetch_assoc();
        if($data['password'] === $password){

            echo "<script>alert ('Login Successfully....'); window.location='userdboard.html';</script>";
        }
        else{

            echo "<script>alert ('Invalid Email or Password..<br>Enter again...'); window.location='login.html';</script>";
        }
    }
    else{

        echo "<script>alert ('Invalid Email or Password..<br>Enter again...'); window.location='login.html';</script>";
    }
?>