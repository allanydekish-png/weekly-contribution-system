<?php
session_start();

$username = $_SESSION['fullname'] ?? 'No Name';
$email = $_SESSION['email'] ?? 'No Email';
?>

<!DOCTYPE html>
<html>
<head>

<title>Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:Arial;
}

.profile-box{
    width:500px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

</style>

</head>
<body>

<div class="profile-box">

    <h2 class="mb-4">
        My Profile
    </h2>

    <p>

        <strong>Name:</strong>

        <?php echo $username; ?>

    </p>

    <p>

        <strong>Email:</strong>

        <?php echo $email; ?>

    </p>

</div>

</body>
</html>