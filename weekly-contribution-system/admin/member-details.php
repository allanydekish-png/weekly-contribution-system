<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit();
}

if(!isset($_GET['id'])){
    die("Member not found");
}

$user_id = $_GET['id'];

/*
MEMBER INFO
*/

$user_query = $conn->query(
    "SELECT * FROM users
     WHERE id='$user_id'"
);

$user = $user_query->fetch_assoc();

/*
TOTAL CONTRIBUTIONS
*/

$total_contributions = 0;

$contribution_query = $conn->query(
    "SELECT SUM(amount) AS total
     FROM payments
     WHERE user_id='$user_id'
     AND status='Paid'"
);

if($contribution_query->num_rows > 0){

    $row = $contribution_query->fetch_assoc();

    $total_contributions = $row['total'] ?? 0;
}

/*
TOTAL FINES
*/

$total_fines = 0;

$fine_query = $conn->query(
    "SELECT SUM(amount) AS total
     FROM fines
     WHERE user_id='$user_id'"
);

if($fine_query->num_rows > 0){

    $fine_row = $fine_query->fetch_assoc();

    $total_fines = $fine_row['total'] ?? 0;
}

/*
TOTAL WEEKS PAID
*/

$weeks_paid = 0;

$week_query = $conn->query(
    "SELECT COUNT(*) AS total
     FROM payments
     WHERE user_id='$user_id'
     AND status='Paid'"
);

if($week_query->num_rows > 0){

    $week_row = $week_query->fetch_assoc();

    $weeks_paid = $week_row['total'];
}

/*
RECENT PAYMENTS
*/

$recent = $conn->query(
    "SELECT * FROM payments
     WHERE user_id='$user_id'
     ORDER BY id DESC
     LIMIT 10"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Member Performance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:Arial;
}

.container-box{
    width:95%;
    margin:30px auto;
}

.card-box{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.stat-card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.stat-card h5{
    color:#666;
}

.stat-card h2{
    color:#031b4e;
    margin-top:10px;
}

.table th{
    background:#031b4e;
    color:white;
}

.badge-paid{
    background:#dcfce7;
    color:#166534;
    padding:6px 12px;
    border-radius:20px;
}

.badge-unpaid{
    background:#fee2e2;
    color:#991b1b;
    padding:6px 12px;
    border-radius:20px;
}

</style>

</head>
<body>

<div class="container-box">

    <!-- MEMBER INFO -->

    <div class="card-box">

        <h2>
            <?php echo $user['fullname']; ?>
        </h2>

        <p>
            <?php echo $user['email']; ?>
        </p>

    </div>

    <!-- STATS -->

    <div class="stats">

        <div class="stat-card">

            <h5>
                Total Contributions
            </h5>

            <h2>
                KES <?php echo number_format($total_contributions); ?>
            </h2>

        </div>

        <div class="stat-card">

            <h5>
                Total Fines
            </h5>

            <h2>
                KES <?php echo number_format($total_fines); ?>
            </h2>

        </div>

        <div class="stat-card">

            <h5>
                Weeks Paid
            </h5>

            <h2>
                <?php echo $weeks_paid; ?>
            </h2>

        </div>

    </div>

    <!-- RECENT PAYMENTS -->

    <div class="card-box mt-4">

        <h3 class="mb-4">
            Recent Payments
        </h3>

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

                while($payment = $recent->fetch_assoc()){

            ?>

                <tr>

                    <td>
                        <?php echo $payment['id']; ?>
                    </td>

                    <td>
                        KES <?php echo $payment['amount']; ?>
                    </td>

                    <td>

                    <?php
                    if($payment['status'] == 'Paid'){
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
                        <?php echo $payment['created_at']; ?>
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

</body>
</html>