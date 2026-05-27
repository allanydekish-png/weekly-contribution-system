<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM fines
        WHERE user_id='$user_id'
        ORDER BY id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>My Fines</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fb;
    font-family:Arial;
}

.container{
    margin-top:50px;
}

</style>

</head>
<body>

<div class="container">

    <h2 class="mb-4">
        My Fines
    </h2>

    <table class="table table-bordered bg-white">

        <tr>

            <th>Amount</th>
            <th>Reason</th>
            <th>Status</th>

        </tr>

        <?php while($row = $result->fetch_assoc()){ ?>

        <tr>

            <td>
                KES <?php echo $row['amount']; ?>
            </td>

            <td>
                <?php echo $row['reason']; ?>
            </td>

            <td>
                <?php echo $row['status']; ?>
            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>