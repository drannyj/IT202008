<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require('db/dbconnect.php');

$u = $_SESSION['username'];
$get = $d->prepare("SELECT count(*) as `count` FROM `UserRoles` WHERE `user` = '$u'");
$get->execute();
$r = $get->fetch(PDO::FETCH_ASSOC);

if($r['count'] == 0){
    echo 'Nope!';
}else{
    echo 'Yes!';
}
?>
<html>
    <body>
        <form action = 'bankdashboard.php'>
            <button type = submit>Go back</button>
        </form>
    </body>
</html>