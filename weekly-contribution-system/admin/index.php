<?php
session_start();
include '../config.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $admin = $result->fetch_assoc();

        if(password_verify($password, $admin['password'])){

            $_SESSION['admin'] = $admin['username'];

            header("Location: dashboard.php");

        } else {
            echo "Wrong Password!";
        }

    } else {
        echo "Admin Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
    font-family:Arial;
}

.login-box{
    width:400px;
    margin:100px auto;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 2px 15px rgba(0,0,0,0.1);
}

</style>

</head>
<body>

<div class="login-box">

    <h2 class="mb-4 text-center">
        Admin Login
    </h2>

    <form method="POST">

        <input type="text"
               name="username"
               class="form-control mb-3"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               class="form-control mb-3"
               placeholder="Password"
               required>

        <button type="submit"
                name="login"
                class="btn btn-primary w-100">
            Login
        </button>

    </form>

</div>

</body>
</html>