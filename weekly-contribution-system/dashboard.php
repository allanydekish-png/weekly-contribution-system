<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];

/*
CURRENT WEEK
*/

$start_date = strtotime("2026-01-01");

$current_date = time();

$days = floor(
    ($current_date - $start_date)
    / (60 * 60 * 24)
);

$current_week = floor($days / 7) + 1;

if($current_week < 1){
    $current_week = 1;
}

/*
TOTAL CONTRIBUTIONS
*/

$total = 0;

$total_query = $conn->query(
    "SELECT SUM(amount) AS total
     FROM payments
     WHERE user_id='$user_id'
     AND status='Paid'"
);

if($total_query->num_rows > 0){

    $row = $total_query->fetch_assoc();

    $total = $row['total'] ?? 0;
}

/*
TOTAL FINES
*/

$fines = 0;

$fine_query = $conn->query(
    "SELECT SUM(amount) AS total_fine
     FROM fines
     WHERE user_id='$user_id'"
);

if($fine_query->num_rows > 0){

    $fine_row = $fine_query->fetch_assoc();

    $fines = $fine_row['total_fine'] ?? 0;
}

/*
TOTAL PAYMENTS
*/

$payments = 0;

$payment_query = $conn->query(
    "SELECT COUNT(*) AS total_payments
     FROM payments
     WHERE user_id='$user_id'"
);

if($payment_query->num_rows > 0){

    $pay_row = $payment_query->fetch_assoc();

    $payments = $pay_row['total_payments'];
}

/*
RECENT PAYMENTS
*/

$recent = $conn->query(
    "SELECT * FROM payments
     WHERE user_id='$user_id'
     ORDER BY id DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>User Dashboard</title>

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

.user-box{
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
        Contribution System
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
            <a href="my-contributions.php">

                <i class="fa fa-wallet"></i>

                My Contributions

            </a>
        </li>

        <li>
            <a href="paystack-pay.php">

                <i class="fa fa-money-bill"></i>

                Make Payment

            </a>
        </li>

        <li>
            <a href="payment-history.php">

                <i class="fa fa-clock-rotate-left"></i>

                Payment History

            </a>
        </li>

        <li>
            <a href="fine.php">

                <i class="fa fa-triangle-exclamation"></i>

                Fine

            </a>
        </li>

        <li>
            <a href="profile.php">

                <i class="fa fa-user"></i>

                Profile

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
            Welcome,
            <?php echo $fullname; ?>
        </h2>

        <div class="user-box">

            <i class="fa fa-user-circle"></i>

            Member Dashboard

        </div>

    </div>

    <!-- CARDS -->

    <div class="cards">

        <div class="card-box">

            <i class="fa fa-calendar-week blue"></i>

            <h5>
                Current Week
            </h5>

            <h2>
                Week <?php echo $current_week; ?>
            </h2>

        </div>

        <div class="card-box">

            <i class="fa fa-wallet green"></i>

            <h5>
                Total Contributions
            </h5>

            <h2>
                KES <?php echo number_format($total); ?>
            </h2>

        </div>

        <div class="card-box">

            <i class="fa fa-money-check blue"></i>

            <h5>
                Total Payments
            </h5>

            <h2>
                <?php echo $payments; ?>
            </h2>

        </div>

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

    <!-- CHARTS -->

    <div class="row mb-4">

        <!-- LINE CHART -->

        <div class="col-md-8">

            <div class="table-box">

                <h4 class="mb-4">
                    Contribution Analytics
                </h4>

                <canvas id="contributionChart"
                        height="100"></canvas>

            </div>

        </div>

        <!-- PIE CHART -->

        <div class="col-md-4">

            <div class="table-box">

                <h4 class="mb-4">
                    Payment Status
                </h4>

                <canvas id="paymentChart"></canvas>

            </div>

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
                    <th>Amount</th>
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
                        KES <?php echo $row['amount']; ?>
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

                    <td colspan="4"
                        class="text-center">

                        No payments found

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<!-- CHART JS -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/*
LINE CHART
*/

const contributionChart = document
.getElementById('contributionChart');

new Chart(contributionChart, {

    type: 'line',

    data: {

        labels: [
            'Week 1',
            'Week 2',
            'Week 3',
            'Week 4',
            'Week 5',
            'Week 6'
        ],

        datasets: [{

            label: 'Contributions',

            data: [
                250,
                500,
                750,
                1000,
                1250,
                1500
            ],

            borderWidth: 3,

            tension: 0.4

        }]

    },

    options: {

        responsive:true

    }

});

/*
PIE CHART
*/

const paymentChart = document
.getElementById('paymentChart');

new Chart(paymentChart, {

    type: 'doughnut',

    data: {

        labels: [
            'Contributions',
            'Fines'
        ],

        datasets: [{

            data: [
                <?php echo $total; ?>,
                <?php echo $fines; ?>
            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive:true

    }

});

</script>

</body>
</html>