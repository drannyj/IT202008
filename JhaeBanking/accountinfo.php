<?php
session_start();
require('db/dbconnect.php');

$u = $_SESSION['username'];
$get = $d->prepare("SELECT ACC from `ACCOUNT NUMBERS` where username = '$u'");
$get->execute();
$r = $get->fetch(PDO::FETCH_ASSOC);

$acc = $r['ACC'];

$get = $d->prepare("SELECT Checkings, Savings, Loan from `ACCOUNT NUMBERS` where username = '$u'");
$get->execute();
$r = $get->fetch(PDO::FETCH_ASSOC);

$c = false;
$s = false;
$l = false;

if($r['Checkings'] == 1){
    $c = true;
}
if($r['Savings'] == 1){
    $s = true;
}
if($r['Loan'] == 1){
    $l = true;
}
?>