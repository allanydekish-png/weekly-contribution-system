<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

/*
TOTAL MEMBERS
*/

$members = 0;

$member_query = $conn->query(
    "SELECT COUNT(*) AS total_members
     FROM users"
);

if($member_query->num_rows > 0){

    $member_row = $member_query->fetch_assoc();

    $members = $member_row['total_members'];
}

/*
TOTAL PAYMENTS
*/

$payments = 0;

$payment_query = $conn->query(
    "SELECT COUNT(*) AS total_payments
     FROM payments"
);

if($payment_query->num_rows > 0){

    $pay_row = $payment_query->fetch_assoc();

    $payments = $pay_row['total_payments'];
}

/*
TOTAL MONEY
*/

$money = 0;

$money_query = $conn->query(
    "SELECT SUM(amount) AS total_money
     FROM payments
     WHERE status='Paid'"
);

if($money_query->num_rows > 0){

    $money_row = $money_query->fetch_assoc();

    $money = $money_row['total_money'] ?? 0;
}

/*
TOTAL FINES
*/

$fines = 0;

$fine_query = $conn->query(
    "SELECT SUM(amount) AS total_fines
     FROM fines"
);

if($fine_query->num_rows > 0){

    $fine_row = $fine_query->fetch_assoc();

    $fines = $fine_row['total_fines'] ?? 0;
}

/*
RECENT PAYMENTS
*/

$recent = $conn->query(
    "SELECT payments.*, users.fullname

     FROM payments

     JOIN users

     ON payments.user_id = users.id

     ORDER BY payments.id DESC

     LIMIT 5"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

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
    width:260px;
    height:100vh;
    background:#031b4e;
    position:fixed;
    left:0;
    top:0;
    padding:25px;
    color:white;
}

.logo{
    font-size:28px;
    font-weight:bold;
    margin-bottom:40px;
}

.sidebar ul{
    list-style:none;
    padding:0;
}

.sidebar ul li{
    margin-bottom:15px;
}

.sidebar ul li a{
    display:block;
    text-decoration:none;
    color:white;
    padding:14px 18px;
    border-radius:12px;
    transition:0.3s;
    font-size:16px;
}

.sidebar ul li a:hover{
    background:#2563eb;
}

.sidebar ul li a i{
    margin-right:10px;
}

/* MAIN */

.main{
    margin-left:260px;
    padding:30px;
}

/* TOPBAR */

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.topbar h2{
    color:#031b4e;
    font-weight:bold;
}

.admin-box{
    background:white;
    padding:10px 20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* CARDS */

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card-box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.card-box h5{
    color:#666;
    margin-bottom:15px;
}

.card-box h2{
    color:#031b4e;
    font-weight:bold;
}

.card-box i{
    font-size:40px;
    margin-bottom:15px;
}

.green{
    color:#16a34a;
}

.blue{
    color:#2563eb;
}

.red{
    color:#dc2626;
}

.orange{
    color:#ea580c;
}

/* TABLE */

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

    <div class="logo">
        Admin Panel
    </div>

    <ul>

        <li>
            <a href="dashboard.php"
               style="background:#2563eb;">

                <i class="fa fa-home"></i>

                Dashboard

            </a>
        </li>

        <li>
            <a href="members.php">

                <i class="fa fa-users"></i>

                Members

            </a>
        </li>

        <li>
            <a href="payments.php">

                <i class="fa fa-wallet"></i>

                Payments

            </a>
        </li>

        <li>
            <a href="add-payment.php">

                <i class="fa fa-money-bill"></i>

                Add Cash Payment

            </a>
        </li>

        <li>
            <a href="fines.php">

                <i class="fa fa-triangle-exclamation"></i>

                Fines

            </a>
        </li>

        <li>
            <a href="logout.php">

                <i class="fa fa-sign-out"></i>

                Logout

            </a>
        </li>

    </ul>

</div>

<!-- MAIN -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <h2>
            Welcome Admin
        </h2>

        <div class="admin-box">

            <i class="fa fa-user-shield"></i>

            Administrator

        </div>

    </div>

    <!-- CARDS -->

    <div class="cards">

        <!-- MEMBERS -->

        <div class="card-box">

            <i class="fa fa-users blue"></i>

            <h5>
                Total Members
            </h5>

            <h2>
                <?php echo $members; ?>
            </h2>

        </div>

        <!-- PAYMENTS -->

        <div class="card-box">

            <i class="fa fa-wallet green"></i>

            <h5>
                Total Payments
            </h5>

            <h2>
                <?php echo $payments; ?>
            </h2>

        </div>

        <!-- MONEY -->

        <div class="card-box">

            <i class="fa fa-money-bill-wave orange"></i>

            <h5>
                Total Money
            </h5>

            <h2>
                KES <?php echo number_format($money); ?>
            </h2>

        </div>

        <!-- FINES -->

        <div class="card-box">

            <i class="fa fa-triangle-exclamation red"></i>

            <h5>
                Total Fines
            </h5>

            <h2>
                KES <?php echo number_format($fines); ?>
            </h2>

        </div>

    </div>

    <!-- RECENT PAYMENTS -->

    <div class="table-box">

        <h4 class="mb-4">
            Recent Payments
        </h4>

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Member</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Date</th>

                </tr>

            </thead>

            <tbody>

            <?php

            if($recent->num_rows > 0){

                while($row = $recent->fetch_assoc()){

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

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="6"
                        class="text-center">

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