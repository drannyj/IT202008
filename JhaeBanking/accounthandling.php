<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db/dbconnect.php');
$u = $_SESSION['username'];
$t = $_SESSION['type'];

$num = mt_rand(1000000000, 999999999999);
$num = strval($num);

$insert = $d->prepare("INSERT INTO `ACCOUNT NUMBERS`
                    (username, ACC)
                    VALUES (:username, :acc)");
$info = array(":username"=>$u,":acc"=>$num);
$insert->execute($info);
#echo var_export($insert->errorInfo(), true);

$insert = $d->prepare("UPDATE `ACCOUNT NUMBERS`
                    SET $t = 1
                    WHERE $t = $t");
$insert->execute();
#echo var_export($insert->errorInfo(), true);
?>