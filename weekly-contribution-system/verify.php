<?php

session_start();
include 'config.php';

$reference = $_GET['reference'];

$secretKey = "YOUR_SECRET_KEY";

$url = "https://api.paystack.co/transaction/verify/" . $reference;

$curl = curl_init();

curl_setopt_array($curl, array(

    CURLOPT_URL => $url,

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_HTTPHEADER => array(

        "Authorization: Bearer $secretKey",
        "Cache-Control: no-cache",

    ),

));

$response = curl_exec($curl);

$result = json_decode($response);

if($result->status){

    $email = $result->data->customer->email;
    $amount = $result->data->amount / 100;

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO payments
            (
                user_id,
                amount,
                week_number,
                payment_method,
                status
            )

            VALUES

            (
                '$user_id',
                '$amount',
                '1',
                'PAYSTACK',
                'Paid'
            )";

    $conn->query($sql);

    echo "

    <h2 style='color:green;text-align:center;margin-top:100px;'>

        Payment Successful ✅

    </h2>

    ";

} else {

    echo "

    <h2 style='color:red;text-align:center;margin-top:100px;'>

        Payment Failed ❌

    </h2>

    ";

}

?>