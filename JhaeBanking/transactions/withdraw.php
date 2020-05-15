<?php
session_start();

#ini_set('display_errors',1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('../db/dbconnect.php');
require('balance.php');
$acc = $_SESSION['account'];
$receiving = '000000000000';
$mon1 = $_SESSION['with'];
$mon2 = -$mon1;

if($mon1 > $balance){
    $message = 'Sorry you only have: ' . $balance;
    echo "<script type='text/javascript'>alert('$message');</script>";
} else{
    $with = $d->prepare("INSERT INTO `TRANSACTIONS`
                        (SendingAcc, ReceivingAcc, Mon, Memo, Total) 
                        VALUES ($acc, '000000000000', $mon2, 'Withdraw', $mon2)");
    $with->execute();

    $with = $d->prepare("INSERT INTO `TRANSACTIONS`
                        (SendingAcc, ReceivingAcc, Mon, Memo, Total) 
                        VALUES ('000000000000', $acc, $mon1, 'Withdraw', $mon1)");
    $with->execute();
}

header("refresh:0;url='../bankdashboard.php'");
?>