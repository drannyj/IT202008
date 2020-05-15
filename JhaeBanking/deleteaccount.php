<?php
#ini_set('display_errors',1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

session_start();
require('db/dbconnect.php');
$u = $_SESSION['username'];

$delete = $d->prepare("DELETE FROM `ACCOUNT NUMBERS` WHERE username = '$u'");
$delete->execute();

$delete = $d->prepare("DELETE FROM `BANKING INFORMATION` WHERE username = '$u'");
$delete->execute();

echo "You're all set. Thank you for banking with us!";
header("refresh:2;url=banklogout.php");
?>
