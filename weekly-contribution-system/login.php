<?php
session_start();
include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];

    /*
    ADMIN LOGIN
    */

    if($email == "admin" && $password == "password"){

        $_SESSION['admin'] = true;

        header("Location: admin/dashboard.php");

        exit();
    }

    /*
    USER LOGIN
    */

    $sql = "SELECT * FROM users
            WHERE email='$email'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if($password == $row['password']){

            $_SESSION['user_id'] = $row['id'];

            $_SESSION['fullname'] = $row['fullname'];

            $_SESSION['email'] = $row['email'];

            header("Location: dashboard.php");

            exit();

        } else {

            echo "

            <script>

            alert('Wrong Password');

            window.location='auth.php';

            </script>

            ";

        }

    } else {

        echo "

        <script>

        alert('Account Not Found');

        window.location='auth.php';

        </script>

        ";

    }

}
?>