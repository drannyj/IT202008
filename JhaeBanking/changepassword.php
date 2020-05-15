<?php
session_start();

ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['current']) && isset($_POST['new']) && isset($_POST['confirm'])){
    require('db/dbconnect.php');

        $c = $_POST['current'];
        $n = $_POST['new'];
        $con = $_POST['confirm'];
        $u = $_SESSION['username'];
    
        $get = $d->prepare("SELECT password from `BANKING INFORMATION` where username = '$u'");
        $get->execute();
        $r = $get->fetch(PDO::FETCH_ASSOC);
        $p = $r['password'];
        $verify = password_verify($c, $r['password']);
        
        if($verify){
            $n = password_hash($n, PASSWORD_BCRYPT);
            $update = $d->prepare("UPDATE `BANKING INFORMATION` SET `password` = '$n' WHERE `username` = '$u'");
            $update->execute();
            echo '<div class = "notif">Success!</div>';
            header("refresh:1;url=banklogout.php");
        }else{
            echo '<div class = "notif">Sorry, that\'s the wrong password</div>';
        }
    }

?>

<html>
<head>
    <style>
        .whole{
      background-image: url(bankreg-background.jpg);
      background-size: 2000px 1000px;
    }

    .title{
      text-align: center;
      position: absolute;
      left: 700px;
      top: 150px;
      background-color: red;
      color: white;
      width: 500px;
      border: 2px solid black;
    }
    .body{
      text-align: center;
      position: absolute;
      left: 800px;
      top: 300px;
      background-color: #D0D0D0;
      border: 2px solid black;
      width: 300px;
      margin: 10px;
    }

    .notif{
      text-align: center;
      position: relative;
      background-color: #FFFFFF;
      border: 2px solid black;
      width: 500px;
      margin: 1px;
    }
    </style>
</head>
<body class = 'whole'>
<div class = 'body'>
<form name = 'passchange' method = 'POST'>
    <br><input type = 'password' id = 'current' name = 'current' placeholder = "Current Password"/></br>
    <br><input type = 'password' id = 'new' name = 'new' placeholder = "New Password"/></br>
    <br><input type = 'password' id = 'confirm' name = 'confirm' placeholder = "Confirm Password"/></br>
    <br><button type = 'submit'>Done</button></br>
    <button type = 'button' onclick = 'goBack()'>Go Back</button>
</form>
</div>
</body>
<script>
    function goBack(){
            window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/bankdashboard.php";
    }
</script>
</html>