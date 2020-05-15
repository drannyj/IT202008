<?php
session_start();

ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../db/dbconnect.php');
$acc = $_SESSION['account'];
$receiving = '000000000000';
$mon1 = $_SESSION['dep'];
$mon2 = -$mon1;

$dep = $d->prepare("INSERT INTO `TRANSACTIONS`
                    (SendingAcc, ReceivingAcc, Mon, Memo, Total) 
                    VALUES ('000000000000', $acc, $mon2, 'Deposit', $mon2)");
$dep->execute();

$dep = $d->prepare("INSERT INTO `TRANSACTIONS`
                    (SendingAcc, ReceivingAcc, Mon, Memo, Total) 
                    VALUES ($acc, '000000000000', $mon1, 'Deposit', $mon1)");
$dep->execute();

header("Location: ../bankdashboard.php");

?>
