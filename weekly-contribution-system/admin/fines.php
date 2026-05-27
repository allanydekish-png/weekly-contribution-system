<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
}

$sql = "SELECT fines.*, users.fullname
        FROM fines
        JOIN users
        ON fines.user_id = users.id
        ORDER BY fines.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>Fines</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:Arial;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#031b4e;
    position:fixed;
    padding:20px;
    color:white;
}

.sidebar h2{
    margin-bottom:40px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px;
    border-radius:10px;
    margin-bottom:10px;
}

.sidebar a:hover{
    background:#2563eb;
}

.main{
    margin-left:250px;
    padding:30px;
}

.table-box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.badge-fine{
    background:#fee2e2;
    color:red;
    padding:6px 14px;
    border-radius:20px;
}

</style>

</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h2>Admin Panel</h2>

    <a href="dashboard.php">
        <i class="fa fa-home"></i>
        Dashboard
    </a>

    <a href="payments.php">
        <i class="fa fa-wallet"></i>
        Payments
    </a>

    <a href="fines.php" style="background:#2563eb;">
        <i class="fa fa-triangle-exclamation"></i>
        Fines
    </a>

    <a href="logout.php">
        <i class="fa fa-sign-out"></i>
        Logout
    </a>

</div>

<!-- MAIN -->

<div class="main">

    <h1 class="mb-4">
        All Fines
    </h1>

    <div class="table-box">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Member</th>
                    <th>Fine Amount</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Date</th>

                </tr>

            </thead>

            <tbody>

            <?php
            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()){
            ?>

                <tr>

                    <td>
                        <?php echo $row['id']; ?>
                    </td>

                    <td>
                        <?php echo $row['fullname']; ?>
                    </td>

                    <td>
                        KES <?php echo $row['amount']; ?>
                    </td>

                    <td>
                        <?php echo $row['reason']; ?>
                    </td>

                    <td>

                        <span class="badge-fine">

                            <?php echo $row['status']; ?>

                        </span>

                    </td>

                    <td>
                        <?php echo $row['created_at']; ?>
                    </td>

                </tr>

            <?php
                }
            } else {
            ?>

                <tr>

                    <td colspan="6" class="text-center">

                        No fines found

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>