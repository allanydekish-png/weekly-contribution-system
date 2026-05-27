<?php
session_start();
include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // CHECK IF USER EXISTS
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($check->num_rows > 0){

        echo "<script>
        alert('Email already exists');
        window.location='auth.php';
        </script>";

    } else {

        // INSERT USER
        $sql = "INSERT INTO users (fullname,email,password)
                VALUES ('$fullname','$email','$password')";

        if($conn->query($sql)){

            // AUTO LOGIN AFTER REGISTER
            $user_id = $conn->insert_id;

            $_SESSION['user_id'] = $user_id;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;

            // GO DIRECT TO DASHBOARD
            header("Location: dashboard.php");
            exit();

        } else {

            echo "<script>
            alert('Registration failed (Fatal Error fixed check DB)');
            window.location='auth.php';
            </script>";
        }
    }
}
?>