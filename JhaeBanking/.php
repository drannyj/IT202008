<?php
require('bankdb.php');
session_start();

$u = $_SESSION['username'];
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$check = $d->prepare('SELECT Checkings, Savings, Loan WHERE username = $u');
$check->execute();
$r = $check->fetchAll(PDO::FETCH_ASSOC);

print_r($r);

?>