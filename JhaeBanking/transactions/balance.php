<?php

session_start();

#ini_set('display_errors',1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

$acc = $_SESSION['account'];

$check = $d->prepare("SELECT MON From `TRANSACTIONS` where SendingAcc = $acc LIMIT 500");
$check->execute();
$r = $check->fetchAll();

$balance = 0;

foreach($r as $rows){
    $balance += $rows[0];
}

?>


