<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

/*
FETCH ALL PAYMENTS
*/

$sql = "SELECT payments.*, users.fullname

        FROM payments

        JOIN users

        ON payments.user_id = users.id

        ORDER BY payments.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>All Payments</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f5f7fb;
    font-family:Arial;
}

/* SIDEBAR */

.sidebar{
    width:250px;
    height:100vh;
    background:#031b4e;
    position:fixed;
    top:0;
    left:0;
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
    transition:0.3s;
}

.sidebar a:hover{
    background:#2563eb;
}

.sidebar a i{
    margin-right:10px;
}

/* MAIN */

.main{
    margin-left:250px;
    padding:30px;
}

/* TABLE BOX */

.table-box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.table th{
    background:#031b4e;
    color:white;
}

.badge-paid{
    background:#dcfce7;
    color:#166534;
    padding:6px 14px;
    border-radius:20px;
}

.badge-unpaid{
    background:#fee2e2;
    color:#991b1b;
    padding:6px 14px;
    border-radius:20px;
}

.btn-delete{
    background:#dc2626;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
}

.btn-delete:hover{
    background:#b91c1c;
    color:white;
}

/* MOBILE */

@media(max-width:900px){

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
    }

    .main{
        margin-left:0;
    }

}

</style>

</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h2>
        Admin Panel
    </h2>

    <a href="dashboard.php">

        <i class="fa fa-home"></i>

        Dashboard

    </a>

    <a href="add-payment.php">

        <i class="fa fa-money-bill"></i>

        Add Payment

    </a>

    <a href="payments.php"
       style="background:#2563eb;">

        <i class="fa fa-wallet"></i>

        All Payments

    </a>

    <a href="fines.php">

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
        All Payments
    </h1>

    <div class="table-box">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Member</th>
                    <th>Amount</th>
                    <th>Week</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>

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
                        KES <?php echo number_format($row['amount']); ?>
                    </td>

                    <td>
                        Week <?php echo $row['week_number']; ?>
                    </td>

                    <td>
                        <?php echo $row['payment_method']; ?>
                    </td>

                    <td>

                        <?php
                        if($row['status'] == 'Paid'){
                        ?>

                            <span class="badge-paid">

                                Paid

                            </span>

                        <?php } else { ?>

                            <span class="badge-unpaid">

                                Unpaid

                            </span>

                        <?php } ?>

                    </td>

                    <td>
                        <?php echo $row['created_at']; ?>
                    </td>

                    <td>

                        <a href="delete-payment.php?id=<?php echo $row['id']; ?>"

                           class="btn-delete"

                           onclick="return confirm('Are you sure you want to delete this payment?')">

                            Delete

                        </a>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="8" class="text-center">

                        No payments found

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>