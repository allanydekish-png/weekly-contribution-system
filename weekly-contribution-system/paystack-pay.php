<?php
session_start();

/*
TEMP TEST EMAIL
Later replace with:
$email = $_SESSION['email'];
*/

$email = "test@email.com";
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Pay Contribution</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<script src="https://js.paystack.co/v1/inline.js"></script>

<style>

body{
    background:#f5f7fb;
    font-family:Arial;
}

.pay-container{
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.pay-box{
    width:420px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 2px 15px rgba(0,0,0,0.1);
}

.logo{
    text-align:center;
    margin-bottom:20px;
}

.logo h2{
    font-weight:bold;
    color:#031b4e;
}

.amount-box{
    background:#f1f5f9;
    padding:20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

.amount-box h1{
    color:#16a34a;
    font-weight:bold;
}

.btn-pay{
    background:#16a34a;
    border:none;
    padding:14px;
    width:100%;
    color:white;
    border-radius:12px;
    font-size:18px;
    transition:0.3s;
}

.btn-pay:hover{
    background:#15803d;
}

.note{
    margin-top:15px;
    text-align:center;
    color:#666;
    font-size:14px;
}

</style>

</head>
<body>

<div class="pay-container">

    <div class="pay-box">

        <div class="logo">

            <h2>
                Weekly Contribution
            </h2>

            <p>
                Secure payment via Paystack
            </p>

        </div>

        <div class="amount-box">

            <p>Weekly Contribution</p>

            <h1>KES 250</h1>

        </div>

        <button onclick="payWithPaystack()"
                class="btn-pay">

            Pay Now

        </button>

        <div class="note">

            Supports:
            M-Pesa • Card • Bank

        </div>

    </div>

</div>

<script>

function payWithPaystack(){

    let handler = PaystackPop.setup({

        key: 'pk_live_cd51afe5080b928655a4bc9b24720dad100d2973',

        email: '<?php echo $email; ?>',

        amount: 25000,

        currency: 'KES',

        ref: 'CONTRIB_' + Math.floor(
            (Math.random() * 1000000000) + 1
        ),

        callback: function(response){

            window.location =
            "verify.php?reference=" + response.reference;

        },

        onClose: function(){

            alert('Payment cancelled');

        }

    });

    handler.openIframe();
}

</script>

</body>
</html>