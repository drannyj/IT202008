<?php
require('config.php');
$connectionString = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
    $d = new PDO($connectionString, $dbuser, $dbpass);
}
catch(Exception $e){
    echo $e->getMessage();
    exit();
}
?>