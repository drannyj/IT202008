<?php
session_start();

#ini_set('display_errors',1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

require('../db/dbconnect.php');
require('balance.php');
$acc = $_SESSION['account'];
$trans = $_SESSION['transferAcc'];
$mon1 = $_SESSION['transferNum'];
$mon2 = -$mon1;

if($mon1 > $balance){
    $message = 'Sorry you only have: ' . $balance;
    echo "<script type='text/javascript'>alert('$message');</script>";
}else{
$with = $d->prepare("INSERT INTO `TRANSACTIONS`
                    (SendingAcc, ReceivingAcc, Mon, Memo, Total) 
                    VALUES ($acc, $trans, $mon2, 'Transfer', $mon2)");
$with->execute();

$with = $d->prepare("INSERT INTO `TRANSACTIONS`
                    (SendingAcc, ReceivingAcc, Mon, Memo, Total) 
                    VALUES ($trans, $acc, $mon1, 'Transfer', $mon1)");
$with->execute();
}
header("refresh:0;url='../bankdashboard.php'");

?>