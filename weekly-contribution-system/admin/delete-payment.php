<?php

session_start();
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM payments
            WHERE id='$id'";

    if($conn->query($sql)){

        header("Location: payments.php");

    } else {

        echo "Failed to delete payment.";

    }

} else {

    echo "Invalid Request.";

}

?>