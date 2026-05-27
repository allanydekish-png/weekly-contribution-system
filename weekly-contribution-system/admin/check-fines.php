<?php

include '../config.php';

$today = date("Y-m-d");

/*
Find overdue payments
*/

$sql = "SELECT * FROM payments
        WHERE due_date < '$today'
        AND status = 'Unpaid'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

    $payment_id = $row['id'];
    $user_id = $row['user_id'];

    /*
    Check if fine already exists
    */

    $check = $conn->query(
        "SELECT * FROM fines
         WHERE payment_id='$payment_id'"
    );

    if($check->num_rows == 0){

        /*
        Insert fine
        */

        $conn->query(

            "INSERT INTO fines
            (user_id,payment_id,amount,reason)

            VALUES

            ('$user_id',
             '$payment_id',
             '50',
             'Late weekly contribution')"

        );

    }

}

echo "Fine check completed.";

?>